<?php

/**
 * Paginator
 * 
 * Data for selecting a page of records
 */
class Paginator{

    // Number of records to return
    public $limit;

    // Number of records to skip before the page 
    public $offset;


    /**
     * Constructor
     * 
     * @param interger $page Page number
     * @param interger $records_per_page Number of records per page
     * 
     * @return void
     */
    public function __construct($page, $records_per_page){

        $this->limit = $records_per_page;

        $page = filter_var($page, FILTER_VALIDATE_INT, [
            'options' => [
                'default' => 1,   // default query to 1 if the user enters non-numeric value
                'min_range' => 1  // default query to 1 if the user enters a negtive number
            ]
        ]);
        
        $this->offset = $records_per_page * ($page - 1);
    }

}