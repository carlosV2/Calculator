<?php

    /**
     * Provides functions to perform functions with angles
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class AngleFn extends Fn implements EvaluableInterface
    {
        /**
         * {@inheritdoc}
         */
        public function evaluate()
        {
            $value = parent::getOperandValue();

            // Operate in degrees
            return deg2rad($value->value);
        }

        /**
         * {@inheritdoc}
         */
        public function getStringValue()
        {
            return $this->operation->getStringValue();
        }
    }