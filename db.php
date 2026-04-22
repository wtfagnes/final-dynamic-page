<?php
$conn = new mysqli("localhost", "root", "root", "simple_auth");

if ($conn->connect_error) {
    die("Database Error: " . $conn->connect_error);
}
?>