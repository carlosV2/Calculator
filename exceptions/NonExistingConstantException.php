<?php

    /**
     * Provides functions to show a non-existing constant exception
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class NonExistingConstantException extends SyntaxException
    {
        /**
         * Function name
         * 
         * @var string
         */
        protected $cnt_name;


        /**
         * Constructor for the class
         * 
         * @param string $expression Erroneous expression
         * @param string $cnt_name Non-existing constant
         */
        public function __construct($expression, $cnt_name)
        {
            $this->cnt_name = $cnt_name;

            parent::__construct($expression);
        }

        /**
         * {@inheritdoc}
         */
        public function showIssue()
        {
            // Search the function name
            parent::spotIssue(strpos($this->expression, $this->cnt_name), 'Unkown constant');
        }
    }