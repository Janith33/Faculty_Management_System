<?php
// Start session first, before any output
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database Configuration - Only define if not already defined
if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'faculty_management');
}

// Create connection only if not already created
if (!isset($conn)) {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Set charset to utf8
    mysqli_set_charset($conn, "utf8");
}

// Define base URL for redirects
if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://localhost/FMS%20NEW/');
}
?>
