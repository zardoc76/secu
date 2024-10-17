<?php
session_start();

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_PORT', '3306'); // Default port for MySQL
define('DB_NAME', 'secu'); // Make sure 'secu' is your actual database name
define('DB_USER', 'root'); // Default username for XAMPP
define('DB_PASS', 'kali'); // No password set by default in XAMPP

// Connect to database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
