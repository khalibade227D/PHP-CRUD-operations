<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $pwd = $_POST['pwd'];

    try {
        require 'dbh.php';
        require 'login-inc-Controller.php';

        if (Fields_are_empty($email, $pwd)) {
            $_SESSION['login_error'] = 'Please fill in all fields.';
            header('Location: ../loginpage.php');
            exit();
        }
        if (!pwd_had_8andmore($pwd)) {
            $_SESSION['login_error'] = 'Password must be at least 8 characters long.';
            header('Location: ../loginpage.php');
            exit();
        }
        if (!is_email_valid($email)) {
            $_SESSION['login_error'] = 'Invalid email format.';
            header('Location: ../loginpage.php');
            exit();
        }


        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result && password_verify($pwd, $result['pwd'])) {
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['user_name'] = $result['name'];
            $_SESSION['user_email'] = $result['email'];

         
            if ((int) $result['id'] === 1 && $result['name'] === 'admin') {
                header('Location: ../Admin.php');
            } else {
                header('Location: ../dashboard.php');
            }
            exit();
        } else {
            $_SESSION['login_error'] = 'Account not found or incorrect password.';
            header('Location: ../loginpage.php');
            exit();
        }
    } catch (Mysqli_sql_exception $e) {
        $_SESSION['login_error'] = 'Query failed. Please try again.';
        header('Location: ../loginpage.php');
        exit();
    }
} else {
    header('Location: ../loginpage.php');
    exit();
}
