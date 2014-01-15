<?php

    /**
     * Defines common basic functionalities to all the evaluable objects
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    interface EvaluableInterface
    {
        /**
         * Function to get the value of the object
         * 
         * @throws EvaluationException If something unexpected happens
         * 
         * @return float Numeric value of the object
         */
        public function evaluate();

        /**
         * Function to get an string representation of the value
         * 
         * @return string String representation
         */
        public function getStringValue();
    }