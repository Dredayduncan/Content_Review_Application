<?php
    
    //Establish Database Connection
    include "config.php";

    #Get form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $user = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $pass = password_hash($password, PASSWORD_DEFAULT);


    //Check if email exists
    $query = "SELECT * FROM Users where email='".$email."'";

    // execute query
    $result = mysqli_query($conn, $query);

    //Check if email is present
    if (mysqli_num_rows($result) != 0) {
        header("Location: register.php?notice=Email already exists!");
        die;
    }

    // Grant user access if he or she is new
    else{
        //Insert records to database
        $query = "INSERT into Users (firstname, lastname, username, password, email, DOB)
                  VALUES ('$fname', '$lname', '$user', '$pass', '$email', '$dob')";

        // execute query
        $result = mysqli_query($conn, $query);

        if ($result){
            session_start();
            $_SESSION['username'] = $user;
            header("Location: login.php?notice=Account has been successfully created!");
        }

        die("ERROR: Could not able to execute $query. " . mysqli_error($conn));
    }

?>