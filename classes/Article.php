<?php


error_reporting(E_ALL); 
ini_set('display_errors', 1); 


/**
 * Class Article
 * 
 * This class handles operations related to articles in the database.
 */
class Article {

    public $id;
    public $title;
    public $content;
    public $published_at;
    public $image_file;
    public $errors = [];

    /**
     * Retrieve all articles from the database.
     *
     * @param PDO $conn The PDO connection object.
     * @return array An associative array of all articles.
     */
    public static function getAllArticles($conn) {
        $sql = "SELECT * FROM article ORDER BY published_at"; // SQL query to select all articles ordered by publication date

        $result = $conn->query($sql);  // Query the connection with the SQL statement

        return $result->fetchAll(PDO::FETCH_ASSOC); // Fetch the result as an associative array
    }



    /**
     * Get the page articles
     * 
     * @param object $conn Connection to the database
     * @param interger $limit Number of records to return 
     * @param interger $offset Number of records to skip
     * 
     * @return array An associative array of the page of article records  
     */
    public static function getPage($conn, $limit, $offset, $only_published = false){

        $condition = $only_published ? ' WHERE published_at IS NOT NULL' : '';

        $sql = "SELECT a.*, category.name AS category_name FROM (SELECT * FROM article $condition ORDER BY published_at LIMIT :limit OFFSET :offset)
         AS a LEFT JOIN article_category ON a.id = article_category.article_id
         LEFT JOIN category ON article_category.category_id = category.id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $articles = [];

        $previous_id = null;

        foreach($results as $result){

            $article_id = $result['id'];

            if($article_id != $previous_id){
                $result['category_names'] = [];

                $articles[$article_id] = $result;

            }

            $articles[$article_id]['category_names'][] = $result['category_name'];

            $previous_id = $article_id;  // at the end let the previous id be the current id

        }

        return $articles;


    }



    /**
     * Get a count of the total number of records
     * 
     * @param object $conn Connection to the database
     * 
     * @return interger The total number of records
     */
    public static function getAllArticlesCount($conn, $only_published = false){

        $condition = $only_published ? ' WHERE published_at IS NOT NULL' : '';

        $articlesCount = $conn->query("SELECT COUNT(*) FROM article$condition")->fetchColumn();

        return $articlesCount;

    }



    /**
     * Retrieve an article by its ID from the database.
     *
     * @param PDO $conn The PDO connection object.
     * @param int $id The ID of the article to retrieve.
     * @param string $columns The columns to select (default is all columns).
     * @return object|null A object of the article if found, null otherwise.
     */
    public static function getById($conn, $id, $columns = '*') {
        $sql = "SELECT $columns FROM article WHERE id = :id "; // SQL query to select specific columns from the article table where the ID matches
    
        $stmt = $conn->prepare($sql); // Prepare the SQL statement for execution
    
        // Bind the $id parameter to the prepared statement
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); // Bind the ID value to the placeholder in the SQL statement

        // set default fetch mode to object
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article'); 
        
        // Execute the prepared statement
        if ($stmt->execute()) {
            return $stmt->fetch(); 
        }
    
        return null; // Return null if the execution fails or the article is not found
    }


    /**
     * Get the article record based on the ID along ith associated ategories, if any
     * 
     * @param object $conn Connection to the database
     * @param interger $id The article id
     * 
     * @return array the arrticle data with categories.
     */
    public static function getArticleWithCategoryById($conn, $id, $only_published = false){

        $sql = "SELECT article.id AS article_id, article.title, article.content, article.image_file, category.name AS category_name 
        FROM article 
        LEFT JOIN article_category ON article.id = article_category.article_id
        LEFT JOIN category ON article_category.category_id = category.id 
        WHERE article.id = :id";

        if($only_published){
            $sql .= ' AND article.published_at IS NOT NULL';
        }
        
        $stmt = $conn->prepare($sql);
            
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    /**
     * Get the article's categories
     * 
     * @param object $conn The Connection to database
     * 
     * @return array The Category data
     */
    public function getArticleCategories($conn){
        $sql = "SELECT category.* 
                FROM category 
                JOIN article_category 
                ON category.id = article_category.category_id 
                WHERE article_category.article_id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function validateArticle() {
        $this->errors = [];
    
        if ($this->title == '') {
            $this->errors[] = 'Title is required.';
        }
    
        if ($this->content == '') {
            $this->errors[] = 'Content is required.';
        }
    
        if ($this->published_at == '') {
            $this->errors[] = 'published_at is required.';
        }
    
        return empty($this->errors);
    }
    


    public function updateArticle($conn, $id, $title, $content, $published_at) {

        // Assign the form values to the object's properties
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->published_at = $published_at;
    
        // Validate the article before updating
        if ($this->validateArticle()) {
    
            // Prepare the SQL statement to update the article
            $sql = "UPDATE article SET title = :title, content = :content, published_at = :published_at WHERE id = :id";
            $stmt = $conn->prepare($sql);
    
            if (!$stmt) {
                // If the statement preparation fails, output an error message
                $this->errors[] = "Query failed: " . implode(", ", $conn->errorInfo());
                echo "Query failed: " . implode(", ", $conn->errorInfo());
                return false; // Exit the function to prevent further execution
            } 
    
            // Bind the parameters to the prepared statement
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
            $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
    
            // Execute the prepared statement
            if ($stmt->execute()) {
                return true;
            } else {
                // Error in executing the update statement
                $this->errors[] = "Error in inserting article: " . implode(", ", $conn->errorInfo());
                echo "Error in executing update: " . implode(", ", $stmt->errorInfo());
                return false; // Exit the function to prevent further execution
            }
        } else {
            // Validation failed
            return false;
        }
    }
    


    public function setArticleCategories($conn, $category_ids) {

        // First, delete all existing category associations for this article
        $sql_delete = "DELETE FROM article_category WHERE article_id = :article_id";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bindValue(':article_id', $this->id, PDO::PARAM_INT);
        $stmt_delete->execute();


        // Insert new category associations
        if ($category_ids) {
            $sql = "INSERT IGNORE INTO article_category (article_id, category_id) VALUES ";

            $values = [];

            foreach ($category_ids as $category_id) {
                $values[] = "({$this->id}, ?)";
            }

            $sql .= implode(", ", $values);

            $stmt = $conn->prepare($sql);

            foreach($category_ids as $index => $category_id){
                $stmt->bindvalue($index + 1, $category_id, PDO::PARAM_INT);
            }

            $stmt->execute();

        }else{
            echo "something wrong with this function!";
        }
    }
    
    

    // function to delete article
    public function deleteArticle($conn, $id){
        
        $sql = "DELETE FROM article WHERE id = :id ";
        $stmt = $conn->prepare($sql);
    
        if (!$stmt) {
    
            $this->errors[] = "Query failed: " . implode(", ", $conn->errorInfo());
            echo "Query failed: " . implode(", ", $conn->errorInfo());
            return false; // Exit the function to prevent further execution
    
        } else {
    
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
    
                // delete successful, redirect to the index page or display a success message
                header("Location: index.php");
                exit(); 
    
            } else {
                // Error in executing the update statement
                $this->errors[] = "Error in inserting article: " . implode(", ", $conn->errorInfo());
                echo "Error in executing delete: " . implode(", ", $stmt->errorInfo());
            }
        }

    }


    // function to insert into the database
    public function insertArticle($conn, $title, $content, $published_at){

        // Assign the form values to the object's properties
        $this->title = $title;
        $this->content = $content;
        $this->published_at = $published_at;

        // Validate the article before updating
        if ($this->validateArticle()) {

           // Prepare the SQL statement
           $sql = "INSERT INTO article (title, content, published_at) VALUES (:title, :content, :published_at)";
           $stmt = $conn->prepare($sql);


           if (!$stmt) {
               // Query failed
               $this->errors[] = "Query failed: " . implode(", ", $conn->errorInfo());
               echo "Query failed: " . implode(", ", $conn->errorInfo());
           } else {

               // Bind the parameters to the prepared statement
               $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
               $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
               $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);

               if ($stmt->execute()) {
                return $conn->lastInsertId();  // return last inserted id to be used while setting category

               } else {
                   // Error in executing the statement
                   $this->errors[] = "Error in inserting article: " . implode(", ", $conn->errorInfo());
                   echo "Error in inserting article: " . implode(", ", $conn->errorInfo());
               }
           }
       }else{

        // Validation failed
        return false;

       }

    }

    /**
     * Update the image file property
     * 
     * @param PDO $conn The PDO connection object.
     * @param string $filename The filename of the image file.
     * 
     * @return boolean True if it was succesful, falsee otherwise
     */

    # it wouldn't be a satic method because the method calls an article object
    public function setImageFile($conn, $filename){

        $sql = "UPDATE article SET image_file = :image_file WHERE id = :id";

        $stmt = $conn->prepare($sql);
        
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':image_file', $filename, $filename == null ? PDO::PARAM_NULL : PDO::PARAM_STR);

        return $stmt->execute();

    }

}
