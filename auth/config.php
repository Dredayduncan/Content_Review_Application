<?php
    $servername = "localhost";  
    $username = "id16805841_admin";  
    $password = "*(Z|l^0|rx]G%{}J";  
    $dbname = "id16805841_contentcreate";

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
            $socials .= '<a href="'.$pw2.'" class="btn btn-outline-danger"><i class="fa fa-globe"></i></a>';
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

                            if ($(this).is("img")){
                                creator =  $(this).parent().next().find(".code").html();
                              }

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

    // Generate socials for existing social fields in history and favorites
    function socialsTrack($twitch, $fb, $yt, $twitter, $linkedIn, $pw1, $pw2){
        $socials = '<div class="social">';
        if ($twitch != null){
            $socials .= '<a href="'.$twitch.'" class="btn btn-outline-danger ml-1"><i class="fa fa-twitch"></i></a>';
        }

        if ($fb != null){
            $socials .= '<a href="'.$fb.'" class="btn btn-outline-danger ml-1"><i class="fa fa-facebook"></i></a>';
        }

        if ($yt != null){
            $socials .= '<a href="'.$yt.'" class="btn btn-outline-danger ml-1"><i class="fa fa-youtube-play"></i></a>';
        }

        if ($twitter != null){
            $socials .= '<a href="'.$twitter.'" class="btn btn-outline-danger ml-1"><i class="fa fa-twitter"></i></a>';
        }

        if ($linkedIn != null){
            $socials .= '<a href="'.$linkedIn.'" class="btn btn-outline-danger ml-1"><i class="fa fa-linkedin"></i></a>';
        }

        if ($pw1 != null){
            $socials .= '<a href="'.$pw1.'" class="btn btn-outline-danger ml-1"><i class="fa fa-globe"></i></a>';
        }

        if ($pw2 != null){
            $socials .= '<a href="'.$pw2.'" class="btn btn-outline-danger ml-1"><i class="fa fa-globe"></i></a>';
        }


        if (isset($_SESSION['role']) && ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'creator')){
            $socials .= '<div class="delete-button btn btn-outline-danger ml-5" > 
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </div>
                        </div>
                        
                        <script>
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