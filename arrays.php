<?php

# ARRAYS: Used to store a collection or list of data.


// INDEXED ARRAY: Access values using the index position.
$articles = ['first post', 'second post', 'another post'];

var_dump($articles);
echo '<br/>';
var_dump($articles[0]);
echo '<br/>';



// ASSOCIATIVE ARRAY: Access values using keys (key/value pairs).
$blog_names = ['first' => 'The winner', 'second' => 'All about winning', 'third' => 'do not stop winning'];

var_dump($blog_names['second']);



// MULTIDIMENSIONAL ARRAY: Useful for representing tables of data (arrays within arrays).

# INDEXED MULTIDIMENSIONAL ARRAY
$people_details = [
    ['John', 24, 2005, 'user', 'London'],
    ['Thelma', 39, 2016, 'user', 'Ghana'],
    ['Isaac', 43, 2020, 'user', 'United States'],
    ['Kevin', 28, 2003, 'admin', 'Paris'],
    ['Sarah', 19, 2001, 'moderator', 'Lisbon'],
];

print_r($people_details[2]);

# ASSOCIATIVE MULTIDIMENSIONAL ARRAY
$athletics_ranking = [
    ['name' => 'Messi', 'age' => 37, 'club' => 'Miami', 'country' => 'Argentina'],
    ['name' => 'Ronaldo', 'age' => 38, 'club' => 'Al Nassr', 'country' => 'Portugal'],
    ['name' => 'Mbappe', 'age' => 25, 'club' => 'PSG', 'country' => 'France'],
    ['name' => 'Neymar', 'age' => 32, 'club' => 'Al Hilal', 'country' => 'Brazil'],
    ['name' => 'Lewandowski', 'age' => 35, 'club' => 'Barcelona', 'country' => 'Poland'],
];

print_r($athletics_ranking[0]['name'] . '<br/>');


$position = 1;


// using for loops to loop through each element in the array.

foreach($athletics_ranking as $ranking){
    echo "{$ranking['name']} is at index $position <br/>";
    $position ++;
}

echo '<br/>';

foreach($athletics_ranking as $index => $ranking){
    echo "$index - {$ranking['name']} <br/>";
}