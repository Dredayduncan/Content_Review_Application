<?php
    
    //Establish Database Connection
    include "config.php";

    #Get form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $pass = password_hash($password, PASSWORD_DEFAULT);

    //Check if email exists
    $query = "SELECT * FROM Users where email='".$email."'";

    // execute query
    $result = mysqli_query($conn, $query);

    //Check if email is present
    if (mysqli_num_rows($result) != 0) {
        header("Location: signup.php?error=Email already exists!&role=".$role);
        die;
    }

    // Grant user access if he or she is new
    else{
        //Insert records to database
        $query = "INSERT into Users (fname, lname, password, email, user_role)
                  VALUES ('$fname', '$lname', '$pass', '$email', '$role')";

        // execute query
        $result = mysqli_query($conn, $query);

        if ($result){
            session_start();
            $_SESSION['userEmail'] = $email;
            

            // Check if the user is a creator and insert the record into the creator table
            if ($role == 'creator'){
                
                //Get Image Upload path
                $targetDir = "../assets/avis/";
                $fileName = basename($_FILES["file"]["name"]);
                $targetFilePath = $targetDir . $fileName;

                //Get file type
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

                //Check if file is an image and upload it to the server
                $allowTypes = array('jpg', 'JPG', 'png','jpeg');

                if(in_array($fileType, $allowTypes)){

                    // Upload file to server
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                        echo "true";
                    }
                    else{
                        echo "false";
                        die;
                    }
                }

                // insert record into creator table
                $sql = "INSERT into Creators (email, avi)
                VALUES ('$email', '$fileName')";

                // execute query
                $res = mysqli_query($conn, $sql);

                if (!$res){
                    die("ERROR: Could not able to execute $sql. " . mysqli_error($conn));
                }

                $_SESSION['avi'] = $fileName;
                $_SESSION['role'] = 'creator';
            }
            else{
                $_SESSION['role'] = 'user';
            }

            // Return to login page
            header("Location: ../index.php?role=".$role);
        }

        die("ERROR: Could not able to execute $query. " . mysqli_error($conn));
    }

?>