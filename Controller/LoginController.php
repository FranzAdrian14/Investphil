<?php
session_start();

require_once('./Database/connection_string.php');

$messageFailed = '';

if(isset($_POST['login'])) {
    try {
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $username = validate($_POST['username']);
        $password = validate($_POST['password']);
    
        $query = 'SELECT *
                    FROM tbl_users
                    INNER JOIN tbl_genders ON tbl_users.gender_id = tbl_genders.gender_id
                    INNER JOIN tbl_user_roles ON tbl_users.user_role_id = tbl_user_roles.user_role_id
                    WHERE username = :username AND CAST(AES_DECRYPT(`password`, "s3cretp4as$w0rd!!") AS CHAR) = :password;';
        
        $statement = $connection->prepare($query);
        $statement->bindParam('username', $username, PDO::PARAM_STR);
        $statement->bindParam('password', $password, PDO::PARAM_STR);

        if($statement->execute()) {
            $user = $statement->fetch(PDO::FETCH_OBJ);

            if($statement->rowCount() > 0) {
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['first_name'] = $user->first_name;
                $_SESSION['middle_name'] = $user->middle_name;
                $_SESSION['last_name'] = $user->last_name;
                $_SESSION['age'] = $user->age;
                $_SESSION['gender'] = $user->gender;
                $_SESSION['email'] = $user->email;
                $_SESSION['contact_number'] = $user->contact_number;
                $_SESSION['username'] = $user->username;
                $_SESSION['password'] = $user->password;
                $_SESSION['role'] = $user->role;

                if(empty($user->middle_name)) {
                    $_SESSION['full_name'] = $user->first_name . ' ' . $user->last_name;
                } else {
                    $_SESSION['full_name'] = $user->first_name . ' ' . $user->middle_name[0] . '. ' . $user->last_name;
                }

                $_SESSION['isLoggedIn'] = true;

                header('location: index.php');
            } else {
                $messageFailed = 'Username or password is incorrect!';
            }
        }
    } catch(PDOException $exception) {
        $messageFailed = $exception->getMessage();
    }
}