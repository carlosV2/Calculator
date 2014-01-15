<?php

    /**
     * Provides functions to perform an sinus function
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class SinFn extends AngleFn implements EvaluableInterface
    {
        /**
         * {@inheritdoc}
         */
        public function evaluate()
        {
            return sin(parent::evaluate());
        }

        /**
         * {@inheritdoc}
         */
        public function getStringValue()
        {
            return 'sin(' . parent::getStringValue() . ')';
        }
    }