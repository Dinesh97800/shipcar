<?php
// Include the database connection
include(__DIR__.'./connection.php');
$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE id = $userId";
$result = $con->query($sql);

$userData = $result->fetch_object();
?>