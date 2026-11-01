<?php
require __DIR__ . '/include/auth.php';
$_SESSION = [];
session_destroy();

header('Location: loginpage.php');
die();
