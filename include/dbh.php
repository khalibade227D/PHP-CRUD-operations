<?php



$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'userdb';


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $user, $pass, $dbname);
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    exit('Connection Failed.');
}
