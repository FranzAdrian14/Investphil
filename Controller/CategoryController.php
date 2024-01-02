<?php
require_once('../Database/connection_string.php');

$messageFailed = '';

// Load categories
try {
    $query = 'SELECT *
                FROM tbl_categories;
                ORDER BY category ASC;';

    $statement = $connection->prepare($query);
    if($statement->execute()) {
        $categories = $statement->fetchAll(PDO::FETCH_OBJ);   
    }
} catch(PDOException $exception) {
    $messageFailed = $exception->getMessage();
}

// Add category
if(isset($_POST['save_category'])) {
    try {
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $category = validate($_POST['category']);
        $query = 'INSERT INTO tbl_categories(category)
                                    VALUES(:category);';
        
        $statement = $connection->prepare($query);
        $statement->bindParam('category', $category, PDO::PARAM_STR);

        if($statement->execute()) {
            header('location: categories.php?messageSuccess=Category successfully added!');
        }
    } catch(PDOException $exception) {
        $messageFailed = $exception->getMessage();
    }
}