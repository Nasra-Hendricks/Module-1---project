<?php 

// Convert the whole file into json
header("Access-Control-Allow-Origin: *"); // Allow any origin
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type"); 
header('Content-Type: application/json');

// import database
include 'database.php';

// Create SQL Query to view all employees
$sql= 'SELECT * FROM department';

// Connect query to database
$result = $conn->query($sql);

if($result->num_rows > 0){
    // Create an empty array for employees
    $employees = [];
    while($row = $result->fetch_assoc()){
        $employees[] =$row;
    }
    echo json_encode($employees);

}else {
    echo "No data found <br>";
    echo json_encode([]);
}

// close connection
$conn->close();
