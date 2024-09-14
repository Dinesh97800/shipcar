<?php
include(__DIR__ . '/../connection.php');
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
$enquiries = [];

if (isset($_GET['delete'])) {
    $countryId = $_GET['delete'];

    // Prepare and execute the delete statement
    $sql = "DELETE FROM countries WHERE id = $countryId";

    if ($con->query($sql) === TRUE) {
        header("Location: ../../dashboard/countries.php?status=update");
        exit();
    } else {
        // If an error occurs, you can redirect with an error message
        header("Location: ../../dashboard/countries.php?error=Failed+to+delete+country");
        exit();
    }
}

$query = "SELECT * from pdf_details ORDER BY id DESC";

$result = $con->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $enquiries[] = $row;
    }
}
