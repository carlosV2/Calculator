<?php

    require_once 'constants/constants.php';
    require_once 'lib/Autoload.php';

    $parser = new Parser();

    while (true) {
        echo 'expr> ';
        $expr = trim(fgets(STDIN));

        // If quit command recieved, quit the loop
        if (in_array($expr, array('exit', 'quit'))) {
            break;
        }

        try {
            echo 'Result: ' . $parser->setExpression($expr)->parse()->evaluate() . PHP_EOL;
        } catch(SyntaxException $e) {
            $e->showIssue();
        } catch(EvaluationException $e) {
            $e->showIssue();
        } catch(Exception $e) {
            echo 'Ooops, something terrible happened... try again!';
        }

        echo PHP_EOL;
    }