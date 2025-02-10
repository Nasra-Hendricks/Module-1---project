<?php
// import data
    include "database.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST["name"];

    //     $sql = "DELETE FROM employees WHERE name='$name'";
        
    //     if($conn->query($sql) == TRUE){
    //         echo "$name has been deleted successfully";
    //     }else{
    //         echo "Error: " . $conn->error
    //     }
    // }

    // Create a function to delete an employee from existing table
    function deleteEmployee($id){
        global $conn;
        $sql = "DELETE FROM employees WHERE id=$id";
        $conn->query($sql);
    } ;

    $conn->close();

   