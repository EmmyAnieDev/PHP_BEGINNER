<?php

class Item {

    public $name;
    public $description = 'This is the default';  // default value to the properties

    // When an object is created, initialize the object's properties
    public function __construct($name, $description) {
        $this->name = $name;
        $this->description = $description;
    }


    function sayHello() {
        return 'Hello ' . $this->name;
    }
}
