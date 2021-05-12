<?php
  // Get config file
  include 'auth/config.php';

  session_start();

  if (isset($_GET['logout']) && $_GET['logout'] == 'yes'){
    session_destroy();
    header('Location: index.php');
  }

  $menu = '';
  $fav = '';
  $info = '<li ><a href="auth/login.php" class="btn btn-outline-success">Login</a></li>';

  if (isset($_SESSION['role'])){
    $fav = '<a class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                </svg>
                </i>
              </a>';

    $menu = '<li><a href="views/history.php">History</a></li>
    <li><a href="views/favorites.php">Favourites</a></li>';

    if ($_SESSION['role'] == 'creator'){
      $info = '<li style="margin-top: -2%;"><a> 
                  <div class="img-log-div">
                    <img src="assets/avis/'.$_SESSION["avi"].'" alt="Speaker 1" class="img-fluid img-log dropdown-toggle" data-bs-toggle="dropdown">
                    
                  
                      <ul class="dropdown-menu" style="background-color: #060c22;">

                      <form action="views/creator-details.php?cid='.$_SESSION["cid"].'" method="post">
                        <button type="submit" class="list-group-item btn btn-outline-success ml-4 mb-2 pt-1 pl-1 pr-1 pb-1">View Profile</button>
                      </form>

                      <form action="index.php?logout=yes" method="post">
                        <button type="submit" class="list-group-item btn btn-outline-success ml-4 pt-1 pl-1 pr-1 pb-1">Sign Out</button>
                      </form>

                      </ul>

                  </div>
                </a></li>';
    }
    elseif($_SESSION['role'] == 'user'){
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
                <form action="index.php?logout=yes" method="post">
                  <button type="submit" class="list-group-item btn btn-outline-success ml-5 pt-1 pl-1 pr-1 pb-1">Sign Out</button>
                </form>
                </ul>
              </li>';
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
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: TheEvent - v2.3.1
  * Template URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" >
    <div class="container"  >

      <nav id="nav-menu-container" >
        <ul class="nav-menu" >
          <li class="menu-active"><a href="index.php">Home</a></li>
          <li><a href="#hr">Highest Rated</a></li>
          <li><a href="#mr">Most Trending</a></li>
          <?php 
            echo $menu;
            echo $info; 
          
          ?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Intro Section ======= -->
  <section id="intro">
    <div class="intro-container" data-aos="zoom-in" data-aos-delay="100">
      <h1 class="mb-4 pb-0">The Creator<br><span>Discovery</span> App</h1>
      <p class="mb-4 pb-0">Find and support under the radar artists </p>
      <!-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a> -->
      
    </div>

  </section><!-- End Intro Section -->

                   
      <!-- <nav class="navbar navbar-dark bg-dark"> -->
        <div class="container-fluid searchbar mt-3" >
          <form class="d-flex justify-content-center">
            <input id='search' style="margin-right:10px; width:500px;" class="form-control " type="search" placeholder="Search" aria-label="Search">
            <div class="filter mr-2 mt-2">
              <select id="content" name="content">
                <option value="">Any</option>
                <option value="gaming">Gaming</option>
                <option value="photography">Photography</option>
                <option value="videography">Videography</option>
                <option value="basketball">Basketball</option>
                <option value="football">Football</option>
                <option value="swimming">Swimming</option>
                <option value="art">Art</option>
                <option value="comedy">Comedy</option>
                <option value="gym">Gym</option>
                <option value="vlog">Vlog</option>
                <option value="music">Music</option>
                <option value="other">Other</option>
              </select>           
            </div>
            <button id="searchButton" style="margin-right:10px;" class="btn btn-outline-success">Search</button>
          </form>

        
      <!-- </nav> -->

  <main id="main">

    <!-- ======= About Section ======= -->
  

    <!-- ======= Speakers Section ======= -->
    <section id="hr" style="margin-top:100px;">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Highest Rated</h2>
          <p>Here are some of our highly rated content creators</p>
        </div>

        

        <div class="row">
          
          <?php 
            #Write the query to get highest rated creators over the past 7 days
            $query = "SELECT * FROM Users
                      INNER JOIN Creators on Users.email = Creators.email
                      INNER JOIN CreatorSocial on CreatorSocial.creator_id = Creators.creator_id
                      INNER JOIN Rating on Rating.creator_id = Creators.creator_id
                      WHERE Rating.time > now() - INTERVAL 7 day
                      ORDER BY Creators.rating LIMIT 6";

            // execute query
				    $result = mysqli_query($conn, $query);

            // Check if the query is executed and perform the necessary actions
            if(!$result){
              die("ERROR: Could not able to execute $query. " . mysqli_error($conn));
            }
            else{
                
              // Display the results
              while ($data = mysqli_fetch_array($result)){

                  echo '<div class="col-lg-4 col-md-6 mb-2">
                  <div class="speaker" data-aos="fade-up" data-aos-delay="200">
                  <a href="views/creator-details.php?cid='.$data['creator_id'].'"><img src="assets/avis/'.$data['avi'].'" alt="Creator" class="img-fluid select"></a>
                    <div class="details">
                      <h3><a class="select" href="views/creator-details.php?cid='.$data['creator_id'].'">'.$data["fname"]. " ". $data["lname"].'</a></h3>
                      <p>'.$data['contentType'].'</p>
                      <p class="code" hidden>'.$data['creator_id'].'</p>
                      '. socials($data['Twitch'], $data['Facebook'], $data['Youtube'], $data['Twitter'], $data['LinkedIn'], $data['PWebsite1'], $data['PWebsite2']).'
                    </div>
                  </div>
                </div>';
              }
          }

        ?>
        </div>
      </div>

    </section><!-- End Speakers Section -->

    <!-- ======= Speakers Section ======= -->
    <section id="mr">
      <div class="container mt-5" data-aos="fade-up">
        <div class="section-header ">
          <h2>Most Trending</h2>
          <p>Here are some of our most trending creators </p>
        </div>

        <div class="row">
        <?php 
            #Write the query to get highest rated creators over the past 7 days
            $query = "SELECT Users.fname, Users.lname, Creators.creator_id, Creators.bio, Creators.email,
                      Creators.contentType, CreatorSocial.PWebsite1, CreatorSocial.PWebsite2, CreatorSocial.LinkedIn, 
                      CreatorSocial.Facebook, CreatorSocial.Youtube, CreatorSocial.Twitch, CreatorSocial.Twitter, SearchHistory.time, Creators.avi
                      FROM Users
                      INNER JOIN Creators on Users.email = Creators.email
                      INNER JOIN CreatorSocial on CreatorSocial.creator_id = Creators.creator_id
                      INNER JOIN SearchHistory on Creators.creator_id = SearchHistory.history_id
                      WHERE time > now() - INTERVAL 7 day
                      GROUP BY Creators.creator_id
                      ORDER BY numClicks desc LIMIT 6";

            // execute query
				    $result = mysqli_query($conn, $query);

            // Check if the query is executed and perform the necessary actions
            if(!$result){
              die("ERROR: Could not able to execute $query. " . mysqli_error($conn));
            }
            else{
                
              // Display the results
              while ($data = mysqli_fetch_array($result)){

                  echo '<div class="col-lg-4 col-md-6 mb-2">
                  <div class="speaker" data-aos="fade-up" data-aos-delay="200">
                    <a href="views/creator-details.php?cid='.$data['creator_id'].'"><img src="assets/avis/'.$data['avi'].'" alt="Creator" class="img-fluid select"></a>
                    <div class="details">
                      <h3><a class="select" href="views/creator-details.php?cid='.$data['creator_id'].'">'.$data["fname"]. " ". $data["lname"].'</a></h3>
                      <p>'.$data['contentType'].'</p>
                      <p class="code" hidden>'.$data['creator_id'].'</p>
                      '. socials($data['Twitch'], $data['Facebook'], $data['Youtube'], $data['Twitter'], $data['LinkedIn'], $data['PWebsite1'], $data['PWebsite2']).'
                    </div>
                  </div>
                </div>';
              }
          }

        ?>
          
        </div>
      </div>

    </section><!-- End Speakers Section -->

  </main><!-- End #main -->

  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/superfish/superfish.min.js"></script>
  <script src="assets/vendor/hoverIntent/hoverIntent.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
  <script src="assets/js/main.js"></script>

  <script>
    // Add item to favorites when favorites button has been clicked
    $(".speaker .fav").on('click', function(){
		var creator = $(this).parent().prev().html();
		
    if (creator !== <?=json_encode($_SESSION['cid']);?>){
        $.post("views/control.php", {choice: 'favorite', email: <?=json_encode($_SESSION['userEmail']);?>,
          creatorid: creator}, function(data){
          alert(data);
      });
    }
		
	});

	// Add to history
	$( ".select" ).click(function( event ) {
    var creator = $(this).parent().parent().find(".code").html();
   
    if ($(this).is('img')){
      creator =  $(this).parent().next().find(".code").html();
    }

    if (creator !== <?=json_encode($_SESSION['cid']);?>){
      $.post("views/control.php", {choice: 'history',  email: <?=json_encode($_SESSION['userEmail']);?>, 
        creatorid: creator}, function(data){
          window.location.replace("views/creator-details.php?cid=" + creator);
      });
    }
  });

  $('#searchButton').on("click", function(){
    var filter = $('#content').val();

    $.post("views/control.php", {choice: 'search',  value: $('#search').val(), filter: filter}, function(data){
      $('#main').html(data);
    });

    return false;
  });
		
  
  </script>

</body>

</html>