<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit();
}

$email = $_POST['email'];
$Npwd = $_POST['Npwd'];
$Cpwd = $_POST['Cpwd'];

try {


if($Npwd !== $Cpwd){
    $_SESSION['error'] = "The password dosen't match!"; 
    echo 'mismatch';
    //  header('Location: ../Forgotpassword.php');
    //         exit();
}

require 'dbh.php';
$query = "SELECT * FROM user WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s",$email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();



if(!$user){
 $_SESSION['error'] = "Email not found!"; 

 echo 'not found';
    //  header('Location: ../Forgotpassword.php');
    //         exit();
}
        $email = $user['email'];
        $hashpwd = password_hash($Npwd, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('UPDATE user SET pwd = ? WHERE email = ?');
        $stmt->bind_param('ss', $hashpwd, $email);
        $stmt->execute();
        $_SESSION['Success'] = "Password changed Successfully"; 
        // header('Location: ../Forgotpassword.php');
        //     exit();
        echo 'success';
      



} catch (Mysqli_sql_exception  $e){
      $_SESSION['error'] = 'Query failed. Please try again.';
        //   header('Location: ../Forgotpassword.php');
        //     exit();

        echo 'Query Failed';
}