<?php

require_once('../Database/connection_string.php');

$messageFailed = '';

// Load clients
try {
    $query = 'SELECT *
                FROM tbl_users
                INNER JOIN tbl_genders ON tbl_users.gender_id = tbl_genders.gender_id
                INNER JOIN tbl_user_roles ON tbl_users.user_role_id = tbl_user_roles.user_role_id
                WHERE role = "Client"
                ORDER BY first_name ASC;';
    
    $statement = $connection->prepare($query);

    if($statement->execute()) {
        $clients = $statement->fetchAll(PDO::FETCH_OBJ);
    }

    // Load genders
    $query = 'SELECT *
                FROM tbl_genders;';
    
    $statement = $connection->prepare($query);
    
    if($statement->execute()) {
        $genders = $statement->fetchAll(PDO::FETCH_OBJ);
    }

    // Load user roles
    $query = 'SELECT *
                FROM tbl_user_roles;';
    
    $statement = $connection->prepare($query);
    
    if($statement->execute()) {
        $userRoles = $statement->fetchAll(PDO::FETCH_OBJ);
    }
} catch(PDOException $exception) {
    $messageFailed = $exception->getMessage();
}

// Add client
if(isset($_POST['add_client'])) {
    try {
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $query = 'SELECT *
                    FROM tbl_user_roles
                    WHERE `role` = "Client";';

        $statement = $connection->prepare($query);

        if($statement->execute()) {
            $userRole = $statement->fetch(PDO::FETCH_OBJ);
        }

        $firstName = validate($_POST['first_name']);
        $middleName = validate($_POST['middle_name']);
        $lastName = validate($_POST['last_name']);
        $age = validate($_POST['age']);
        $genderId = validate($_POST['gender_id']);
        $email = validate($_POST['email']);
        $contactNumber = validate($_POST['contact_number']);
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);
        $confirmPassword = validate($_POST['confirm_password']);
        $userRoleId = validate($userRole->user_role_id);

        $query = 'INSERT INTO tbl_users(first_name, middle_name, last_name, age, gender_id, email, contact_number, username, `password`, user_role_id)
                    VALUES(:first_name, :middle_name, :last_name, :age, :gender_id, :email, :contact_number, :username, AES_ENCRYPT(:password, "s3cretp4as$w0rd!!"), :user_role_id);';

        if($password == $confirmPassword) {
            $statement = $connection->prepare($query);
            $statement->bindParam('first_name', $firstName, PDO::PARAM_STR);
            $statement->bindParam('middle_name', $middleName, PDO::PARAM_STR);
            $statement->bindParam('last_name', $lastName, PDO::PARAM_STR);
            $statement->bindParam('age', $age, PDO::PARAM_INT);
            $statement->bindParam('gender_id', $genderId, PDO::PARAM_INT);
            $statement->bindParam('email', $email, PDO::PARAM_STR);
            $statement->bindParam('contact_number', $contactNumber, PDO::PARAM_STR);
            $statement->bindParam('username', $username, PDO::PARAM_STR);
            $statement->bindParam('password', $password, PDO::PARAM_STR);
            $statement->bindParam('user_role_id', $userRoleId, PDO::PARAM_INT);

            if($statement->execute()) {
                header('location: add_client.php?messageSuccess=Client successfully saved!');
            }
        } else {
            $messageFailed = 'Password do not match!';
        }
    } catch(PDOException $exception) {
        $messageFailed = $exception->getMessage();
    }
}

// Get client
if(isset($_GET['client_id'])) {
    try {
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $userId = validate($_GET['client_id']);

        $query = 'SELECT *
                    FROM tbl_users
                    INNER JOIN tbl_genders ON tbl_users.gender_id = tbl_genders.gender_id
                    INNER JOIN tbl_user_roles ON tbl_users.user_role_id = tbl_user_roles.user_role_id 
                    WHERE user_id = :user_id;';
        
        $statement = $connection->prepare($query);
        $statement->bindParam('user_id', $userId, PDO::PARAM_INT);

        if($statement->execute()) {
            $client = $statement->fetch(PDO::FETCH_OBJ);
        }
    } catch(PDOException $exception) {
        $messageFailed = $exception->getMessage();
    }
}

// Update client
if(isset($_POST['edit_client'])) {
    try {
            function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $userId = validate($_GET['client_id']);

        $firstName = validate($_POST['first_name']);
        $middleName = validate($_POST['middle_name']);
        $lastName = validate($_POST['last_name']);
        $age = validate($_POST['age']);
        $genderId = validate($_POST['gender_id']);
        $email = validate($_POST['email']);
        $contactNumber = validate($_POST['contact_number']);
        $userRoleId = validate($_POST['user_role_id']);

        $query = 'UPDATE tbl_users
                    SET first_name = :first_name, middle_name = :middle_name, last_name = :last_name, age = :age, gender_id = :gender_id,
                    email = :email, contact_number = :contact_number, user_role_id = :user_role_id
                    WHERE user_id = :user_id;';

        $statement = $connection->prepare($query);
        $statement->bindParam('user_id', $userId, PDO::PARAM_INT);
        $statement->bindParam('first_name', $firstName, PDO::PARAM_STR);
        $statement->bindParam('middle_name', $middleName, PDO::PARAM_STR);
        $statement->bindParam('last_name', $lastName, PDO::PARAM_STR);
        $statement->bindParam('age', $age, PDO::PARAM_INT);
        $statement->bindParam('gender_id', $genderId, PDO::PARAM_INT);
        $statement->bindParam('email', $email, PDO::PARAM_STR);
        $statement->bindParam('contact_number', $contactNumber, PDO::PARAM_STR);
        $statement->bindParam('user_role_id', $userRoleId, PDO::PARAM_INT);

        if($statement->execute()) {
            header('location: list.php?messageSuccess=Client successfully updated!');
        }
    } catch(PDOException $exception) {
        $messageFailed = $exception->getMessage();
    }
}