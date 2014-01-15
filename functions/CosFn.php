<?php

    /**
     * Provides functions to perform a cosinus function
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class CosFn extends AngleFn implements EvaluableInterface
    {
        /**
         * {@inheritdoc}
         */
        public function evaluate()
        {
            return cos(parent::evaluate());
        }

        /**
         * {@inheritdoc}
         */
        public function getStringValue()
        {
            return 'cos(' . parent::getStringValue() . ')';
        }
    }