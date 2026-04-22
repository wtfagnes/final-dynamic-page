<?php
$conn = new mysqli("localhost", "root", "root");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create DB
$conn->query("CREATE DATABASE IF NOT EXISTS simple_auth");
$conn->select_db("simple_auth");

// Create table
$sql = "CREATE TABLE IF NOT EXISTS users(
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50),
email VARCHAR(100) UNIQUE,
password VARCHAR(255)
)";

if ($conn->query($sql) === TRUE) {
    echo "Setup Done ✅ <a href='register.php'>Start</a>";
} else {
    die("Error: " . $conn->error);
}
?>