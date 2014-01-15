<?php

    /**
     * Provides functions to perform a pow operation
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class PowOperation extends Operation implements EvaluableInterface
    {
        /**
         * {@inheritdoc}
         */
        public static $order = 3;


        /**
         * {@inheritdoc}
         */
        public function evaluate()
        {
            $values = parent::getOperandsValues();
            return pow($values->left, $values->right);
        }

        /**
         * {@inheritdoc}
         */
        public function getStringValue()
        {
            return $this->left->getStringValue() . '^' . $this->right->getStringValue();
        }
    }