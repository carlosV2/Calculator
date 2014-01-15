<?php

    /**
     * Provides functions to manage functions
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    abstract class Fn
    {
        /**
         * Priority on operations' list
         * 
         * @var int
         */
        public static $order = 4;

        /**
         * Main operation holded by this function
         * 
         * @var mixed
         */
        protected $operation;


        /**
         * Function to add an operand to the bracket
         * 
         * @param mixed $operand The operand to be added
         */
        public function add($operand)
        {
            // If the operation is not set, use the operand
            if (!isset($this->operation)) {
                $this->operation = $operand;

            // If it is set, continue
            } else {
                $operation_class = get_class($this->operation);

                // If the operation has a higher priority, push the node down
                if ($operation_class::$order > $operand::$order) {
                    $operand->setValue($this->operation);
                    $this->operation = $operand;
                } else {
                    $this->operation->add($operand);
                }
            }
        }

        /**
         * Function to set the operator
         * 
         * @param mixed $operand Operator
         */
        public function setValue($operand)
        {
            $this->operation = $operand;
        }

        /**
         * Function to evaluate the values of the operator
         * 
         * @throws EvaluationException If anything happens when evaluating
         * 
         * @return object An object with the values
         */
        protected function getOperandValue()
        {
            if (!($this->operation instanceof EvaluableInterface)) {
                throw new EvaluationException();
            }

            // Generate the object
            $output = new stdClass();
            $output->value = $this->operation->evaluate();

            return $output;
        }
    }