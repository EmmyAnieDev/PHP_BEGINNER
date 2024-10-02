<?php

    # Function is a block of reusable code that performs a specific task


// Function with no parameters that prints a message
function sendMessage(){
    echo "I was told to send a message </br>";
}

sendMessage();   // Calling the function

echo "</br>";



// Function that takes one parameter and prints it
function callSomeone($name){
    echo "I was told to call $name </br>";
}

callSomeone('Dave');   // Calling the function with an argument

echo "</br>";



// Function that takes two parameters and prints a message
function callPerson($age, $gender = 'Male'){  // Default value for $gender
    $name = 'Joshua';  // Local variable
    echo "His name is $name, he's $age years old and his gender is $gender. </br>";
}

callPerson(25);   // Calling the function with one argument (gender will use the default value 'Male')

echo "</br>";



// Function that returns a value (output can be used outside the function)
function returnValue($language, $role){
    $level = 'Junior';  // Local variable
    echo "He is a $level $language $role developer. </br>";
}

echo returnValue('PHP', 'Backend');   // Calling the function and displaying the result

