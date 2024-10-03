<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

// const are variable that are fixed and can't be changed
// they should be named using uppercase and words separated with underscore
// use "define" keyword only outside the class

define ('MAXIMUM', 100);

define ('COLOR', 'red');


echo COLOR;


define ('COLOR', 'blue');   // this will throw and error as the constant has been defined previously and can't be modified


echo COLOR;