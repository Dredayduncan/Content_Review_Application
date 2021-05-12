<?php
    // Get config file
	include '../auth/config.php';
    session_start();

    switch ($_POST['choice']) {
        case 'favorite':
            
            $email = $_POST['email'];
            $fav_id = $_POST['creatorid'];
            //sql query to insert into the Favorites table
            $sql = 'INSERT into Favorites (time, email, favorite_id)
                  VALUES (CURRENT_TIMESTAMP, "'.$email.'", "'.$fav_id.'")';

            // execute query
            $result = mysqli_query($conn, $sql);

            if ($result){
                echo "Item has been added to favourites";
            }
            else{
                die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
            }

            break;

        case 'history':
            $email = $_POST['email'];
            $history_id = $_POST['creatorid'];

            
           
            $sql = 'INSERT into SearchHistory (email, history_id, time)
                  VALUES ("'.$email.'", "'.$history_id.'", CURRENT_TIMESTAMP)';

            // execute query
            $result = mysqli_query($conn, $sql);

            if (!$result){
                die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
            }

            echo "";

            // Increase the number of clicks of the creator
            $query = "UPDATE Creators 
            SET numclicks = (SELECT numclicks From Creators WHERE creator_id = ".$history_id.") + 1 
            WHERE creator_id =". $history_id;

            // execute query
            $res = mysqli_query($conn, $query);

            if (!$res){
                die("ERROR: Could not able to execute $res. " . mysqli_error($conn));
            }

            break;
        case 'fav_delete':
            $email = $_POST['email'];
            $fav_id = $_POST['creatorid'];

            $sql = 'DELETE from Favorites WHERE email = "'.$email.'" and favorite_id = "'.$fav_id.'"';

            // execute query
            $result = mysqli_query($conn, $sql);

            if (!$result){
                die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
            }

            echo "Creator has been removed from favorites";
            break;
        
        case 'hist_delete':
            $email = $_POST['email'];
            $history_id = $_POST['creatorid'];
            $timedate = $_POST['timedate'];

            $sql = 'DELETE from SearchHistory WHERE email = "'.$email.'" and history_id = "'.$history_id.'" and time = "'.$timedate.'";';

            // execute query
            $result = mysqli_query($conn, $sql);

            if (!$result){
                die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
            }

            echo "Creator has been removed from history";

            break;
        case 'rating':
            //Using the database to store data for the rating system
            $creatorid = $_POST['creatorid'];
            $rating = $_POST['rating'];
            $ratorid = $_POST['ratorid'];
            
            $sql1 = "SELECT totalRates, numRates from Creators where creator_id = '$creatorid'";
            $result = mysqli_query($conn, $sql1);

            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);

                //Finding the average 
                $rates = $row['totalRates'] + $rating;
                $rateNum = $row['numRates'] + 1;
                $newRating = $rates / $rateNum;

                // Check if the rator has already rated the creator 
                $rateCheck = "SELECT rating FROM Rating WHERE ratorid ='". $_SESSION['userEmail'] . "' and creator_id =". $creatorid;

                $res = mysqli_query($conn, $rateCheck);

                if(mysqli_num_rows($res) != 0){
                    $rateUpdate = "UPDATE Rating SET rating = ".$rating." WHERE ratorid ='". $_SESSION['userEmail'] . "' and creator_id =". $creatorid;

                    //execute the insert query
                    if(!mysqli_query($conn, $rateUpdate))
                        die("ERROR: Could not able to execute $res. " . mysqli_error($conn));
                }else{
                    // Insert the rating details into the Rating table
                    $raterTable = 'INSERT INTO Rating(creator_id, ratorid, rating) values 
                    ("'.$creatorid.'", "'.$ratorid.'", "'.$rating.'") ';

                    //execute the insert query
                    if(!mysqli_query($conn, $raterTable))
                        die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
                }

                // Update creator rating details 
                $update = 'UPDATE Creators
                            SET totalRates = "'.$rates.'", numRates = "'.$rateNum.'", rating = "'.$newRating.'"  
                            WHERE creator_id = "'.$creatorid.'" ';
                //execute the update query
                if(!mysqli_query($conn, $update) )
                    die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
            }else{
                die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
            }

            echo "The creator thanks you for your rating!";

            break;
        case 'search':
            # Get search data
            $value = $_POST['value'];
            $filter = $_POST['filter'];

            if ($filter == 'any'){
                $filter = '';
            }

            #Generate the query
            $sql = "SELECT * FROM Users
                    INNER JOIN Creators on Users.email = Creators.email
                    INNER JOIN CreatorSocial on CreatorSocial.creator_id = Creators.creator_id
                    WHERE Users.fname like '%".$value."%' or Users.lname like '%".$value."%' and Creators.contentType = '$filter'";

            // Execute the query 
            $result = mysqli_query($conn, $sql);

            if(!$result){
                die("ERROR: Could not able to execute $sql. " . mysqli_error($conn));
            }else{
                echo "<section style='margin-top:20px;'><div class='container' data-aos='fade-up'> 
                <div class='section-header'>
                <h2>Search</h2>
                <p>Here are your search results</p>
                </div> <div class='row'>";

                if (mysqli_num_rows($result) == 0) {
                    echo "<div class='d-flex justify-content-center' ><h3 style='color: #ffffff;'>There are no results for your search</h3></div>";
                }
                else{
                    while ($data = mysqli_fetch_array($result)){

                        echo '<div class="col-lg-4 col-md-6">
                        <div class="speaker" data-aos="fade-up" data-aos-delay="200">
                          <a href="views/creator-details.php?cid='.$data['creator_id'].'"><img src="assets/avis/'.$data['avi'].'" alt="Creator" class="img-fluid select"></a>
                          <div class="details">
                            <h3><a class="select" href="views/creator-details.php?cid='.$data['creator_id'].'">'.$data["fname"]. " " . $data["lname"] .'</a></h3>
                            <p>'.$data['contentType'].'</p>
                            <p class="code" hidden>'.$data['creator_id'].'</p>
                            '. socials($data['Twitch'], $data['Facebook'], $data['Youtube'], $data['Twitter'], $data['LinkedIn'], $data['PWebsite1'], $data['PWebsite2']).'
                          </div>
                        </div>
                      </div>';
                    }
                    echo "</div></div></section> ";
                }
                
            }

            break;
            case 'UpdateImages':
                $img = json_decode($_POST['images']);
                $creatorid = $_SESSION["cid"];
               
                for($i = 0; $i < count($img); $i++){

                    $insert = "INSERT INTO Content (creator_id, content,contentType) values ($creatorid ,'".$img[$i]. "', 'IMAGE')";

                    if(!mysqli_query($conn, $insert))
                        die("ERROR: Could not able to execute $insert. " . mysqli_error($conn));
                }
            break;

            case 'UpdateVideos':
                $video = json_decode($_POST['videos']);
                $creatorid = $_SESSION["cid"];

                for($i = 0; $i < count($video); $i++){

                    $insert = "INSERT INTO Content (creator_id, content, contentType) values ($creatorid ,".$video[$i]. ", 'VIDEO')";

                    if(!mysqli_query($conn, $insert))
                        die("ERROR: Could not able to execute $insert. " . mysqli_error($conn));
                }
            break;

        default:
            # code...
            break;
    }
?>