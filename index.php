<?php
  session_start();

  $menu = '';
  $fav = '';
  $info = '<li ><a href="auth/login.php" class="btn btn-outline-success">Login</a></li>';

  if (isset($_SESSION['role'])){
    if ($_SESSION['role'] == 'creator'){
      $menu = '<li><a href="views/history.php">History</a></li>
                <li><a href="views/favorites.php">Favourites</a></li>';

      $fav = '<a class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                </svg>
                </i>
              </a>';

      $info = '<li style="margin-top: -2%;"><a href=""> 
                  <div class="img-log-div">
                    <img src="assets/avis/'.$_SESSION["avi"].'" alt="Speaker 1" class="img-fluid img-log">
                  </div>
                </a></li>';
    }
    elseif($_SESSION['role'] == 'user'){
      $menu = '<li><a href="views/history.php">History</a></li>
                <li><a href="views/favorites.php">Favourites</a></li>';

      $fav = '<a class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                </svg>
                </i>
              </a>';

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
  <header id="header">
    <div class="container">

      <nav id="nav-menu-container">
        <ul class="nav-menu">
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

  <main id="main">

    <!-- ======= About Section ======= -->
  

    <!-- ======= Speakers Section ======= -->
    <section id="hr">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Highest Rated</h2>
          <p>Here are some of our highly rated content creators</p>
        </div>

        <div class="row">
          
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="200">
              <a href="views/creator-details.php"><img src="assets/img/speakers/2.jpg" alt="Speaker 2" class="img-fluid select"></a>
              <div class="details">
<<<<<<< HEAD
                <h3><a href="views/creator-details.php">Brenden Legros</a></h3>
                <p>Quas alias incidunt</p>
=======
                <h3><a class='select' href="views/creator-details.php">Hubert Hirthe</a></h3>
                <p>Consequuntur odio aut</p>
                <p class='code' hidden>5</p>
>>>>>>> 3ff75fd5f1817cbddb1879986b1ffccbddc24e1f
                <div class="social">
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-twitter"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-facebook"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-google-plus"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-linkedin"></i></a>
                  
                  <?php echo $fav; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 speak-col" style="margin-bottom: 100px;">
            <div class="speaker" data-aos="fade-up" data-aos-delay="100">
              <img src="assets/img/speakers/1.jpg" alt="Speaker 1" class="img-fluid">
              <div class="details">
                <h3><a href="views/creator-details.php">Brenden Legros</a></h3>
                <p>Quas alias incidunt</p>
                <div class="social">
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-twitter"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-facebook"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-google-plus"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-linkedin"></i></a>

                  <a href="" class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                    <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                     width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                     </svg>
                    </i>
                  </a>

                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="300">
              <img src="assets/img/speakers/3.jpg" alt="Speaker 3" class="img-fluid">
              <div class="details">
                <h3><a href="views/creator-details.php">Cole Emmerich</a></h3>
                <p>Fugiat laborum et</p>
                <div class="social">
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-twitter"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-facebook"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-google-plus"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-linkedin"></i></a>
                  <a href="" class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                    <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                     width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                     </svg>
                    </i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 speak-col" style="margin-bottom: 100px;">
            <div class="speaker" data-aos="fade-up" data-aos-delay="100">
              <img src="assets/img/speakers/4.jpg" alt="Speaker 4" class="img-fluid">
              <div class="details">
                <h3><a href="views/creator-details.php">Jack Christiansen</a></h3>
                <p>Debitis iure vero</p>
                <div class="social">
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-twitter"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-facebook"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-google-plus"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-linkedin"></i></a>
                  <a href="" class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                    <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                     width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                     </svg>
                    </i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="200">
              <img src="assets/img/speakers/5.jpg" alt="Speaker 5" class="img-fluid">
              <div class="details">
                <h3><a href="views/creator-details.php">Alejandrin Littel</a></h3>
                <p>Qui molestiae natus</p>
                <div class="social">
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-twitter"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-facebook"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-google-plus"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-linkedin"></i></a>
                  <a href="" class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                    <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                     width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                     </svg>
                    </i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="300">
              <img src="assets/img/speakers/6.jpg" alt="Speaker 6" class="img-fluid">
              <div class="details">
                <h3><a href="views/creator-details.php">Willow Trantow</a></h3>
                <p>Non autem dicta</p>
                <div class="social">
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-twitter"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-facebook"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-google-plus"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-linkedin"></i></a>
                  <a href="" class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                    <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                     width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                     </svg>
                    </i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section><!-- End Speakers Section -->

    <!-- ======= Speakers Section ======= -->
    <section id="mr">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Most Trending</h2>
          <p>Here are some of our most trending creators </p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 " style="margin-bottom: 100px;">
            <div class="speaker" data-aos="fade-up" data-aos-delay="100">
              <img src="assets/img/speakers/1.jpg" alt="Speaker 1" class="img-fluid">
              <div class="details">
                <h3><a href="views/creator-details.php">Brenden Legros</a></h3>
                <p>Quas alias incidunt</p>
                <div class="social">
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-twitter"></i></a>
                  <a href="" class="btn btn-outline-danger "><i class="fa fa-facebook"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-google-plus"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-linkedin"></i></a>
                  <a href="" class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                    <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                     width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                     </svg>
                    </i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="200">
              <img src="assets/img/speakers/2.jpg" alt="Speaker 2" class="img-fluid">
              <div class="details">
                <h3><a href="views/creator-details.php">Hubert Hirthe</a></h3>
                <p>Consequuntur odio aut</p>
                <div class="social">
                  <a href=""class="btn btn-outline-danger"><i class="fa fa-twitter"></i></a>
                  <a href=""class="btn btn-outline-danger"><i class="fa fa-facebook"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-google-plus"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-linkedin"></i></a>
                  <a href="" class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                    <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                     width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                     </svg>
                    </i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="300">
              <img src="assets/img/speakers/3.jpg" alt="Speaker 3" class="img-fluid">
              <div class="details">
                <h3><a href="views/creator-details.php">Cole Emmerich</a></h3>
                <p>Fugiat laborum et</p>
                <div class="social">
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-twitter"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-facebook"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-google-plus"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-linkedin"></i></a>
                  <a href="" class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                    <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                     width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                     </svg>
                    </i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" style="margin-bottom: 100px;">
            <div class="speaker" data-aos="fade-up" data-aos-delay="100">
              <img src="assets/img/speakers/4.jpg" alt="Speaker 4" class="img-fluid">
              <div class="details">
                <h3><a href="views/creator-details.php">Jack Christiansen</a></h3>
                <p>Debitis iure vero</p>
                <div class="social">
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-twitter"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-facebook"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-google-plus"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-linkedin"></i></a>
                  <a href="" class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                    <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                     width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                     </svg>
                    </i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="200">
              <img src="assets/img/speakers/5.jpg" alt="Speaker 5" class="img-fluid">
              <div class="details">
                <h3><a href="views/creator-details.php">Alejandrin Littel</a></h3>
                <p>Qui molestiae natus</p>
                <div class="social">
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-twitter"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-facebook"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-google-plus"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-linkedin"></i></a>
                  <a href="" class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                    <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                     width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                     </svg>
                    </i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="300">
              <img src="assets/img/speakers/6.jpg" alt="Speaker 6" class="img-fluid">
              <div class="details">
                <h3><a href="views/creator-details.php">Willow Trantow</a></h3>
                <p>Non autem dicta</p>
                <p hidden>creator ID</p>
                <div class="social">
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-twitter"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-facebook"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-google-plus"></i></a>
                  <a href="" class="btn btn-outline-danger"><i class="fa fa-linkedin"></i></a>
                  <a href="" class="btn btn-outline-secondary fav" style="margin-left: 125px;">
                    <i class=""> <svg xmlns="http://www.w3.org/2000/svg"
                     width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                     </svg>
                    </i>
                  </a>
                  
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section><!-- End Speakers Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">


  </footer><!-- End  Footer -->

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
  <script src="assets/js/main.js"></script>

  <script>
    // Add item to favorites when favorites button has been clicked
    $(".speaker .fav").on('click', function(){
		var creator = $(this).parent().prev().html();
		
		$.post("views/control.php", {choice: 'favorite', email: <?=json_encode($_SESSION['userEmail']);?>,
        creatorid: creator}, function(data){
			  alert(data);
		});
	});

	// Add to history
	$( ".select" ).click(function( event ) {
    var creator = $(this).parent().parent().find(".code").html();

    $.post("views/control.php", {choice: 'history',  email: <?=json_encode($_SESSION['userEmail']);?>, 
      creatorid: creator}, function(data){
      return data;
    });
  });
		
  
  </script>

</body>

</html>