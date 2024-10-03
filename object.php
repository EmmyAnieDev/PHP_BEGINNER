<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

require 'item.php';

// creating an object from the class
$my_item = new Item('Huge', 'it\'s a big item', 2016);
$my_item2 = new Item('Small', 'it\'s a small item', 2003);


echo $my_item->name . '<br/>';
echo $my_item->sayHello() . '<br/>';
//echo $my_item->year . '<br/>';  // this will throw an erorr because we can't access private property outside the class
//echo $my_item->yearDifferences() . '<br/>';   // this will also throw an erorr because we can't access private methods outside the class

echo '<br/>';

echo $my_item2->name . '<br/>';
echo $my_item2->sayHello() . '<br/>';
