<?php
include(__DIR__ . '/Api/connection.php');

if (isset($_GET['country_id'])) {
    $country_id = $_GET['country_id'];
    $sql = "SELECT * FROM ports WHERE country_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $country_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === FALSE) {
        echo json_encode([]);
        $con->close();
        die;
    }
    $ports = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($ports);
    $con->close();
}
?>
