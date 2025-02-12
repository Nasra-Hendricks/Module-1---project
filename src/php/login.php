<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$username = "root";
$password = "Shafwan@1";
$database = "moderntech_db";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// Read JSON data
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["username"]) || !isset($data["password"])) {
    echo json_encode(["success" => false, "message" => "Missing username or password"]);
    exit();
}

$username = trim($data["username"]);
$password = trim($data["password"]);

// Prepare and execute query
$query = "SELECT hr_id, username, password FROM hr_staff WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check user
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Compare passwords as plain text (TEMPORARY FIX)
    if ($password === $user['password']) {
        $_SESSION['user_id'] = $user['hr_id'];

        echo json_encode([
            "success" => true,
            "message" => "Login successful",
            "user" => [
                "id" => $user['hr_id'],
                "username" => $user['username']
            ]
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid password"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "User not found"]);
}

// Close connections
$stmt->close();
$conn->close();
?>
