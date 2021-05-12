<?php
    // Get config file
    include '../auth/config.php';

    // Begin session
    session_start();

    // Ensure only logged in users have access
    if (!isset($_SESSION['userEmail'])){
        header('Location: ../index.php');
      }

    $info = '<li>
    <button type="button" class="btn btn-link dropdown-toggle" data-bs-toggle="dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" 
        fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 
        7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 
        7 0 0 0 8 1z"/>
        </svg>
    </button>

    <ul class="dropdown-menu" style="background-color: #060c22;">
        <form action="../index.php?logout=yes" method="post">
            <button type="submit" class="list-group-item btn btn-outline-success ml-4 pt-1 pl-1 pr-1 pb-1">Sign Out</button>
        </form>
    </ul>
    </li>';

    if (isset($_SESSION['role'])){
        if ($_SESSION['role'] == 'creator'){

            $info = '<li style="margin-top: -2%;"><a > 
                        <div class="img-log-div">
                        <img src="../assets/avis/'.$_SESSION["avi"].'" alt="Speaker 1" class="img-fluid img-log dropdown-toggle" data-bs-toggle="dropdown">

                        <ul class="dropdown-menu" style="background-color: #060c22;">
                      <form action="creator-details.php?cid='.$_SESSION["cid"].'" method="post">
                        <button type="submit" class="list-group-item btn btn-outline-success ml-4 mb-2 pt-1 pl-1 pr-1 pb-1">View Profile</button>
                      </form>

                      <form action="../index.php?logout=yes" method="post">
                        <button type="submit" class="list-group-item btn btn-outline-success ml-4 pt-1 pl-1 pr-1 pb-1">Sign Out</button>
                      </form>
                      </ul>
                        </div>
                        
                    </a></li>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>The Creator Discovery</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: TheEvent - v2.3.1
  * Template URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container">

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="../index.php">Home</a></li>
          <li><a href="../index.php#hr">Highest Rated</a></li>
          <li><a href="../index.php#mr">Most Trending</a></li>
          <li class="menu-active"><a href="history.php">History</a></li>
          <li><a href="favorites.php">Favourites</a></li>
          <?php
            echo $info; 
          ?>
          
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= About Section ======= -->
  

    <!-- ======= Speakers Section ======= -->
    <section id="hr" style='margin-top: 7%;'>
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>History</h2>
                <p>Here are your recently visited content creators</p>
            </div>

        <?php

				// Get the User History
				$sql = "SELECT * FROM Creators
				inner join Users
                on Creators.email = Users.email
                inner join SearchHistory
                on Creators.creator_id = SearchHistory.history_id
                WHERE creator_id in 
                (SELECT history_id FROM SearchHistory WHERE email = '".$_SESSION['userEmail']."')
                order by time desc";

				// execute query
				$result = mysqli_query($conn, $sql);

				if(!$result){
					die("ERROR: Could not able to execute $sql. " . mysqli_error($conn));
				}else{

					while ($data = mysqli_fetch_array($result)){

						echo '<div class="row d-flex justify-content-center" data-aos="fade-up">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                    <img class="img-responsive img-fluid" style="max-height: 50%; width: 100%;" src="../assets/avis/'.$data['avi'].'" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body" >
                                            <h5 class="card-title">'. $data['fname'] . " " . $data['lname'].'</h5>
                                            <p class="card-text">'.$data['bio'].'
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                            Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, 
                                            when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                            It has survived not only five centuries, </p>
                                            <p class="card-text"><small class="text-muted">'.$data['time'].'</small></p>
                                            <p class="code" hidden>'.$data['creator_id'].'</p>

                                            <div class="delete-button btn btn-outline-danger" > 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>';
            }
      
          }
			?>


        </div>


    </section><!-- End Speakers Section -->

  </main><!-- End #main -->

  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/venobox/venobox.min.js"></script>
  <script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="../assets/vendor/superfish/superfish.min.js"></script>
  <script src="../assets/vendor/hoverIntent/hoverIntent.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

  <script>
      // Delete item to history when favorites button has been clicked
    $(".delete-button").on('click', function(){
		var creator = $(this).prev().html();
        var timedate = $(this).prev().prev().find(".text-muted").html();
		
		$.post("../views/control.php", {choice: 'hist_delete', email: <?=json_encode($_SESSION['userEmail']);?>,
        creatorid: creator, timedate: timedate}, function(data){
			  alert(data);
		});

        $(this).parent().parent().parent().parent().parent().remove();


	});
  </script>

</body>

</html>