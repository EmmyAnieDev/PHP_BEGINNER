<?php

class Item {

    // to use constant inside the class we use the "const" keyword

    public const MAX_LENGTH = 24;   // const are just like static, can be accessed without instantiating the class. 

    public $name;    ///  public properties can be used or accesed outside the class unlike private
    public $description = 'This is the default';  // default value to the properties
    private $year;    // since it private it can only be used inside this class
    public static $count =0;  // Static properties and methods can be accessed without instantiating the class.
    public $country = 'USA' ;
    protected $code = 1234;  // use protected so the property/method can be accessible by both parent and child/children classes


    // When an object is created, initialize the object's properties
    public function __construct($name, $description, $year) {
        $this->name = $name;
        $this->description = $description;
        $this->year = $year;
        static::$count++;  // count wouldn't be added to the constructor as it's set as static
    }

    // same as properties, public method can be accessible outisde the class.
    public function sayHello() {
        return 'Hello ' . $this->name . ' year is ' . $this->year;
    }

    // same as properties, private method cannot be accessible outisde the class.
    private function yearDifferences() {
        return 2024 - $this->year;
    }

    // now we would be able to access the private property for year using this public method
    public function getYear(){
        return $this->year;
    }

    // now we would be modify the private property for year using this public method
    public function setYear($newYear){
        return $this->year = $newYear;
    }

    // creating a static method
    public static function showCount(){
        return static::$count;
    }

    public function getData(){
        return 'we have four data in each item';
    }

    public function getCode(){
        return "code $this->code gotten from super class";
    }
}
