<?php
include(__DIR__ . '/../connection.php');
include(__DIR__ . '/../send_email.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = "";
$users = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $name = $con->real_escape_string($_POST['name']);
    $email = $con->real_escape_string($_POST['email']);
    $selected_retailer = $con->real_escape_string($_POST['retailer']);  // Use a different variable name to avoid overwriting

    if (!$name || !$email || !$selected_retailer) {
        $error = "All fields are mandatory.";
        header("Location: ../dashboard/users.php?error=" . urlencode($error) . "&name=" . urlencode($name) . "&email=" . urlencode($email));
        exit();
    }

    $email_check_sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $con->query($email_check_sql);
    if ($result->num_rows > 0) {
        // Email already exists
        $error = "An account with this email already exists.";
        header("Location: ../../dashboard/users.php?error=" . urlencode($error) . "&name=" . urlencode($name) . "&email=" . urlencode($email));
        exit();
    }

    $random_password = bin2hex(random_bytes(8));
    $hashed_password = password_hash($random_password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password, accountType) VALUES ('$name', '$email', '$hashed_password', 'user')";
    if ($con->query($sql) === TRUE) {
        $last_inserted_id = $con->insert_id;
        echo $last_inserted_id;
        $sql = "INSERT INTO assigned_distributor (user1, user2, type) VALUES ('$last_inserted_id', '$selected_retailer', 'retailer')";
        if ($con->query($sql) === TRUE) {
            echo otpemail($email, $name, $random_password);
            header("Location: ../../dashboard/users.php?status=created");
            exit();
        } else {
            $error = "Error: " . $con->error;
            header("Location: ../../dashboard/users.php?error=" . urlencode($error));
            exit();
        }
    } else {
        // Error handling
        $error = "Error: " . $con->error;
        header("Location: ../../dashboard/users.php?error=" . urlencode($error) . "&name=" . urlencode($name) . "&email=" . urlencode($email));
        exit();
    }
}

// Fetch retailers
$query = "
SELECT *,
(SELECT u.name 
 FROM assigned_distributor ad
 JOIN users AS u ON u.id = ad.user2 
 WHERE ad.user1 = users.id 
 AND type = 'retailer') AS retailer,

(SELECT u.shop 
 FROM assigned_distributor ad
 JOIN users AS u ON u.id = ad.user2 
 WHERE ad.user1 = users.id 
 AND type = 'retailer') AS retailerShop,

(SELECT user2 
 FROM assigned_distributor ad
 WHERE ad.user1 = users.id 
 AND ad.type = 'retailer') AS retailerId,

(SELECT u.name
 FROM assigned_distributor 
 JOIN users AS u ON u.id = assigned_distributor.user2 
 WHERE assigned_distributor.user1 = retailerId 
 AND type = 'distributor') AS distributor 

FROM users 
WHERE accountType = 'user' 
ORDER BY id DESC";

$result = $con->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$retailerArray =[];

$retailer_query = "SELECT * FROM users WHERE accountType = 'retailer' ORDER BY id DESC";
$retailer_result = $con->query($retailer_query);
if ($retailer_result->num_rows > 0) {
    while ($row = $retailer_result->fetch_assoc()) {
        $retailerArray[] = $row;  // Use $distributors to store the result
    }
}
?>
