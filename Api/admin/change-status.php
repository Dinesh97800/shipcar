<?php
include('../connection.php');
// echo "hi";
$conn = $con;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['type'])) {
    $id = (int) $_POST['id'];
    $status = $_POST['status'];
    if($_POST['type'] == "model"){
        $query = "SELECT * FROM car_details WHERE id = $id";
        $result = $con->query($query);
        if ($result->num_rows > 0) {
            $car = $result->fetch_assoc();
            $model = $car['model'];
            $checkMatchQuery = "SELECT * FROM car_details WHERE model = '$model' AND id != $id";
            $checkMatchResult = $conn->query($checkMatchQuery);
            if ($checkMatchResult->num_rows > 0) {
                $deleteQuery = "DELETE FROM car_details WHERE model = '$model' AND id != $id";
                $conn->query($deleteQuery);
            }
            $updateQuery = "UPDATE car_details SET status = '$status' WHERE id = $id";
            if ($conn->query($updateQuery)) {
                echo json_encode(["status" => true, "message" => "Status updated successfully."]);
            } else {
                echo json_encode(["status" => false, "message" => "Failed to update status."]);
            }
        } else {
            echo json_encode(["status" => false, "message" => "No car found with the given ID."]);
        }
    }

    if($_POST['type'] == "country"){
        $query = "SELECT * FROM countries WHERE id = $id";
        $result = $con->query($query);
        if ($result->num_rows > 0) {
            $car = $result->fetch_assoc();
            $name = $car['name'];
            $checkMatchQuery = "SELECT * FROM countries WHERE name = '$name' AND id != $id";
            $checkMatchResult = $conn->query($checkMatchQuery);
            if ($checkMatchResult->num_rows > 0) {
                $deleteQuery = "DELETE FROM countries WHERE name = '$name' AND id != $id";
                $conn->query($deleteQuery);
            }
            $updateQuery = "UPDATE countries SET status = '$status' WHERE id = $id";
            if ($conn->query($updateQuery)) {
                echo json_encode(["status" => true, "message" => "Status updated successfully."]);
            } else {
                echo json_encode(["status" => false, "message" => "Failed to update status."]);
            }
        } else {
            echo json_encode(["status" => false, "message" => "No country found with the given ID."]);
        }
    }


    if($_POST['type'] == "port"){
        $query = "SELECT * ports WHERE id = $id";
            $result = $con->query($query);
            if ($result->num_rows > 0) {
                $car = $result->fetch_assoc();
                $model = $car['model'];
                $checkMatchQuery = "SELECT * FROM ports WHERE name = '$model' AND id != $id";
                $checkMatchResult = $conn->query($checkMatchQuery);
                if ($checkMatchResult->num_rows > 0) {
                    $deleteQuery = "DELETE FROM ports WHERE name = '$model' AND id != $id";
                    $conn->query($deleteQuery);
                }
                $updateQuery = "UPDATE ports SET status = '$status' WHERE id = $id";
                if ($conn->query($updateQuery)) {
                    echo json_encode(["status" => true, "message" => "Status updated successfully."]);
                } else {
                    echo json_encode(["status" => false, "message" => "Failed to update status."]);
                }
            } else {
                echo json_encode(["status" => false, "message" => "No ports found with the given ID."]);
            }
    }

    
}

?>