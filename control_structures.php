<?php

# OPERATORS

//   >  : Greater than (e.g., 5 > 3 is true)
//   <  : Less than (e.g., 3 < 5 is true)
//   == : Equal to (compares values, e.g., 5 == '5' is true)
//   != : Not equal to (e.g., 5 != 3 is true)
//   <= : Less than or equal to (e.g., 3 <= 3 is true)
//   >= : Greater than or equal to (e.g., 5 >= 3 is true)
//   && : Logical AND (true if both sides are true, e.g., true && true is true)
//   || : Logical OR (true if at least one side is true, e.g., true || false is true)

# CONTROL STRUCTURES

// Initialize an array of articles
$articles = ['first post', 'second post', 'another post'];

// if statement is used to check conditions if something is true or false before executing a code.
if(empty($articles)){
    echo "The array is empty <br/>"; 
}else{
    echo "The array isn't empty <br/>"; 
}

// Declare some numeric variables
$num = 25;
$age = 30;

// Logical OR (||) - checks if either condition is true
if($num == 25 || $age == 30){
    echo "one or two number matches! <br/>";
}

// Logical AND (&&) - checks if both conditions are true
if($num > 20 && $age <= 30){
    echo "both numbers match! <br/>";
}



// while loop: this keeps running until the condition becomes false
$month = 1;

while($month < 12){
    echo "it's not up to a year. month: $month <br/>"; 
    $month ++; // Increment the month by 1
    if($month == 12){
        echo "it's a year now. month: $month <br/>"; 
    }
}



// for loop: run the code as many times as specified in the condition

// initial value, test/condition, change (increment or decrement)
for ($i = 0; $i < 10; $i++){
    echo "i($i) is less than 10 <br/>"; // Loop through and display the value of i
}



// else if statement to check multiple conditions:

$hour = 1;

// Check the time of day and display a greeting accordingly
if($hour >= 22){
    echo "good night! <br />";
}elseif($hour >= 18){
    echo "good evening! <br />";
}elseif($hour >= 12){
    echo "good afternoon <br/>";
}else{
    echo "good morning <br/>";
}



// switch case: use for multiple possible values of a variable
$day = 'Tue';

// Check the day of the week and display the day name accordingly
switch($day){
    case 'Mon':
        echo 'Monday';
        break;    // stop the switch case once the value is met
    case 'Tue':
        echo 'Tuesday';
        break;
    case 'Wed':
        echo 'Wednesday';
        break;
    case 'Thu':
        echo 'Thursday';
        break;
    case 'Fri':
        echo 'Friday';
        break;
    case 'Sat':
        echo 'Saturday';
        break;
    case 'Sun':
        echo 'Sunday';
        break;
    default:
        echo 'Invalid day';  // If no case matches, show this message
}
?>
