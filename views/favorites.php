<?php
    // Get config file
    include '../auth/config.php';

    // Begin session
    session_start();

    $info = '<li>
    <button type="button" class="btn btn-link ">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" 
        fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 
        7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 
        7 0 0 0 8 1z"/>
        </svg>
    </button>
    </li>';

    if (isset($_SESSION['role'])){
        if ($_SESSION['role'] == 'creator'){

            $info = '<li style="margin-top: -2%;"><a href=""> 
                        <div class="img-log-div">
                        <img src="../assets/avis/'.$_SESSION["avi"].'" alt="Speaker 1" class="img-fluid img-log">
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
          <li class="menu-active"><a href="../index.php">Home</a></li>
          <li><a href="../index.php#hr">Highest Rated</a></li>
          <li><a href="../index.php#mr">Most Trending</a></li>
          <li><a href="history.php">History</a></li>
          <li><a href="favourites.php">Favourites</a></li>
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
                <h2>Favorites</h2>
                <p>Here are your favorited content creators</p>
            </div>

            <?php
                // Get the User History
                $sql = "SELECT * FROM Creators
                inner join Users
                on Creators.email = Users.email
                inner join Favorites
                on Creators.creator_id = Favorites.favorite_id
                WHERE creator_id in 
                (SELECT favorite_id FROM Favorites WHERE email = '".$_SESSION['userEmail']."' 
                order by time desc)";

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
                                    <img class="img-responsive img-fluid" src="../assets/avis/'.$data['avi'].'" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">'. $data['fname'] . " " . $data['lname'].'</h5>
                                            <p class="card-text">'.$data['bio'].'</p>
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

            <div class="row d-flex justify-content-center" data-aos="fade-up">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img class="img-responsive img-fluid" src="../assets/img/gallery/4.jpg" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                <div class="social">
                                    <a href="" class="btn btn-outline-danger"><i class="fa fa-twitter"></i></a>
                                    <a href="" class="btn btn-outline-danger"><i class="fa fa-facebook"></i></a>
                                    <a href="" class="btn btn-outline-danger"><i class="fa fa-google-plus"></i></a>
                                    <a href="" class="btn btn-outline-danger"><i class="fa fa-linkedin"></i></a>
                                    
                                    <div class="delete-button btn btn-outline-danger" style="margin-left: 60%;"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center" data-aos="fade-up">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img class="img-responsive img-fluid" src="../assets/img/gallery/4.jpg" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center" data-aos="fade-up">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img class="img-responsive img-fluid" src="../assets/img/gallery/4.jpg" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center" data-aos="fade-up">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img class="img-responsive img-fluid" src="../assets/img/gallery/4.jpg" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center" data-aos="fade-up">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img class="img-responsive img-fluid" src="../assets/img/gallery/4.jpg" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

  <script>
      // Delete item to history when favorites button has been clicked
    $(".delete-button").on('click', function(){
		var creator = $(this).prev().html();
		
		$.post("../views/control.php", {choice: 'fav_delete', email: <?=json_encode($_SESSION['userEmail']);?>,
        creatorid: creator}, function(data){
			  alert(data);
		});

        $(this).parent().parent().parent().parent().parent().remove();


	});
  </script>

</body>

</html>