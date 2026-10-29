<?php
session_start();

require_once 'dbh.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $check = $conn->prepare("SELECT id FROM user WHERE id = ?");
    $check->bind_param("i", $id);
    $check->execute();
    $exists = $check->get_result()->num_rows > 0;
    $check->close();

    if (!$exists) {
        $error = 'User not found.';
    } else {
        $query = "UPDATE user SET name = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $name, $email, $id);

        try {
            $stmt->execute();
            $stmt->close();

            header("Location: ../Admin.php");
            exit;
        } catch (mysqli_sql_exception $e) {
            $stmt->close();
            $error = 'Could not update the user. Check whether the email is already in use.';
        }
    }
}

$stmt = $conn->prepare(
    "SELECT id, name, email FROM user WHERE id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
