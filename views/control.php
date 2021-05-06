<?php
    // Get config file
	include '../auth/config.php';
    session_start();

    switch ($_GET['choice']) {
        case 'favourite':
            
            $email = $_GET['email'];
            $fav_id = $_GET['creator_id']
            

            $sql = 'INSERT into Favourites (time, email, favorite_id)
                  VALUES (CURRENT_TIMESTAMP, "'.$email.'", "'.$fav_id.'")';

            // execute query
            $result = mysqli_query($conn, $sql);

            if ($result){
                echo "Item has been added to favourites";
            }
            else{
                echo $email;
                die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
            }

            break;

        case 'history':
            $email = $_GET['email'];
            $history_id = $_GET['creator_id'];
           

            $sql = 'INSERT into History (time, email, history_id)
                  VALUES (CURRENT_TIMESTAMP, "'.$email.'", "'.$history_id.'")';

            // execute query
            $result = mysqli_query($conn, $sql);

            if (!$result){
                die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
            }

            break;
        case 'fav_delete':
            $email = $_GET['email'];
            $fav_id = $_GET['creator_id']

            $sql = 'DELETE from Favourites WHERE email = "'.$email.'" and favorite_id = "'.$fav_id.'" ';

            // execute query
            $result = mysqli_query($conn, $sql);

            if (!$result){
                die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
            }

            break;
        
        case 'hist_delete':
            $email = $_GET['email'];
            $history_id = $_GET['creator_id'];

            $sql = 'DELETE from History WHERE username = "'.$email.'" and name = "'.$history_id.'" ';

            // execute query
            $result = mysqli_query($conn, $sql);

            if (!$result){
                die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
            }

            break;
        
        default:
            # code...
            break;
    }
?>