<?php
include(__DIR__ . '/../connection.php');
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
$countries = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $name = $_POST['name'];
    if (!$name ) {
        $error = "Country name is mandatory.";
        header("Location: ../dashboard/countries.php?error=" . urlencode($error) . "&name=" . urlencode($name));
        exit();
    }

    $country_check_sql = "SELECT * FROM countries WHERE name = '$name'";
    $result = $con->query($country_check_sql);
    if ($result->num_rows > 0) {
        // Email already exists
        $error = "Country name already exists.";
        header("Location: ../../dashboard/countries.php?error=" . urlencode($error) . "&name=" . urlencode($name) . "&email=" . urlencode($email));
        exit();
    }

    $sql = "INSERT INTO countries (name) VALUES ('$name')";
    if ($con->query($sql) === TRUE) {
        header("Location: ../../dashboard/countries.php?status=created");
        exit();
    } else {
        // Error handling
        $error = "Error: " . $con->error;
        header("Location: ../../dashboard/countries.php?error=" . urlencode($error) . "&name=" . urlencode($name));
        exit();
    }

}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $name = $_POST['name'];
    $id = $_POST['id'];
    if (!$name ) {
        $error = "Country name is mandatory.";
        header("Location: ../dashboard/countries.php?error=" . urlencode($error) . "&name=" . urlencode($name));
        exit();
    }


    $country_check_sql = "SELECT * FROM countries WHERE name = '$name'";
    $result = $con->query($country_check_sql);
    if ($result->num_rows > 0) {
        // Email already exists
        $error = "Country name already exists.";
        header("Location: ../../dashboard/countries.php?error=" . urlencode($error) . "&name=" . urlencode($name) . "&email=" . urlencode($email));
        exit();
    }

    $sql = "Update countries set name = '$name' WHERE id = $id";
    if ($con->query($sql) === TRUE) {
        header("Location: ../../dashboard/countries.php?status=created");
        exit();
    } else {
        // Error handling
        $error = "Error: " . $con->error;
        header("Location: ../../dashboard/countries.php?error=" . urlencode($error) . "&name=" . urlencode($name));
        exit();
    }

}

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

$query = "SELECT * from countries ORDER BY id DESC";

$result = $con->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $countries[] = $row;
    }
}
