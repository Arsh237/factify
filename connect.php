<?php
$host = "localhost"; // Change if needed
$user = "root"; // Default username in XAMPP
$pass = ""; // Default password in XAMPP
$dbname = "user_auth"; 

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
