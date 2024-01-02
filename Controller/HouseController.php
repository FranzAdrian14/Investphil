<?php

require_once('../Database/connection_string.php');

$messageFailed = '';

try {
    // Load house
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

// Get house
if(isset($_GET['house_id'])) {
    try {
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $houseId = $_GET['house_id'];

        $query = 'SELECT *
                    FROM tbl_houses
                    INNER JOIN tbl_categories ON tbl_houses.category_id = tbl_categories.category_id
                    WHERE house_id = :house_id;';
        
        $statement = $connection->prepare($query);
        $statement->bindParam('house_id', $houseId, PDO::PARAM_INT);

        if($statement->execute()) {
            $house = $statement->fetch(PDO::FETCH_OBJ);
        }
    } catch(PDOException $exception) {
        $messageFailed = $exception->getMessage();
    }
}

// Add house
if(isset($_POST['add_house'])) {
    try {
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $houseNo = validate($_POST['house_no']);
        $categoryId = validate($_POST['category_id']);
        $description = validate($_POST['description']);
        $price = validate($_POST['price']);

        $query = 'INSERT INTO tbl_houses(house_no, category_id, `description`, price)
                                    VALUES(:house_no, :category_id, :description, :price);';

        $statement = $connection->prepare($query);
        $statement->bindParam('house_no', $houseNo, PDO::PARAM_STR);
        $statement->bindParam('category_id', $categoryId, PDO::PARAM_INT);
        $statement->bindParam('description', $description, PDO::PARAM_STR);
        $statement->bindParam('price', $price, PDO::PARAM_STR);

        if($statement->execute()) {
            header('location: add.php?messageSuccess=House successfully added!');
        }
    } catch(PDOException $exception) {
        $messageFailed = $exception->getMessage();
    }         
}

// Update house
if(isset($_POST['edit_house'])) {
    try {
        $houseId = validate($_GET['house_id']);

        $houseNo = validate($_POST['house_no']);
        $categoryId = validate($_POST['category_id']);
        $description = validate($_POST['description']);
        $price = validate($_POST['price']);

        $query = 'UPDATE tbl_houses
                    SET house_no = :house_no, category_id = :category_id, `description` = :description, price = :price
                    WHERE house_id = :house_id;';
        
        $statement = $connection->prepare($query);
        $statement->bindParam('house_id', $houseId, PDO::PARAM_INT);
        $statement->bindParam('house_no', $houseNo, PDO::PARAM_STR);
        $statement->bindParam('category_id', $categoryId, PDO::PARAM_INT);
        $statement->bindParam('description', $description, PDO::PARAM_STR);
        $statement->bindParam('price', $price, PDO::PARAM_STR);

        if($statement->execute()) {
            header('location: add.php?messageSuccess=House successfully updated!');
        }
    } catch(PDOException $exception) {
        $messageFailed = $exception->getMessage();
    }
}