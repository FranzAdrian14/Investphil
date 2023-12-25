<?php
require_once('./Database/connection_string.php');

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$messageSuccess = '';
$messageFailed = '';

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

if(isset($_POST['save'])) {
    try {
        $category = validate($_POST['category']);
        $query = 'INSERT INTO tbl_categories(category)
                                    VALUES(:category);';
        
        $statement = $connection->prepare($query);
        $statement->bindParam('category', $category, PDO::PARAM_STR);

        if($statement->execute()) {
            header('location: categories.php');
        }
    } catch(PDOException $exception) {
        $messageFailed = $exception->getMessage();
    }
}