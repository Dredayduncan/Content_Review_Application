<?php

    //Establish Database Connection
    include "../auth/config.php";

    #Get form data

    # Get creator name
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $creatorid = $_GET['cid'];
    # Get Bio
    $bio = $_POST['bio'];

    $content = $_POST['content'];

    # Get Socials
    if(isset($_POST['twitch']))
        $twitch = $_POST['twitch'];
    else 
        $twitch = NULL;
    if(isset($_POST['twitch']))
        $fb = $_POST['Facebook'];
    else
        $fb = NULL;
    if(isset($_POST['YouTube']))
        $yt = $_POST['YouTube'];
    else
        $yt = NULL;
    if(isset($_POST['LinkedIn']))
        $linkedin = $_POST['LinkedIn'];
    else
        $linkedin = NULL;
    if(isset($_POST["Twitter"]))
        $twitter = $_POST['Twitter'];
    else
        $twitter = NULL;
    if(isset($_POST["Personal Website 1"]))
        $pw1 = $_POST['Personal Website 1'];
    else
        $pw1 = NULL;
    if(isset($_POST["Personal Website 2"]))
        $pw2 = $_POST['Personal Website 2'];
    else
        $pw2 = NULL;


    

    if(isset( $_POST["file"])){
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
        $sql = "UPDATE Creators
                SET avi = '$fileName'
                where email = '$email'";

        // execute query
        $res = mysqli_query($conn, $sql);

        if (!$res){
            die("ERROR: Could not able to execute $sql. " . mysqli_error($conn));
        }
    }

    $userTable = "UPDATE User
                SET fname = '$fname', lname= '$lname', bio = '$bio'
                where email = '$email'";
    
    if(!mysqli_query($conn, $userTable))
        die("ERROR: Could not able to execute $sql. " . mysqli_error($conn));

    
    $contentTable = "UPDATE Content
                    SET content = '$content'
                    where creatorid = '$creatorid'";
    if(!mysqli_query($conn, $contentTable))
        die("ERROR: Could not able to execute $sql. " . mysqli_error($conn));

    $socials = "UPDATE CreatorSocials
                SET PWebsite1 = '$pw1', PWebsite2 = '$pw2', LinkedIn = '$linkedin',Facebook = '$fb',Youtube = '$yt',Twitch = '$twitch' ,Twitter = '$twitter'
                WHERE creatorid = '$creatorid' ";

    if(!mysqli_query($conn, $socials))
        die("ERROR: Could not able to execute $sql. " . mysqli_error($conn));
    
    
    



    
?>