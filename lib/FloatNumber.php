<?php

    /**
     * Provides functions to manage a float number
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class FloatNumber implements EvaluableInterface
    {
        /**
         * Priority on operations' list
         * 
         * @var int
         */
        public static $order = 5;

        /**
         * Float value of this object
         * 
         * @var float
         */
        private $value;


        /**
         * Constructor of the class
         * 
         * @param mixed $number The value this object should have
         */
        public function __construct($number)
        {
            $this->value = floatval($number);
        }

        /**
         * {@inheritdoc}
         */
        public function evaluate()
        {
            return $this->value;
        }

        /**
         * {@inheritdoc}
         */
        public function getStringValue()
        {
            return strval($this->value);
        }
    }