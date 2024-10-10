<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include(__DIR__ . '/./sendMail.php');

// Variables to hold default car dimensions
$length_cm = 450;
$width_cm = 180;
$height_cm = 140;
$weight_kg = 1500;

$base_rate = 130; // EUR per W/M (Weight/Measurement) as an example
$additional_rate = 15.50; // EUR per W/M
$handling_fee = 70; // Additional fixed cost (e.g. for saloon)
$destination_fee = 80; // Example destination fee in EUR
$rate_per_cbm = 0.58; // Per CBM rate in EUR
// Database connection
$con = new mysqli("localhost", "root", "Dinesh@97", "shippingcar");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve vehicle type
    $type = isset($_POST['car_type']) ? $con->real_escape_string($_POST['car_type']) : '';
    $vehicle_type = $type;

    // Prepare an array for the response
    $response = array();

    // Check if new_make is provided
    if (isset($_POST['new_make']) && !empty($_POST['new_make'])) {
        $new_make = $con->real_escape_string($_POST['new_make']);

        // Retrieve dimensions or use default values
        $length_cm = isset($_POST['length_cm']) ? (float) $_POST['length_cm'] : 450;
        $width_cm = isset($_POST['width_cm']) ? (float) $_POST['width_cm'] : 180;
        $height_cm = isset($_POST['height_cm']) ? (float) $_POST['height_cm'] : 140;
        $weight_kg = isset($_POST['weight_kg']) ? (int) $_POST['weight_kg'] : $weight_kg;

        $length_m = $length_cm / 100;
        $width_m = $width_cm / 100;
        $height_m = $height_cm / 100;

        $volume_m3 = ($length_m * $width_m * $height_m);

        // Insert new car details into the database
        $sql = "INSERT INTO car_details (model, length_cm, width_cm, height_cm, weight_kg, type, CBM) 
                VALUES ('$new_make', '$length_cm', '$width_cm', '$height_cm', '$weight_kg', '$vehicle_type', '$volume_m3')";
        echo $sql;
        if ($con->query($sql) === TRUE) {
            $inserted_id = $con->insert_id;

            // Fetch the inserted object from the database
            $sql = "SELECT * FROM car_details WHERE id = '$inserted_id'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                $inserted_object = $result->fetch_object();
                $response['success'] = true;
                $response['message'] = 'New make inserted successfully.';
                $response['model'] = $inserted_object;
            } else {
                $response['success'] = false;
                $response['message'] = 'Error fetching the inserted make details.';
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error inserting new make: ' . $con->error]);
            exit;
        }

    } else {
        // Retrieve existing model data
        $model = isset($_POST['make']) ? (int) $_POST['make'] : '';

        // Select car details for the existing model
        $sql = "SELECT * FROM car_details WHERE id = $model";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            $modelData = $result->fetch_object();

            $weight_kg = (int) $modelData->weight_kg;
            $length_m = (float) $modelData->length_cm / 100;
            $width_m = (float) $modelData->width_cm / 100;
            $height_m = $modelData->height_cm / 100;
    
            $volume_m3 = ($length_m * $width_m * $height_m);

            // Add model data to the response
            $response['model'] = $modelData;
        } else {
            echo json_encode(['success' => false, 'message' => 'Model not found.']);
            exit;
        }
    }


    if (isset($_POST['new_country']) && !empty($_POST['new_country'])) {
        $new_country = $con->real_escape_string($_POST['new_country']);
        $new_port = $con->real_escape_string($_POST['new_port']);

        $sql = "INSERT INTO countries (name) VALUES ('$new_country')";

        if ($con->query($sql) === TRUE) {
            $inserted_id = $con->insert_id;
            $sqlPort = "INSERT INTO ports (country_id,name) VALUES ($inserted_id,'$new_port')";
            $con->query($sqlPort);
            $portId = $con->insert_id;
            // Fetch the inserted object from the database
            $sql = "SELECT * FROM countries WHERE id = '$inserted_id'";
            $result = $con->query($sql);
            $response['country'] = $result->fetch_object();

            $sqlports = "SELECT * FROM ports WHERE id = '$portId'";
            $result = $con->query($sql);
            $response['port'] = $result->fetch_object();

        }
    } else {
        $country = isset($_POST['country']) ? (int) $_POST['country'] : '';
        $port = isset($_POST['port']) ? (int) $_POST['port'] : '';

        // Select car details for the existing model
        $sql = "SELECT * FROM countries WHERE id = $country";
        $result = $con->query($sql);
        $response['country'] = $result->fetch_object();

        $sqlports = "SELECT * FROM ports WHERE id = '$port'";
        $result = $con->query($sql);
        $response['port'] = $result->fetch_object();
    }



    
    
    
    $response['length'] = $length_m;
    $response['width'] = $width_m;
    $response['height'] = $height_m;
    $response['weight'] = $weight_kg;
    $response['volume'] = $volume_m3;
    $total_cost = ($base_rate + $additional_rate + $rate_per_cbm) * $volume_m3 + $handling_fee + $destination_fee;
    $response['total_cost'] = $total_cost;
   // Correctly access the model, country, and port
    $model = isset($response['model']) ? $response['model']->model : null;
    $country = isset($response['country']) ? $response['country']->name : null;
    $port = isset($response['port']) ? $response['port']->name : null;

    $email = $con->real_escape_string($_POST['email']);

    sendpdf($email, $model, $country, $port, $length_m, $width_m, $height_m, $volume_m3, $weight_kg, $total_cost);
    $responseArray = array(
        'status' => true,
        'message' => 'PDF created and email sent successfully.',
        'model' => $model,
        'country' => $country,
        'port' => $port,
        'length_m' => $length_m,
        'width_m' => $width_m,
        'height_m' => $height_m,
        'volume_m3' => $volume_m3,
        'weight_kg' => $weight_kg,
        'total_cost' => $total_cost
    );    
    // echo json_encode(array_merge(['status' => true, 'message' => 'PDF created and email sent successfully.'], $responseArray));
     // Return JSON response
    //  echo json_encode($response);
    header("Location: success.php?total_cost=" . urlencode($total_cost));
    // $con->close();

}

// $con->close();

?>