<?php
// Include the database connection
include('./connection.php');

// Start the session
session_start();

$error = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the form data
    if (!$email || !$password) {
        $error = "All fields are mandatory.";
    } else {
        // Check if the email exists
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            // Fetch the user data
            $user = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Store the user ID in the session
                $_SESSION['user_id'] = $user['id'];
                header("Location: ../dashboard");
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Invalid email or password.";
        }
    }

    if ($error) {
        // Redirect back to the login page with error and input data
        header("Location: ../dashboard/signin.php?error=" . urlencode($error) . "&email=" . urlencode($email));
        exit();
    }
}
?>