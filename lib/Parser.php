<?php

    /**
     * Provides functions to parse an expression into a operations' tree
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class Parser
    {
        /**
         * Expression to be parsed
         * 
         * @var string
         */
        private $expression;

        /**
         * Stack of brackets
         * 
         * @var Bracket[]
         */
        private $brackets = array();


        /**
         * Function to set the expression to be parsed
         * 
         * @param string $expression Expression to be parsed
         * 
         * @return Parse The instance of this class
         */
        public function setExpression($expression)
        {
            if (is_string($expression)) {
                $this->expression = $expression;

                $this->_cleanExpression();
            }

            return $this;
        }

        /**
         * Function to get the expression to be parsed
         * 
         * @return string The expression
         */
        public function getExpression()
        {
            return $this->expression;
        }

        /**
         * Function to clean the expression
         */
        private function _cleanExpression()
        {
            // If the expression is not set, use an empty string
            if (!isset($this->expression)) {
                $this->expression = '';
            }

            // Convert to lowecases
            $this->expression = strtolower($this->expression);

            // Remove all the spaces
            $this->expression = str_replace(' ', '', $this->expression);

            // Convert all the brackets into parentheses
            $this->expression = str_replace(
                                    array('[', ']'),
                                    array('(', ')'),
                                    $this->expression);

            // Replace '**' by '^'
            $this->expression = str_replace('**', '^', $this->expression);
        }

        /**
         * Function to parse the expression and get the operations' tree
         * 
         * @throws NonMatchingBracketsException If the brackets are not matched
         * @throws NonExistingFunctionException If the function does not exists
         * @throws NonExistingConstantException If the constant does not exists
         * 
         * @return Bracket The operations' tree
         */
        public function parse()
        {
            // Count openning and closing brackets
            $openning_brackets = substr_count($this->expression, '(');
            $closing_brackets = substr_count($this->expression, ')');

            // Rise an error if the numbers of brackets missmatch
            if ($openning_brackets !== $closing_brackets) {
                throw new NonMatchingBracketsException($this->expression);
            }

            // Generate the regex
            $capture_groups = array(
                '(?:0|[1-9]\d*)(?:\.\d+)?(?:(?:e|E)(?:\+|\-)?\d+)?',        // Float
                '[a-z]+\(',                                                 // Functions
                '\+',                                                       // Add operation
                '\-',                                                       // Substract operation
                '\*',                                                       // Multiply operation
                '/',                                                        // Divide operation
                '\^',                                                       // Pow operation
                '\(',                                                       // Openning bracket
                '\)'                                                        // Closing bracket
            );
            $regex = '!(' . implode('|', $capture_groups) . ')!';

            // Divide the expression
            $parts = preg_split($regex, $this->expression, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

            // Compose the operations' tree
            return $this->_composeTree($parts);
        }

        /**
         * Function to compose the operations' tree from the splitted expression
         * 
         * @throws NonExistingFunctionException If the function does not exists
         * @throws NonExistingConstantException If the constant does not exists
         * 
         * @return Bracket The operations' tree
         */
        private function _composeTree($parts)
        {
            // If no parts returned, then the value is 0. Compose a fake tree which reduces to 0
            if (count($parts) === 0) {
                return new Bracket(new FloatNumber(0));
            }

            // Compose the operations' tree
            $this->brackets[] = new Bracket();

            // Set some flags
            $bracket_empty = true;
            $previous_was_number = false;

            $total = count($parts);
            for ($i = 0; $i < $total; $i++) {
                $item = $parts[$i];

                // Add operation
                if ($item === '+') {
                    if ($bracket_empty) {
                        end($this->brackets)->add(new FloatNumber(0));
                        $bracket_empty = false;
                    }

                    end($this->brackets)->add(new AdditionOperation());
                    $previous_was_number = false;

                // Substract operation
                } elseif ($item === '-') {
                    if ($bracket_empty) {
                        end($this->brackets)->add(new FloatNumber(0));
                        $bracket_empty = false;
                    }

                    end($this->brackets)->add(new SubstractionOperation());
                    $previous_was_number = false;

                // Multipy operation
                } elseif ($item === '*') {
                    if ($bracket_empty) {
                        end($this->brackets)->add(new FloatNumber(0));
                        $bracket_empty = false;
                    }

                    end($this->brackets)->add(new MultiplicationOperation());
                    $previous_was_number = false;

                // Divide operation
                } elseif ($item === '/') {
                    if ($bracket_empty) {
                        end($this->brackets)->add(new FloatNumber(0));
                        $bracket_empty = false;
                    }

                    end($this->brackets)->add(new DivisionOperation());
                    $previous_was_number = false;

                // Pow operation
                } elseif ($item === '^') {
                    if ($bracket_empty) {
                        end($this->brackets)->add(new FloatNumber(0));
                        $bracket_empty = false;
                    }

                    end($this->brackets)->add(new PowOperation());
                    $previous_was_number = false;

                // Get a raw number
                } elseif (is_numeric($item)) {
                    end($this->brackets)->add(new FloatNumber($item));
                    $bracket_empty = false;
                    $previous_was_number = true;

                // Closing a bracket
                } elseif ($item === ')') {
                    if (count($this->brackets) < 2) {
                        throw new NonMatchingBracketsException($this->expression);
                    }

                    $bracket = array_pop($this->brackets);
                    end($this->brackets)->add($bracket);
                    $bracket_empty = false;

                // Remaining stuff
                } else {
                    $last_char = substr($item, -1);

                    // Check for an openning bracket
                    if ($last_char === '(') {
                        if ($previous_was_number) {
                            end($this->brackets)->add(new MultiplicationOperation());
                            $previous_was_number = false;
                        }

                        $fn_name = substr($item, 0, -1);

                        // May also have a function involved
                        if ($fn_name !== '') {
                            $class_name = ucfirst($fn_name) . 'Fn';

                            // Check for the existance of the class
                            if (class_exists($class_name)) {
                                end($this->brackets)->add(new $class_name());
                            } else {
                                throw new NonExistingFunctionException($this->expression, $fn_name);
                            }
                        }

                        // Finally open the bracket
                        $this->brackets[] = new Bracket();
                        $bracket_empty = true;

                    // Remaining stuff
                    } else {
                        $cnt_name = 'CONSTANT_' . strtoupper($item);

                        if ($previous_was_number) {
                            end($this->brackets)->add(new MultiplicationOperation());
                            $previous_was_number = false;
                        }

                        // Check for constants
                        if (defined($cnt_name)) {
                            end($this->brackets)->add(new FloatNumber(constant($cnt_name)));
                        } else {
                            throw new NonExistingConstantException($this->expression, $item);
                        }
                    }
                }
            }

            return array_pop($this->brackets);
        }
    }