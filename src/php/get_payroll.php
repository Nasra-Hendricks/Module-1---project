<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

include 'database.php';

// SQL to get payroll data
$sql_payroll = "
    SELECT 
        employee_id, 
        hours_worked, 
        leave_deductions, 
        final_salary
    FROM payroll
";

$result_payroll = $conn->query($sql_payroll);
$payroll = [];

if ($result_payroll->num_rows > 0) {
    while ($row = $result_payroll->fetch_assoc()) {
        $payroll[] = [
            'employee_id' => $row['employee_id'],
            'hours_worked' => $row['hours_worked'],
            'leave_deductions' => $row['leave_deductions'],
            'final_salary' => $row['final_salary']
        ];
    }

    echo json_encode($payroll);
} else {
    echo json_encode([]); // No payroll data found
}

$conn->close();
?>
