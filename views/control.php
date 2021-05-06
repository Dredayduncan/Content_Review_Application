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
           

            $sql = 'INSERT into SearchHistory (time, email, history_id)
                  VALUES (CURRENT_TIMESTAMP, "'.$email.'", "'.$history_id.'")';

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

            break;
        
        case 'hist_delete':
            $email = $_POST['email'];
            $history_id = $_POST['creatorid'];

            $sql = 'DELETE from SearchHistory WHERE username = "'.$email.'" and name = "'.$history_id.'" ';

            // execute query
            $result = mysqli_query($conn, $sql);

            if (!$result){
                die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
            }

            break;
        case 'rating':
            //Using the database to store data for the rating system
            $creatorid = $_POST['creatorid'];
            $rating = $_POST['rating'];
            $ratorid = $_POST['ratorid'];
            
            $sql1 = "SELECT totalRates,numRates from Creators where creator_id = '$creatorid'";
            $result = mysqli_query($conn, $sql1);

            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                //Finding the average 
                $row['totalRates'] += $rating;
                $row['numRates'] += 1;
                $newRating = $row['totalRates'] / $row['numRates'];

                $raterTable = 'INSERT INTO Rating(creator_id, ratorid, rating) values 
                                ("'.$creatorid.'", "'.$ratorid.'", "'.$rating.'") ';
                //execute the insert query
                if(!mysqli_query($conn, $raterTable))
                    die("ERROR: Could not able to execute $result. " . mysqli_error($conn));

                $update = 'UPDATE Creators
                            SET totalRates = "'.$row['totalRates'].'", numRates = "'.$row['numRates'].'", rating = "'.$newRating.'"  
                            WHERE creator_id = "'.$creatorid.'" ';
                //execute the update query
                if(!mysqli_query($conn, $update) )
                    die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
            }




        default:
            # code...
            echo "beans";
            die;
            break;
    }
?>