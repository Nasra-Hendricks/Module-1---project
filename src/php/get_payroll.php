<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

include 'database.php';

// SQL to get payroll data along with employee names
$sql_payroll = "
    SELECT 
        p.employee_id, 
        e.name AS employee_name, 
        p.hours_worked, 
        p.leave_deductions, 
        p.final_salary
    FROM payroll p
    JOIN employees e ON p.employee_id = e.employee_id
";

$result_payroll = $conn->query($sql_payroll);
$payroll = [];

if ($result_payroll->num_rows > 0) {
    while ($row = $result_payroll->fetch_assoc()) {
        $payroll[] = [
            'employee_id' => $row['employee_id'],
            'employee_name' => $row['employee_name'],
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
