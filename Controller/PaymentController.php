<?php
session_start();

require_once('../Database/connection_string.php');

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

try {
    // Load all payments
    $query = 'SELECT *, tbl_payments.created_at
                FROM tbl_payments
                INNER JOIN tbl_users ON tbl_payments.user_id = tbl_users.user_id
                INNER JOIN tbl_houses ON tbl_payments.house_id = tbl_houses.house_id
                tbl_payments.payment_id DESC;';

    $statement = $connection->prepare($query);

    if($statement->execute()) {
        $payments = $statement->fetchAll(PDO::FETCH_OBJ);
    }

    // Get payment
    if(isset($_GET['payment_id'])) {
        $paymentId = validate($_GET['payment_id']);

        $query = 'SELECT *
                    FROM payments
                    WHERE id = :payment_id;';

        $statement = $connection->prepare($query);
        $statement->bindParam('payment_id', $paymentId, PDO::PARAM_INT);

        if($statement->execute()) {
            $payment = $statement->fetch(PDO::FETCH_OBJ);
        }
    }
} catch(PDOException $exception) {
    $messageFailed = $exception->getMessage();
}