<?php

class Item {

    public $name;    ///  public properties can be used or accesed outside the class unlike private
    public $description = 'This is the default';  // default value to the properties
    private $year;    // since it private it can only be used inside this class


    // When an object is created, initialize the object's properties
    public function __construct($name, $description, $year) {
        $this->name = $name;
        $this->description = $description;
        $this->year = $year;
    }

    // same as properties, public method can be accessible outisde the class.
    public function sayHello() {
        return 'Hello ' . $this->name . ' year is ' . $this->year;
    }

    // same as properties, private method cannot be accessible outisde the class.
    private function yearDifferences() {
        return 2024 - $this->year;
    }
}
