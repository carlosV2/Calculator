<?php

    /**
     * Provides functions to manage a bracket
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class Bracket implements EvaluableInterface
    {
        /**
         * Priority on operations' list
         * 
         * @var int
         */
        public static $order = 6;

        /**
         * Main operation holded by this bracket
         * 
         * @var mixed
         */
        private $operation;


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
         * {@inheritdoc}
         */
        public function evaluate()
        {
            if (!($this->operation instanceof EvaluableInterface)) {
                throw new EvaluationException();
            }

            return $this->operation->evaluate();
        }

        /**
         * {@inheritdoc}
         */
        public function getStringValue()
        {
            return '(' . $this->operation->getStringValue() . ')';
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
    }