<?php

require_once('./Database/connection_string.php');

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$messageFailed = '';

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

} catch(PDOException $exception) {
    $messageFailed = $exception->getMessage();
}   