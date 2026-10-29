<?php
require_once 'dbh.php';
if (isset($_POST['addUser'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $query = "INSERT INTO user (name, email, pwd) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $stmt->bind_param("sss", $name, $email, $hashedPwd);
    $stmt->execute();
    header('Location: ../Admin.php');
    exit;
}
