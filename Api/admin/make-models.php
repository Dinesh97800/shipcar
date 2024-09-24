<?php
include(__DIR__ . '/../connection.php');
$makeModels = [];


$query = "SELECT * FROM car_details WHERE model != '' AND model != '-' AND model != '..' ORDER BY id DESC";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $model = $_POST['model'];
    $length_cm = $_POST['length_cm'];
    $width_cm = $_POST['width_cm'];
    $height_cm = $_POST['height_cm'];
    $weight_kg = $_POST['weight_kg'];
    $type = $_POST['type'];
    if (!$model || !$length_cm || !$width_cm || !$height_cm || !$weight_kg || !$type) {
        $error = "All fields are mandatory.";
        header("Location: ../dashboard/make-models.php?error=" . urlencode($error));
        exit();
    }

    $country_check_sql = "SELECT * FROM car_details WHERE model = '$model'";
    $result = $con->query($country_check_sql);
    if ($result->num_rows > 0) {
        $error = "Make/Model already exists.";
        header("Location: ../../dashboard/make-models.php?error=" . urlencode($error));
        exit();
    }

    $sql = "INSERT INTO car_details (model,length_cm,width_cm,height_cm,weight_kg,type,status) VALUES ('$model','$length_cm','$width_cm','$height_cm','$weight_kg','$type','active')";
    if ($con->query($sql) === TRUE) {
        header("Location: ../../dashboard/make-models.php?status=created");
        exit();
    } else {
        // Error handling
        $error = "Error: " . $con->error;
        header("Location: ../../dashboard/make-models.php?error=" . urlencode($error));
        exit();
    }

}

if (isset($_GET['delete'])) {
    $modelId = $_GET['delete'];

    // Prepare and execute the delete statement
    $sql = "DELETE FROM car_details WHERE id = $modelId";

    if ($con->query($sql) === TRUE) {
        header("Location: ../../dashboard/make-models.php?status=update");
        exit();
    } else {
        // If an error occurs, you can redirect with an error message
        header("Location: ../../dashboard/make-models.php?error=Failed+to+delete+country");
        exit();
    }
}


$result = $con->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $makeModels[] = $row;
    }
}

?>