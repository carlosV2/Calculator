<?php

    /**
     * Provides functions to perform a tangent function
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class TanFn extends AngleFn implements EvaluableInterface
    {
        /**
         * {@inheritdoc}
         */
        public function evaluate()
        {
            return tan(parent::evaluate());
        }

        /**
         * {@inheritdoc}
         */
        public function getStringValue()
        {
            return 'tan(' . parent::getStringValue() . ')';
        }
    }