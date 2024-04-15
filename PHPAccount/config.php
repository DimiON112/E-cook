<?php
session_start();

define('LOCALHOST', 'localhost');
define('ROOT', 'root');
define('PASSWORD', '');
define('DATABASE', 'login_db');
define('SITEURL', 'http://localhost/PHPAccount/');

$conn = mysqli_connect(LOCALHOST, ROOT, PASSWORD, DATABASE) or die("Connection failed: " . mysqli_connect_error());
$db_select = mysqli_select_db($conn, DATABASE) or die("Database selection failed: " . mysqli_error($conn));
?>