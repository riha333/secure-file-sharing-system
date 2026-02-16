<?php
$conn = new mysqli("localhost", "root", "", "secure_file_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
?>
