# Calculator

This project implements a mathematical expression parser and evaluator in PHP

## Running the project

To run the project just browse to the folder within the command line and execute:

	$ php index.php

Once this is executed, you will see this:

	expr>

You can now start inputing any expression you want to be evaluated

## Output

These are some examples of the output:

	expr> 1 + 2
	Result: 3

	expr> 1 * 2 + 3 * 4
	Result: 14

	expr> 1 * (2 + 3) * 4
	Result: 20

	expr> 2 + sin(90)
	Result: 3

	expr> sqrt(9) ^ 2
	Result: 9

	expr> 4 * PI
	Result: 12.566370614359

Also it will try to fix by itself some erroneous expressions:

	expr> 4(1 + 2)
	Result: 12

	expr> - 1 + 2
	Result: 1

If fixing is not possible, it will show you the error:

	expr> 1 * (2 +
	Syntax error on expression: "1*(2+"
	Missing closing bracket:----------^

	expr> 1) + 2
	Syntax error on expression: "1)+2"
	Unmatched bracket:------------^

	expr> 1) + (2
	Syntax error on expression: "1)+(2"
	Brackets in bad order:------------^

	expr> 1 + abc(5)
	Syntax error on expression: "1+abc(5)"
	Unkown function:---------------^

	expr> 1 + abc
	Syntax error on expression: "1+abc"
	Unkown constant:---------------^