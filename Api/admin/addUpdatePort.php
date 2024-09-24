<?php
header('Content-Type: application/json');
include(__DIR__ . '/../connection.php');
$portId = isset($_POST['portId']) ? intval($_POST['portId']) : null;
$portName = isset($_POST['portNameInput']) ? trim($_POST['portNameInput']) : '';
$countryId = isset($_POST['countryId']) ? intval($_POST['countryId']) : null;

if ($portName === '' || $countryId === null) {
    header("Location: ../../dashboard/countries.php?status=fail&message=" . urlencode("Missing required fields."));
    exit();
}

if ($portId) {
    $query = $con->prepare("UPDATE ports SET name = ?, country_id = ? WHERE id = ?");
    $success = $query->execute([$portName, $countryId, $portId]);
    $message = $success ? 'Port updated successfully.' : 'Failed to update port.';
} else {
    $query = $con->prepare("INSERT INTO ports (name, country_id) VALUES (?, ?)");
    $success = $query->execute([$portName, $countryId]);
    $message = $success ? 'Port added successfully.' : 'Failed to add port.';
}
// Redirect with success or failure message
$status = $success ? 'success' : 'fail';
header("Location: ../../dashboard/countries.php?status=$status&message=" . urlencode($message));
exit();
