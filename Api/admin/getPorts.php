<?php
header('Content-Type: application/json');
include(__DIR__ . '/../connection.php');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$countryId = intval($_GET['country_id']); // Ensure the input is an integer for security

// Prepare and execute the query
$query = $con->prepare("SELECT * FROM ports WHERE country_id = ?");
$query->bind_param("i", $countryId); // "i" denotes the type is integer
$query->execute();
$result = $query->get_result();

// Fetch all rows
$ports = $result->fetch_all(MYSQLI_ASSOC);

// Output the result as JSON
echo json_encode($ports);
