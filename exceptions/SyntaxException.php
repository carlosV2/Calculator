<?php

    /**
     * Provides functions to show a systax exception
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    abstract class SyntaxException extends Exception
    {
        /**
         * Erroneous expression
         * 
         * @var string
         */
        protected $expression;


        /**
         * Constructor for the class
         * 
         * @param string $expression Erroneous expression
         */
        public function __construct($expression)
        {
            $this->expression = $expression;

            parent::__construct('Syntax error on expression: "' . $this->expression . '"', 100);
        }

        /**
         * Function to print the error message spotting the issue
         * 
         * @param int $position Position of the issue
         * @param string $message Message to show above the issue type
         */
        public function spotIssue($position, $message = null)
        {
            $message = (isset($message) ? $message . ':' : '');
            $real_pos = 29 + $position - strlen($message);

            echo $this->message . PHP_EOL;
            echo $message . str_repeat('-', $real_pos) . '^' . PHP_EOL;
        }

        /**
         * Function to print the issue and spot it
         */
        abstract public function showIssue();
    }