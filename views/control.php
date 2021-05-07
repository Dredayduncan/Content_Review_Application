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

                // Insert the rating details into the Rating table
                $raterTable = 'INSERT INTO Rating(creator_id, ratorid, rating) values 
                                ("'.$creatorid.'", "'.$ratorid.'", "'.$rating.'") ';

                //execute the insert query
                if(!mysqli_query($conn, $raterTable))
                    die("ERROR: Could not able to execute $result. " . mysqli_error($conn));

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




        default:
            # code...
            break;
    }
?>