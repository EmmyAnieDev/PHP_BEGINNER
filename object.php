<?php

require 'item.php';

// creating an object from the class
$my_item = new Item('Huge', 'it\'s a big item');
$my_item2 = new Item('Small', 'it\'s a small item');


echo $my_item->name . '<br/>';
echo $my_item->sayHello() . '<br/>';

echo '<br/>';

echo $my_item2->name . '<br/>';
echo $my_item2->sayHello() . '<br/>';
