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


    // Generate socials for existing social fields
    function socials($twitch, $fb, $yt, $twitter, $linkedIn, $pw1, $pw2){
        $socials = '<div class="social">';
        if ($twitch != null){
            $socials .= '<a href="'.$twitch.'" class="btn btn-outline-danger"><i class="fa fa-twitch"></i></a>';
        }

        if ($fb != null){
            $socials .= '<a href="'.$fb.'" class="btn btn-outline-danger"><i class="fa fa-facebook"></i></a>';
        }

        if ($yt != null){
            $socials .= '<a href="'.$yt.'" class="btn btn-outline-danger"><i class="fa fa-youtube-play"></i></a>';
        }

        if ($twitter != null){
            $socials .= '<a href="'.$twitter.'" class="btn btn-outline-danger"><i class="fa fa-twitter"></i></a>';
        }

        if ($linkedIn != null){
            $socials .= '<a href="'.$linkedIn.'" class="btn btn-outline-danger"><i class="fa fa-linkedin"></i></a>';
        }

        if ($pw1 != null){
            $socials .= '<a href="'.$pw1.'" class="btn btn-outline-danger"><i class="fa fa-globe"></i></a>';
        }

        if ($pw2 != null){
            $socials .= '<a href="'.$pw2.'" class="btn btn-outline-danger"><i class="fas fa-globe"></i></a>';
        }


        if (isset($_SESSION['role']) && ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'creator')){
            $socials .= '<a class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                            <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                            </i>
                        </a>
                        </div>
                        
                        <script>
                        // Add item to favorites when favorites button has been clicked
                        $(".speaker .fav").on("click", function(){
                            var creator = $(this).parent().prev().html();
                            
                            $.post("views/control.php", {choice: "favorite", email:"'.$_SESSION["userEmail"].'",
                            creatorid: creator}, function(data){
                                alert(data);
                            });
                        });

                        // Add to history
                        $(".speaker .select").on("click", function() {
                            var creator = $(this).parent().parent().find(".code").html();

                            $.post("views/control.php", {choice: "history", email:"'.$_SESSION["userEmail"].'", 
                                creatorid: creator}, function(data){
                                window.location.replace("views/creator-details.php?cid=" + creator);
                            });

                            return false;
                        });

                        </script>';
        }
        else{
            $socials .= '</div>';
        }
       

        return $socials;
    }
?>