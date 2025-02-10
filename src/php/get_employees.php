<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

include 'database.php';

// SQL to get employee basic data
$sql_employee = "
    SELECT 
        employees.employee_id, 
        employees.name, 
        employees.email, 
        department.department_name, 
        position.position_name AS position, 
        position.salary AS position_salary, 
        employment_history.start_date AS employment_start, 
        employment_history.details AS employment_details
    FROM employees
    LEFT JOIN department ON employees.department_id = department.department_id
    LEFT JOIN position ON employees.position_id = position.position_id
    LEFT JOIN employment_history ON employees.employee_id = employment_history.employee_id
";

$result_employee = $conn->query($sql_employee);
$employees = [];

if ($result_employee->num_rows > 0) {
    while ($employee = $result_employee->fetch_assoc()) {
        $employeeData = [
            'employee_id' => $employee['employee_id'],
            'name' => $employee['name'],
            'email' => $employee['email'],
            'department' => $employee['department_name'],
            'position' => $employee['position'],
            'position_salary' => $employee['position_salary'],
            'employment_history' => [
                'start_date' => $employee['employment_start'],
                'details' => $employee['employment_details']
            ]
        ];

        $employees[] = $employeeData;
    }

    echo json_encode($employees);
} else {
    echo json_encode([]); // No employee data found
}

$conn->close();
?>
