<?php
// import database
    include "database.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];
        $new_department = $_POST['status'];

        // update new department
    //     $sql = "UPDATE employees SET department = '$new_department' WHERE name = '$name'"
        
    //     if($conn->query($sql) == TRUE){
    //         echo "'$name' has moved to the '$new_department' department";
    //     }else{
    //         echo "Error updating: " . $conn->error;
    //     }
    }

    // // update attendance
    // $sql = "UPDATE attendance SET present = '1' WHERE employee_id = '$id'";

    // // update leave Request
    // $sql = "UPDATE leave_Requests SET status = '1' WHERE employee_id = '$id'";

    // Create a function that updates attendance
    function updateAttendance($id){
        global $conn;
        $sql = "UPDATE attendance SET present = '1' WHERE employee_id = '$id'";
        $conn->query($sql);
    }
    updateAttendance($id);

    // Create a function that updates leave request
    function updateLeaveRequest($id){
        global $conn;
        $sql = "UPDATE leave_Requests SET status = '1' WHERE employee_id = '$id'";
        $conn->query($sql);
    }
    updateLeaveRequest($id);


    $conn->close();