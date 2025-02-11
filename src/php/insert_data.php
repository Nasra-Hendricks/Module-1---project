 <?php
    // IMPORT DATABASE
    include "database.php";

    // SERVER = SERVERS | REQUEST METHOD
    // employee.name (JS) || employee["name "] (PHP)

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name =  $_POST['name'];
        $email =  $_POST['email'];
        $position =  $_POST['position'];
        $department =  $_POST['department'];
        $salary = $_POST['salary'];
        $employmentHistory = $_POST['employmentHistory'];
       

        
    //     $sql = "INSERT INTO employees (name, email, position, department, salary, employment_history) VALUES ('$name', '$email', '$position', '$department', '$salary', '$employmentHistory')";
    //     if($conn->query($sql) == TRUE){
    //         echo "You have added: " . "<br>" . $name . "<br>" . $email . "<br>" . $position . "<br>" . $department. "<br>" . $salary . "<br>" . $employmentHistory;
    //     }else{
    //         echo "Error: " . $conn->error;
    // }   else{
    //     echo "You are using the wrong method"
    // }
    }

    // $conn->close();
     
     
    // // Create a function to add an employee to existing table 
    function addEmployee($name, $email, $position, $department, $salary, $employmentHistory){
        include "database.php";
        $sql = "INSERT INTO employees (name, email, position, department, salary, employment_history) VALUES ('$name', '$email', '$position', '$department', '$salary', '$employmentHistory')"; 
        if($conn->query($sql) == TRUE){
            echo "You have added: " . "<br>" . $name . "<br>" . $email . "<br>" . $position . "<br>" . $department. "<br>" . $salary . "<br>" . $employmentHistory;
        }else{
            echo "Error: " . $conn->error;
        } 
    }

    addEmployee($name, $email, $position, $department, $salary, $employmentHistory);
    
    
