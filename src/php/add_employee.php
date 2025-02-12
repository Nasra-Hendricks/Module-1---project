<?php 
// IMPORT DATABASE
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position_name = $_POST['position']; 
    $department_name = $_POST['department'];
    $salary = $_POST['salary'];
    $employment_details = $_POST['employment_history']; // Used for 'details' column

    // Start transaction
    $conn->begin_transaction();

    try {
        // Get the next available employee_id manually (if not using AUTO_INCREMENT)
        $result = $conn->query("SELECT MAX(employee_id) AS last_id FROM employees");
        $row = $result->fetch_assoc();
        $employee_id = $row['last_id'] + 1;

        // Insert into employees table
        $sql1 = "INSERT INTO employees (employee_id, name, email) VALUES (?, ?, ?)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("iss", $employee_id, $name, $email);
        if (!$stmt1->execute()) {
            throw new Exception("Error inserting into employees: " . $stmt1->error);
        }

        // Insert into position table (without employee_id)
        $sql2 = "INSERT INTO position (position_name, salary) VALUES (?, ?)";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("sd", $position_name, $salary);
        if (!$stmt2->execute()) {
            throw new Exception("Error inserting into position: " . $stmt2->error);
        }
        $position_id = $conn->insert_id; // Get last inserted position ID

        // Insert into department table (without employee_id)
        $sql3 = "INSERT INTO department (department_name) VALUES (?)";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param("s", $department_name);
        if (!$stmt3->execute()) {
            throw new Exception("Error inserting into department: " . $stmt3->error);
        }
        $department_id = $conn->insert_id; // Get last inserted department ID

        // Insert into employment_history table (without start_date)
        $sql4 = "INSERT INTO employment_history (employee_id, details) VALUES (?, ?)";
        $stmt4 = $conn->prepare($sql4);
        $stmt4->bind_param("is", $employee_id, $employment_details);
        if (!$stmt4->execute()) {
            throw new Exception("Error inserting into employment_history: " . $stmt4->error);
        }

        // Assign department and position to employee
        // assign_department_position($conn, $employee_id, $department_id, $position_id);

        // Commit transaction
        $conn->commit();
        echo "Employee added successfully!";
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaction if error occurs
        echo "Failed to add employee: " . $e->getMessage();
    }
}




// // Function to assign department and position to employee
// function assign_department_position($conn, $employee_id, $department_id, $position_id) {
//     $sql = "INSERT INTO employee_department_position (employee_id, department_id, position_id) VALUES (?, ?, ?)";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("iii", $employee_id, $department_id, $position_id);
//     if (!$stmt->execute()) {
//         throw new Exception("Error assigning department and position: " . $stmt->error);
//     }
// }

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee added successfully!</title>
</head>
<body>

    <a href="http://localhost:8081/EmployeeListView">View Employees</a>
</body>

</html>

