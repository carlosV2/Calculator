<?php

    /**
     * Provides functions to show a non-matching brackets exception
     * 
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class NonMatchingBracketsException extends SyntaxException
    {
        /**
         * {@inheritdoc}
         */
        public function showIssue()
        {
            // Count openning and closing brackets
            $openning_brackets = substr_count($this->expression, '(');
            $closing_brackets = substr_count($this->expression, ')');

            // If the number of brackets is the same, spot the end
            if ($openning_brackets === $closing_brackets) {
                parent::spotIssue(strlen($this->expression), 'Brackets in bad order');

            // If there is more openning than closing brackets, spot the end
            } elseif ($openning_brackets > $closing_brackets) {
                parent::spotIssue(strlen($this->expression), 'Missing closing bracket');

            // Otherwise, stop the first non-matched closing bracket
            } else {
                $stop_at = $openning_brackets + 1;
                $counter = 0;
                for ($i = 0; $i < strlen($this->expression); $i++) {
                    if ($this->expression[$i] === ')') {
                        $counter++;

                        if ($counter === $stop_at) {
                            parent::spotIssue($i, 'Unmatched bracket');
                            break;
                        }
                    }
                }
            }
        }
    }