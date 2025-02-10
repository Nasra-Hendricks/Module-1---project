<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

include 'database.php';

// SQL to get attendance and leave requests data
$sql_attendance_leave = "
    SELECT 
        attendance.employee_id, 
        attendance.date AS attendance_date, 
        attendance.status AS attendance_status,
        leave_requests.date AS leave_date, 
        leave_requests.reason AS leave_reason, 
        leave_requests.status AS leave_status
    FROM attendance
    LEFT JOIN leave_requests ON attendance.employee_id = leave_requests.employee_id
";

// Connect to the database
$result_attendance_leave = $conn->query($sql_attendance_leave);
$attendance_leave_data = [];

if ($result_attendance_leave->num_rows > 0) {
    while ($row = $result_attendance_leave->fetch_assoc()) {
        $attendance_leave_data[] = [
            'employee_id' => $row['employee_id'],
            'attendance' => [
                'attendance_date' => $row['attendance_date'],
                'attendance_status' => $row['attendance_status']
            ],
            'leave_requests' => [
                'leave_date' => $row['leave_date'],
                'leave_reason' => $row['leave_reason'],
                'leave_status' => $row['leave_status']
            ]
        ];
    }

    echo json_encode($attendance_leave_data);
} else {
    echo json_encode([]); // No attendance/leave data found
}

$conn->close();
?>
