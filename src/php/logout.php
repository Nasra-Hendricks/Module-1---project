<?php
session_start();
session_destroy();
echo json_encode(["success" => true]);

$host = "localhost"; // Change if using a different host
$username = "root";  // Your MySQL username
$password = "Shafwan@1";      // Your MySQL password (leave empty if none)
$database = "moderntech_db"; // Your database name

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $database);

// Check for connection error
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]));
}

// Close connection
$conn->close();




?>
