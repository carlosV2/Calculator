<?php

    /**
     * Provides functions to perform an square root function
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class SqrtFn extends Fn implements EvaluableInterface
    {
        /**
         * {@inheritdoc}
         */
        public function evaluate()
        {
            $value = parent::getOperandValue();
            return sqrt($value->value);
        }

        /**
         * {@inheritdoc}
         */
        public function getStringValue()
        {
            return 'sqrt(' . $this->operation->getStringValue() . ')';
        }
    }