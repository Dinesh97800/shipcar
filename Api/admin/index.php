<?php
include(__DIR__ . '/../connection.php');
include(__DIR__ . '/../send_email.php');
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$error = "";
$pieChart = array(
    'user' => 0,
    'distributor' => 0,
    'retailer' => 0
);

$query = "SELECT accountType, COUNT(id) as count FROM users GROUP BY accountType";
$result = $con->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $accountType = $row['accountType'];
        $count = $row['count'];
        if (isset($pieChart[$accountType])) {
            $pieChart[$accountType] = $count;
        }
    }
}
?>