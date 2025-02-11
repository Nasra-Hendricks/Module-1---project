<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
// Database connection details (update as needed)
$host = "localhost"; // Change if using a different host
$username = "root";  // Your MySQL username
$password = "";      // Your MySQL password (leave empty if none)
$database = "your_database"; // Your database name
// Connect to MySQL
$conn = new mysqli($host, $username, $password, $database);
// Check for connection error
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]));
}
// Read and decode the incoming JSON data
$data = json_decode(file_get_contents("php://input"));
if (!isset($data->username) || !isset($data->password)) {
    echo json_encode(["success" => false, "message" => "Missing username or password"]);
    exit();
}
$username = trim($data->username);
$password = trim($data->password);
// Use prepared statements to prevent SQL injection
$query = "SELECT id, username, password FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
// Check if user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Verify the hashed password
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        echo json_encode([
            "success" => true,
            "message" => "Login successful",
            "user" => [
                "id" => $user['id'],
                "username" => $user['username']
            ]
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid password"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "User not found"]);
}
// Close statement and connection
$stmt->close();
$conn->close();
?>






