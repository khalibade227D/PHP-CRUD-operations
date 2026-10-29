
<?php
session_start();

require_once 'dbh.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit();
}
if (!isset($_POST['DeleteBTN'])) {
    exit('Delete button was not submitted.');
}
$id = $_POST['id'];
$query = "DELETE FROM user WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();

// Check whether a user was deleted.
if ($stmt->affected_rows > 0) {
    $stmt->close();

    header("Location: ../Admin.php?deleted=success");
    exit;
}

$stmt->close();

header("Location: ../Admin.php?deleted=notfound");
exit;
