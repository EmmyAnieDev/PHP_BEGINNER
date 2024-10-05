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
        $this->offset = $records_per_page * ($page - 1);
    }

}