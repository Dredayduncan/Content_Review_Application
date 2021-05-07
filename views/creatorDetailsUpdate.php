<?php

    //Establish Database Connection
    include "../auth/config.php";

    #Get form data

    # Get creator name
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    # Get Bio
    $bio = $_POST['lname'];

    # Get Socials
    $twitch = $_POST['twitch'];
    $fb = $_POST['fb'];
    $yt = $_POST['yt'];
    $linkedin = $_POST['linkedin'];
    $twitter = $_POST['twitter'];
    $pw1 = $_POST['pw1'];
    $pw2 = $_POST['pw2'];

    
?>