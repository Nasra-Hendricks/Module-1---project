<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST"); 
header("Content-Type: application/json");

include 'db_connection.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id) || !isset($data->date) || !isset($data->status)) {
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit;
}

$id = $data->id;
$date = $data->date;
$status = $data->status;

$sql = "UPDATE attendance SET attendance_date = ?, attendance_status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $date, $status, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Record updated successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to update record"]);
}

$stmt->close();
$conn->close();
?>
