<?php
session_start();

require_once('./Database/connection_string.php');

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$messageSuccess = '';
$messageFailed = '';

if(isset($_POST['save'])) {
    try {
        $category = validate($_POST['category']);
        $query = 'INSERT INTO categories(`name`)
                                    VALUES(:category);';
        
        $statement = $connection->prepare($query);
        $statement->bindParam('category', $category, PDO::PARAM_STR);

        if($statement->execute()) {
            $messageSuccess = 'Category successfully saved!';
        }
    } catch(PDOException $exception) {
        $messageFailed = $exception->getMessage();
    }
}