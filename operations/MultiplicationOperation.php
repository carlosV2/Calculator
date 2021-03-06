<?php

    /**
     * Provides functions to perform a multiplication operation
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class MultiplicationOperation extends Operation implements EvaluableInterface
    {
        /**
         * {@inheritdoc}
         */
        public static $order = 2;


        /**
         * {@inheritdoc}
         */
        public function evaluate()
        {
            $values = parent::getOperandsValues();
            return ($values->left * $values->right);
        }

        /**
         * {@inheritdoc}
         */
        public function getStringValue()
        {
            return $this->left->getStringValue() . '*' . $this->right->getStringValue();
        }
    }