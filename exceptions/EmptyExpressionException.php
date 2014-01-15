<?php

    /**
     * Provides functions to show an empty-expression exception
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class EmptyExpressionException extends SyntaxException
    {
        /**
         * Constructor for the class
         */
        public function __construct()
        {
            parent::__construct('');
        }

        /**
         * {@inheritdoc}
         */
        public function showIssue()
        {
            // Search the function name
            parent::spotIssue(0, 'Empty expression');
        }
    }