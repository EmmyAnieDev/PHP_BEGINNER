<?php



error_reporting(E_ALL); 
ini_set('display_errors', 1); 


// The Book class extends from the Item class, meaning it inherits all 
//public and protected properties and methods from the Item class.
class Book extends Item{

    private $author;
    public $country = 'France';    // overriding the country property in the Item class by changing the value


    // Since the Book class extends the Item class, 
    //we need to call the parent constructor to initialize the properties in the parent class (Item).
    public function __construct($name, $description, $year, $author) {

        $this->author = $author;
        // Calling the parent constructor from the Item class to initialize $name, $description, and $year.
        parent::__construct($name, $description, $year);
    }

    // overriding the getData function in the Item class by chnaging the returned value
    public function getData(){
        return 'we have five data in each Book';
    }

    // here we are able to override and also access the protected property from the super class.
    public function getCode(){
        return "code $this->code gotten from sub class";
    }
}

