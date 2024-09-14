<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include(__DIR__.'/../Api/connection.php');
// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);

$current_server_page = $_SERVER['PHP_SELF'];
$target_path = '/dashboard/index.php';

// Function to normalize a path
function normalize_path($path) {
    // Extract the path component
    $path = parse_url($path, PHP_URL_PATH);
    
    // Convert backslashes to forward slashes (for consistency)
    $path = str_replace('\\', '/', $path);
    
    // Remove any redundant slashes
    $path = preg_replace('/\/+/', '/', $path);
    
    return $path;
}

// Normalize the current page path
$normalized_current_page = normalize_path($current_server_page);
$normalized_target_path = normalize_path($target_path);

if (!isset($_SESSION['user_id'])) {
    $accessible_pages = ['index.php', 'signin.php', 'signup.php', 'about.php', 'contact.php'];

    if (!in_array($current_page, $accessible_pages) || substr($normalized_current_page, -strlen($normalized_target_path)) === $normalized_target_path) {
        $url = $APP_URL."dashboard/signin.php";
        header("Location: $url");
        exit();
    }
}

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $non_accessible_pages = ['signin.php', 'signup.php'];
    $admin_accessible_pages = ['distributors.php'];
    $sql = "SELECT * FROM user WHERE id = $userId";
    $result = $con->query($sql);
    $user = $result->fetch_object();
    if(empty($user)){
        header("Location: dashboard/signin.php");
        exit();
    }
    // $_SESSION['user'] = $user->accountType;
}
?>