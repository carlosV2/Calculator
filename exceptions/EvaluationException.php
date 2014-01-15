<?php

    /**
     * Provides functions to show a runtime exception
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class EvaluationException extends Exception
    {
        /**
         * Constructor for the class
         */
        public function __construct()
        {
            parent::__construct('Runtime error when trying to evaluate', 200);
        }

        /**
         * Function to print the issue and spot it
         */
        public function showIssue()
        {
            echo $this->message . PHP_EOL;
        }
    }