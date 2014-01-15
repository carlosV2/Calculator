<?php

    /**
     * Provides functions to show a non-existing function exception
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class NonExistingFunctionException extends SyntaxException
    {
        /**
         * Function name
         * 
         * @var string
         */
        protected $fn_name;


        /**
         * Constructor for the class
         * 
         * @param string $expression Erroneous expression
         * @param string $fn_name Non-existing function
         */
        public function __construct($expression, $fn_name)
        {
            $this->fn_name = $fn_name;

            parent::__construct($expression);
        }

        /**
         * {@inheritdoc}
         */
        public function showIssue()
        {
            // Search the function name
            parent::spotIssue(strpos($this->expression, $this->fn_name), 'Unkown function');
        }
    }