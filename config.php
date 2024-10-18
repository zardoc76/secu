<?php
//Create session per user:
session_start();

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');


define('DB_NAME', 'secu');
define('DB_USER', 'root');
define('DB_PASS', 'root');

// connect to database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
define('ROOT_PATH', realpath(dirname(__FILE__)));