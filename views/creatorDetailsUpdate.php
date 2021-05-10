<?php

    //Establish Database Connection
    include "../auth/config.php";

    session_start();

    #Get form data

    # Get creator name
    $fname = $_POST['creatorfname'];
    $lname = $_POST['creatorlname'];
    $creatorid = $_SESSION['cid'];

    # Get Bio
    $bio = $_POST['bio'];
    // $email = $_SESSION['userEmail'];

    $content = $_POST['content'];

    # Get Socials
    if(isset($_POST['twitch']))
        $twitch = $_POST['twitch'];
    else 
        $twitch = NULL;
    if(isset($_POST['Facebook']))
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

    // Check for the avi input  
    if(isset($_FILES["file"]["name"])){
        //Get Image Upload path
        $targetDir = "../assets/avis/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        //Get file type
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        //Check if file is an image and upload it to the server
        $allowTypes = array('jpg', 'JPG', 'png','jpeg','JPEG', 'PNG');

        if(in_array($fileType, $allowTypes)){

            // Upload file to server
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                //echo "true";
                $innerjoin = "UPDATE Creators 
                        INNER JOIN Content on Creators.creator_id = Content.creator_id 
                        INNER JOIN Users on Users.email = Creators.email
                        SET Creators.bio = '".$bio."', Creators.contentType = '".$content."', Creators.avi = '$fileName', fname = '$fname', lname = '$lname'
                        WHERE Creators.creator_id = $creatorid ";

                if(!mysqli_query($conn, $innerjoin)){
                    die("ERROR: Could not able to execute $innerjoin " . mysqli_error($conn));
                }
                else{
                    $_SESSION['avi'] = $fileName;
                }
                    
            }
            else{
                echo "false";
                die;
            }
        }

        $socials = "UPDATE CreatorSocial
                    SET PWebsite1 = '".$pw1."', PWebsite2 = '".$pw2."', LinkedIn = '".$linkedin."',Facebook = '".$fb."',Youtube = '".$yt."',Twitch = '".$twitch."' ,Twitter = '".$twitter."'
                    WHERE creator_id = $creatorid ";

        if(!mysqli_query($conn, $socials)){
            die("ERROR: Could not able to execute $socials. " . mysqli_error($conn));
        }
        else{
            header("Location: creator-details.php?cid=".$_SESSION['cid']);
        }
    }
    else{
        header("Location: creator-details.php?error=Update Failed&cid=".$_SESSION['cid']);
    }

    
?>