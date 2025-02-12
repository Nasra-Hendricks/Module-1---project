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

// Decode the incoming JSON data
$data = json_decode(file_get_contents("php://input"));

// Check if data is not empty and process accordingly
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($data->employee_id) && isset($data->status)) {
    $employee_id = $data->leave_request_id;
    $status = $data->status;  // The status to update (e.g., 'Denied', 'Approved', etc.)

     // Debugging: Display the values being used
    // var_dump($leave_request_id, $status);
    // echo "Status" . $status;

    // Prepare query to update the leave request status
    $query = "UPDATE leave_requests SET status = ? WHERE employee_id= ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $leave_request_id);  // "si" means string (status) and integer (leave_request_id)

    // Execute the query and return a response
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Leave status updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update leave status."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Missing leave_request_id or status."]);
}

$conn->close();
?>