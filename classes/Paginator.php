<?php


error_reporting(E_ALL); 
ini_set('display_errors', 1); 


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

    public $previousPage;

    public $nextPage;


    /**
     * Constructor
     * 
     * @param interger $page Page number
     * @param interger $records_per_page Number of records per page
     * @param interger $total_records total number of articles in the database
     * 
     * @return void
     */
    public function __construct($page, $records_per_page, $total_records){

        $this->limit = $records_per_page;

        $page = filter_var($page, FILTER_VALIDATE_INT, [
            'options' => [
                'default' => 1,   // default query to 1 if the user enters non-numeric value
                'min_range' => 1  // default query to 1 if the user enters a negtive number
            ]
        ]);
        
        $this->offset = $records_per_page * ($page - 1);

        // If the current page is greater than 1, 
        // set the previous page to one less than the current page
        if ($page > 1) {
            $this->previousPage = $page - 1;
        }

        // Calculate the total number of pages by dividing the total number of records by the number of records per page.
        // Use ceil() to round up, so any partial pages count as a full page.
        $total_pages = ceil($total_records / $records_per_page);

        // If the current page is less than the total number of pages, 
        // set the next page to one more than the current page
        if ($page < $total_pages) {
            $this->nextPage = $page + 1;
        }

    }

}