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
                FROM tbl_genders;';
    
    $statement = $connection->prepare($query);
    
    if($statement->execute()) {
        $genders = $statement->fetchAll(PDO::FETCH_OBJ);
    }
} catch(PDOException $exception) {
    $messageFailed = $exception->getMessage();
}

try {
    $query = 'SELECT *
                FROM tbl_user_roles
                WHERE user_role_id >= 2;';
    
    $statement = $connection->prepare($query);
    
    if($statement->execute()) {
        $userRoles = $statement->fetchAll(PDO::FETCH_OBJ);
    }
} catch(PDOException $exception) {
    $messageFailed = $exception->getMessage();
}

if(isset($_POST['save'])) {
    try {
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
        $userRoleId = validate($_POST['user_role_id']);

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
                $messageSuccess = 'User successfully created!';
            }
        } else {
            $messageFailed = 'Password do not match!';
        }
    } catch(PDOException $exception) {
        $messageFailed = $exception->getMessage();
    }
}
