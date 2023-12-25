<?php

require_once('./Database/connection_string.php');

$messageFailed = '';

try {
    $query = 'SELECT *
                FROM tbl_houses
                INNER JOIN tbl_categories ON tbl_houses.category_id = tbl_categories.category_id
                ORDER BY category AND house_no ASC;';
    
    $statement = $connection->prepare($query);
    if($statement->execute()) {
        $houses = $statement->fetchAll(PDO::FETCH_OBJ);
    }
} catch(PDOException $exception) {
    $messageFailed = $exception->getMessage();
}

if(isset($_POST['save'])) {
    try {
        $houseNo = validate($_POST['house_no']);
        $categoryId = validate($_POST['category_id']);
        $desription = validate($_POST['description']);
        $price = validate($_POST['price']);

        $query = 'INSERT INTO tbl_houses(house_no, category_id, `description`, price)
                                    VALUES(:house_no, :category_id, :description, :price);';

        $statement = $connection->prepare($query);
        $statement->bindParam('house_no', $houseNo, PDO::PARAM_STR);
        $statement->bindParam('category_id', $categoryId, PDO::PARAM_INT);
        $statement->bindParam('description', $desription, PDO::PARAM_STR);
        $statement->bindParam('price', $price, PDO::PARAM_STR);

        if($statement->execute()) {
            header('location: houses.php');
        }         
    } catch(PDOException $exception) {
        $messageFailed = $exception->getMessage();
    }
}