<?php
include('connection.php');


$makes = [];


$getCountrySql = "SELECT * FROM countries WHERE status = 'active'";
$getCountry = $con->query($getCountrySql);
$countries = [];
if ($getCountry->num_rows > 0) {
    while ($row = $getCountry->fetch_assoc()) {
        $countries[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['country_id'])) {
    $countryId = $_POST['country_id']; 
    $getPortsSql = "SELECT * FROM ports WHERE country_id = ? AND status = 'active'";
    $stmt = $con->prepare($getPortsSql);
    $stmt->bind_param("i", $countryId); 
    $stmt->execute();
    $result = $stmt->get_result();

    $ports = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ports[] = $row;
        }
    }

    echo json_encode(['ports' => $ports]);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
    $type = $_POST['type']; 
    $getMakeSql = "SELECT * FROM car_details WHERE status = 'active' AND `type` = '$type' AND (not model = '' OR not model = '-')";
    $getMakes = $con->query($getMakeSql);

    if ($getMakes->num_rows > 0) {
        while ($row = $getMakes->fetch_assoc()) {
            $makes[] = $row;
        }
    }

    echo json_encode(['makes' => $makes]);
    exit;
}

?>