<?php  
    $servername = "localhost";  
    $username = "root";  
    $password = "";  
    $dbname = "ContentCreate";

    //Establish the link to the database using mysqli_connect(server name, dbusername, dbpassword, dbname)
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //Validate the status of the connection
    if ($conn == false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Get creator id
    function getCid($email, $conn){
        // write query
        $sql = "SELECT creator_id FROM Creators WHERE email='".$email."'";

        // execute query
        $result = mysqli_query($conn, $sql);

        if ($result){
            return  mysqli_fetch_assoc($result)['cid'];
        }else{
            die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
        }
    }
?>