<?php


////   VARIABLE are used to store data or information

$message  = 'Hello learning from udemy after learning from youtube';    // string variable

$count = 4; // interger variable

$price = 1.99;   /// float(decimal) variable

$is_admin = true;  // boolean varaible (true/false)
$is_editor = false;


var_dump($is_admin) . '<br/>';
var_dump($is_editor) . '<br/>';




echo $message . '<br/>';
echo $count . '<br/>';
echo $price . '<br/>';

# MATHEMATICAL OPERATORS

echo $count - 2 . '<br/>';      // substraction operator
echo $count * 2 . '<br/>';      // multiplication operator
echo $count ** 2 . '<br/>';     // square operator
echo $count + 2 . '<br/>';      // addition opearator
echo $count / 2 . '<br/>';      // division operator

# STRING INTERPOLATION

echo 'the boy is outside <br/>';  // Single quotes: literal string, variables are not parsed
echo "the girl is outside <br/>";  // Double quotes: literal string, variables can be parsed
echo 'the man\'s son is home <br/>';  // Escaping single quote inside a string that uses single quotes
echo "the man's daughter is home <br/>";  // No need to escape the single quote inside a string that uses double quotes
echo 'this is the price: ' . $price . ' <br/>';  // Concatenation using single quotes, variables must be concatenated explicitly
echo "the current price is: $price  <br/>";  // Double quotes allow variable interpolation, no need for concatenation
