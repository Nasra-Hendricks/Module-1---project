<?php
// Database connection
include 'database.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Decode JSON input
$data = json_decode(file_get_contents("php://input"));

if (isset($data->employee_id)) {
    $employee_id = $data->employee_id; // Fix the variable

    // Prepare SQL statement
    $query = "UPDATE leave_requests SET leave_status = 'Approved' WHERE employee_id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "SQL error: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("i", $employee_id);

    // Execute and return response
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Database update failed."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Missing employee_id."]);
}

$conn->close();
?>
