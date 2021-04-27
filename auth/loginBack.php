<?php

    include "config.php";

    //Get Login Data
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // write query
    $sql = "SELECT * FROM Users WHERE email='".$email."'";

    // execute query
    $result = mysqli_query($conn, $sql);

    // check if the user exists by checking that exactly 1 row was returned 
    if (mysqli_num_rows($result) != 1) {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        header("Location: login.php?error=Email does not exist!");
        die;
    }

    // get query result as an array
    $user = mysqli_fetch_assoc($result);

    // verify user password match
    if (password_verify($pass, $user['password'])) {
        //Make necessary info globally accessible
        session_start();
        $_SESSION['username'] = $user['username'];
        
        //Reroute to email page
        header("Location: ../index.php");
        die;
    }
    else{
        session_start();
        $_SESSION['email'] = $email;
        header("Location: login.php?error=Your Password is Incorrect!");
        die;
    }

?>