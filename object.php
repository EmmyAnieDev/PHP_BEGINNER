<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

require 'item.php';
require 'book.php';

// we don't need to instansiate the class since count is a staic property
var_dump(Item::$count);

// creating an object from the class
$my_item = new Item('Huge', 'it\'s a big item', 2016);

var_dump(Item::$count);  // value is incremented by 1 whenever we create an object

$my_item2 = new Item('Small', 'it\'s a small item', 2003);


echo $my_item->name . '<br/>';
echo $my_item->sayHello() . '<br/>';
//echo $my_item->year . '<br/>';  // this will throw an erorr because we can't access private property outside the class
//echo $my_item->yearDifferences() . '<br/>';   // this will also throw an erorr because we can't access private methods outside the class
echo $my_item->getYear() . '<br/>';     // now with the public getter method we can access the private property for year
$my_item->setYear(2022) . '<br/>';     // now with the public setter method we can modify the private property for year
echo "new year for $my_item->name is {$my_item->getYear()}" . '<br/>';    // echo the object's to verify it has been chnaged

echo '<br/>';

echo $my_item2->name . '<br/>';
echo $my_item2->sayHello() . '<br/>';

echo '<br/>';

echo "this is the total count of object created: " . Item::$count;

echo '<br/>';

echo "the class maximum length is: " . Item::MAX_LENGTH;

echo '<br/>';
echo '<br/>';

$book_obj1 = new Book('pen game', 'best for all', '2013', 'Damian');

//calling the getYear method, which is inherited from the Item class. 
echo "the was gotten using the getYear Method from it parent's class. Book year: " . $book_obj1->getYear() . '<br/>';  

echo '<br/>'; 

echo $my_item2->country . '<br/>'; 
echo $my_item2->getData() . '<br/>'; 

echo '<br/>'; 

echo $book_obj1->country . '<br/>'; 
echo $book_obj1->getData() . '<br/>'; 