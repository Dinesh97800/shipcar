<?php
header('Content-Type: application/json');
include(__DIR__ . '/../connection.php');
$portId = isset($_POST['id']) ? intval($_POST['id']) : null;

if ($portId === null) {
    header("Location: ../../dashboard/countries.php?status=fail&message=" . urlencode("Port ID is required."));
    exit();
}
$query = $con->prepare("DELETE FROM ports WHERE id = ?");
$success = $query->execute([$portId]);
$message = $success ? 'Port deleted successfully.' : 'Failed to delete port.';
$status = $success ? 'success' : 'fail';
header("Location: ../../dashboard/countries.php?status=$status&message=" . urlencode($message));
exit();
