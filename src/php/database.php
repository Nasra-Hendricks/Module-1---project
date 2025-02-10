<?php

    // Declare our server settings
    $db_server = "localhost";
    $db_username = "root";
    $db_password = "Shafwan@1";
    $db_name = "moderntech_db";
    $port = 3306;
    $conn = "";

    // Error Handling: Check connection
    try {
        // Connect our database
        $conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);
    } catch (mysqli_sql_exception) {
        echo "Database is not connected <br>";
    }

    // if($conn){
    //     echo "Database is connected <br>";
    // }




