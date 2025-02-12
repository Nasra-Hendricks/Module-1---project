<?php
// Import database connection
include "database.php";

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Content-Type: application/json");

// Log received data
file_put_contents("delete_log.txt", "POST Data: " . print_r($_POST, true), FILE_APPEND);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = intval($_POST["id"]);

    // Log ID
    file_put_contents("delete_log.txt", "Processed ID: $id\n", FILE_APPEND);

    if ($id <= 0) {
        echo json_encode(["success" => false, "message" => "Invalid Employee ID"]);
        exit();
    }

    // Check if employee exists before deleting
    $check_sql = "SELECT * FROM employees WHERE employee_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(["success" => false, "message" => "Employee ID not found"]);
        exit();
    }

    // Delete employee
    $delete_sql = "DELETE FROM employees WHERE employee_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    
    if ($delete_stmt) {
        $delete_stmt->bind_param("i", $id);
        if ($delete_stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Employee deleted successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete employee: " . $delete_stmt->error]);
        }
        $delete_stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Error preparing SQL statement: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}

// Log final status
file_put_contents("delete_log.txt", "Final Response: " . json_encode(["success" => false, "message" => "Invalid request"]) . "\n", FILE_APPEND);

$conn->close();
?>
