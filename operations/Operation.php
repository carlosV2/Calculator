<?php

    /**
     * Provides functions to manage operations
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    abstract class Operation
    {
        /**
         * Priority on operations' list
         * 
         * @var int
         */
        public static $order;
        
        /**
         * Left side operand
         * 
         * @var mixed
         */
        public $left;

        /**
         * Right side operand
         * 
         * @var mixed
         */
        public $right;


        /**
         * Function to add operations and numbers to the operations' tree
         * 
         * @param mixed $operand Operator to be added
         */
        public function add($operand)
        {
            // If the left side is not set, use the operand
            if (!isset($this->left)) {
                $this->left = $operand;

            // If the right side is not set, use the operand
            } elseif (!isset($this->right)) {
                $this->right = $operand;

            // If both sides are set, continue
            } else {
                $right_side_class = get_class($this->right);

                // If the right side has a higher priority, push the node down
                if ($right_side_class::$order > $operand::$order) {
                    $operand->setValue($this->right);
                    $this->right = $operand;

                // Otherwise, add the node into the next value
                } else {
                    $this->right->add($operand);
                }
            }
        }

        /**
         * Function to set the left side operator
         * 
         * @param mixed $operand Operator
         */
        public function setValue($operand)
        {
            $this->left = $operand;
        }

        /**
         * Function to evaluate the values of the operator
         * 
         * @throws EvaluationException If anything happens when evaluating
         * 
         * @return object An object with the values
         */
        protected function getOperandsValues()
        {
            if (!($this->left instanceof EvaluableInterface)) {
                throw new EvaluationException();
            }

            if (!($this->right instanceof EvaluableInterface)) {
                throw new EvaluationException();
            }

            // Generate the object
            $output = new stdClass();
            $output->left = $this->left->evaluate();
            $output->right = $this->right->evaluate();

            return $output;
        }
    }