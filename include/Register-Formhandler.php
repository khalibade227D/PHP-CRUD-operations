<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pwd = trim($_POST['pwd']);

    try {
        require_once 'dbh.php';
        require_once 'Register-inc-Controller.php';

        if (Fields_are_empty($name, $email, $pwd)) {
            $_SESSION['register_error'] = 'Please fill in all fields.';
            header('Location: ../index.php');
            exit();
        }
        if (!pwd_had_8andmore($pwd)) {
            $_SESSION['register_error'] = 'Password must be at least 8 characters long.';
            header('Location: ../index.php');
            exit();
        }
        if (!is_email_valid($email)) {
            $_SESSION['register_error'] = 'Invalid email format.';
            header('Location: ../index.php');
            exit();
        }
        $query = "INSERT INTO user (name, email, pwd) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $name, $email, $hashedPwd);
        $stmt->execute();

        $stmt = null;
        $conn = null;
        $_SESSION['register_success'] = 'Account created successfully.';
        header('Location: ../index.php');
        exit();
    } catch (Mysqli_sql_exception $e) {
        $_SESSION['register_error'] = 'An error occurred. Please try again.';
        exit();
    }
} else {
    http_response_code(403);
    header('Location: ../index.php');
    exit();
}
