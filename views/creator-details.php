<?php
  //Establish Database Connection
  include "../auth/config.php";

  
  // Begin session
  session_start();

  $editProfile = '';
  $editGallery = '';
  $editVideos = '';
  $menu = '';
  $info = '';

  if (isset($_SESSION['cid'])){
    if ($_SESSION['cid'] == $_GET['cid']){
      $editProfile = '<div class="col-2">
                  <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" 
                  data-bs-target="#EditProfile">Edit Profile</button>
                  </div> ';

      $editGallery = '<div class="button d-flex justify-content-center mb-5">
                      <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#Editgallery">
                      Edit Gallery</button>
                      </div>';

      $editVideos = '<div class="button d-flex justify-content-center mb-5">
                      <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#Editvids">Edit Videos</button>
                      </div>';
    }
  }

  
  if (isset($_SESSION['role'])){
    $menu = '<li><a href="history.php">History</a></li>
            <li><a href="favorites.php">Favourites</a></li>';

    if ($_SESSION['role'] == 'creator'){
      $info = '<li style="margin-top: -2%;"><a href=""> 
        <div class="img-log-div">
          <img src="../assets/avis/'.$_SESSION["avi"].'" alt="Speaker 1" class="img-fluid img-log">
        </div>
      </a></li>';
    }
    elseif ($_SESSION['role'] == 'user'){
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
  
  // Get creator information
  $sql = "SELECT * FROM Users
  INNER JOIN Creators on Users.email = Creators.email
  INNER JOIN CreatorSocial on CreatorSocial.creator_id = Creators.creator_id
  WHERE Creators.creator_id = ".$_GET['cid'];

  $creator = '';

  // Execute the query 
  $result = mysqli_query($conn, $sql);

  //  Check if the query executes
  if ($result){

    // Get creator details
    $creator = mysqli_fetch_assoc($result);
  }
  else{
    die("ERROR: Could not able to execute $result. " . mysqli_error($conn));
  }

  // Generate socials for existing social fields
  function socials($twitch, $fb, $yt, $twitter, $linkedIn, $pw1, $pw2){
    $socials = '<div class="social">';
    if ($twitch != null){
        $socials .= '<a href="'.$twitch.'"><i class="fa fa-twitch"></i></a>';
    }

    if ($fb != null){
        $socials .= '<a href="'.$fb.'"><i class="fa fa-facebook"></i></a>';
    }
    
    if ($yt != null){
        $socials .= '<a href="'.$yt.'"><i class="fa fa-youtube-play"></i></a>';
    }

    if ($twitter != null){
        $socials .= '<a href="'.$twitter.'"><i class="fa fa-twitter"></i></a>';
    }

    if ($linkedIn != null){
        $socials .= '<a href="'.$linkedIn.'"><i class="fa fa-linkedin"></i></a>';
    }

    if ($pw1 != null){
        $socials .= '<a href="'.$pw1.'"><i class="fa fa-globe"></i></a>';
    }

    if ($pw2 != null){
        $socials .= '<a href="'.$pw2.'"><i class="fas fa-globe"></i></a>';
    }

    $socials .= '</div>';

    return $socials;
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
  <header id="header" class="header-fixed">
    <div class="container">

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="../index.php">Home</a></li>
          <li><a href="#speakers-details">Creator Details</a></li>
          <li><a href="#gallery">Gallery</a></li>
          <li><a href="#videos">Videos</a></li>
          <?php
            echo $menu;
            echo $info;
          ?>
          
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- End Header -->

  <main id="main" class="main-page">

    <!-- ======= Speaker Details Sectionn ======= -->
    <section id="speakers-details">
      <div class="container">
        <div class="section-header">
          <div class="row">
            <div class=" col-10 d-flex justify-content-center mx-auto">
              <h2>Creator Details</h2>
            </div>
            <?php echo $editProfile; ?>
          </div>
          <p>
            <?php 
              $cType = "Update the kind of content you produce!";

              if (!empty($creator['contentType'])){
                $cType = $creator['contentType'];
              }

              echo $cType;
            ?>
          </p>
        </div>

        <div class="row">
          <div class="col-md-6">
            <img src="../assets/avis/<?php echo $creator['avi']; ?>" alt="Creator" class="img-fluid">
          </div>

          <div class="col-md-6">
            <div class="details">
              <h2><?php echo $creator['fname'] . " " . $creator['lname']; ?></h2>
              <?php 
                echo socials($creator['Twitch'], $creator['Facebook'], $creator['Youtube'], $creator['Twitter'], $creator['LinkedIn'], $creator['PWebsite1'], $creator['PWebsite2']); 

                $prebio = '<p style="color: #6c757d;">';
                $bio = 'Nothing much to see here!';
                $probio = '</p>';

                if (!empty($creator['bio'])){
                  $bio = $creator['bio'];
                }

                echo $prebio . $bio . $probio;
              ?>
            </div>
          </div>
        </div>

        <!-- Edit Profile Modal -->
        <div class="modal fade" tabindex="-1" id="EditProfile" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                <div class="modal-body">
                  <form action="creatorDetailsUpdate.php" id = "update" method="POST" enctype="multipart/form-data">
                    <div class="form-group row no-gutters mb-4">
                        <label class="col-md-4 col-form-label text-left" for="fname">First Name</label>
                        <div class="col-md-8">
                            <input type="text" id="fname" name="creatorfname" class="form-control">
                            <input type="number" id="fnameID" name="fname" class="form-control" style="display:none;">
                        </div>
                      </div>

                      <div class="form-group row no-gutters mb-4">
                        <label class="col-md-4 col-form-label text-left" for="lname">Last Name</label>
                        <div class="col-md-8">
                            <input type="text" id="lname" name="creatorlname" class="form-control">
                            <input type="number" id="lnameID" name="lname" class="form-control" style="display:none;">
                        </div>
                      </div>

                      <div class="form-group row no-gutters mb-4">
                        <label class="col-md-4 col-form-label text-left" for="content">Choose content</label>
                        <div class="col-md-8">
                        <select id="content" name="content">
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
                            <input type="number" id="lnameID" name="lname" class="form-control" style="display:none;">
                        </div>
                      </div>

                      <div class="form-group row no-gutters mb-4">
                        <label class="col-md-4 col-form-label text-left" for="bio">Bio</label>
                        <div class="col-md-8">
                          <textarea name = "bio" cols="36" rows="5"></textarea>
                          <input type="number" id="bioID" name="bio1" class="form-control" style="display:none;">
                        </div>
                      </div>

                      <div id="social0" class="form-group row no-gutters mb-1">
                        <label class="col-md-4 col-form-label text-left" for="twitch">Twitch</label>
                        <div class="col-md-8">
                            <input type="text" id="name" name="twitch" class="form-control">

                        </div>
                      </div>

                    <div class="container d-flex justify-content-center mb-4" >
                        <div class="contain">
                          <div class="add-button btn btn-outline-success" > 
                            <svg  xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" 
                                class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                          </div>

                          <div class="remove-button btn btn-outline-danger" > 
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                          </div>
                        </div>
                      
                      </div>

                      <div class="form-group mb-3" style="background-color: transparent;">
                        <input type="file" id="picture" onchange="pictureInput(event)" style="display: none;" name="file" />
                        <input id="pic-btn" type="button" class="form-control btn btn-primary rounded submit " 
                          value="Select Profile Picture..."/>
                      </div>
                      
                      <div class="d-flex justify-content-center">
                        <img id="pic" height="200" style="margin-top: -3%; margin-bottom: 1%; border-radius: 50px;">
                      </div>

                      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form = "update" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>

                  </div>
                  </form>`
              </div>
            </div>
          </div>
        </div>

    </section>


        <!-- ======= Gallery Section ======= -->
        <section id="gallery">

          <div class="container" data-aos="fade-up">
            <div class="section-header">
              <h2>Gallery</h2>
              <p>Check our gallery from the recent events</p>
            </div>
          </div>
    
          <div class="owl-carousel gallery-carousel" data-aos="fade-up" data-aos-delay="100">
            <a href="../assets/img/gallery/1.jpg" class="venobox" data-gall="gallery-carousel"><img src="../assets/img/gallery/1.jpg" alt=""></a>
            <a href="../assets/img/gallery/2.jpg" class="venobox" data-gall="gallery-carousel"><img src="../assets/img/gallery/2.jpg" alt=""></a>
            <a href="../assets/img/gallery/3.jpg" class="venobox" data-gall="gallery-carousel"><img src="../assets/img/gallery/3.jpg" alt=""></a>
            <a href="../assets/img/gallery/4.jpg" class="venobox" data-gall="gallery-carousel"><img src="../assets/img/gallery/4.jpg" alt=""></a>
            <a href="../assets/img/gallery/5.jpg" class="venobox" data-gall="gallery-carousel"><img src="../assets/img/gallery/5.jpg" alt=""></a>
            <a href="../assets/img/gallery/6.jpg" class="venobox" data-gall="gallery-carousel"><img src="../assets/img/gallery/6.jpg" alt=""></a>
            <a href="../assets/img/gallery/7.jpg" class="venobox" data-gall="gallery-carousel"><img src="../assets/img/gallery/7.jpg" alt=""></a>
            <a href="../assets/img/gallery/8.jpg" class="venobox" data-gall="gallery-carousel"><img src="../assets/img/gallery/8.jpg" alt=""></a>
          </div>
    
        </section><!-- End Gallery Section -->

        <div class="container ">

          <?php echo $editGallery; ?>
          
        <div class="modal fade" tabindex="-1" id="Editgallery" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                  <div class="form-group row no-gutters mb-4">
                    <label class="col-md-4 col-form-label text-left" for="fname">First Name</label>
                    <div class="col-md-8">
                        <input type="text" id="fname" name="creatorfname" class="form-control">
                        <input type="number" id="fnameID" name="fnameID" class="form-control" style="display:none;">
                    </div>
                  </div>

                  <div class="contain">
                          <div class="add-button btn btn-outline-success" > 
                            <svg  xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" 
                                class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                          </div>

                          <div class="remove-button btn btn-outline-danger" > 
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                          </div>
                        </div>
                  </div>

                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div> 
        </div>


        

        <section id="videos">
          <div class="container" data-aos="fade-up">
            <div class="section-header">
              <h2>Videos</h2>
              <p>Check Out My Videos</p>
            </div>
          </div>

          <div class="container">
            <div class="row">
              <iframe class="embed-responsive-item col-lg-4 col-md-6" src="https://www.youtube.com/embed/PwGv6qhOlvI" style="margin-bottom: 2%; height: 20vw;" 
                title="YouTube video player" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
              </iframe>

              <iframe class="embed-responsive-item col-lg-4 col-md-6" src="https://www.youtube.com/embed/7eLfmimPs4E" style="margin-bottom: 2%; height: 20vw;" 
                title="YouTube video player" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
              </iframe>

              <iframe class="embed-responsive-item col-lg-4 col-md-6" src="https://www.youtube.com/embed/14TzFWrhsms" style="margin-bottom: 2%; height: 20vw;" 
                title="YouTube video player" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
              </iframe>

              <iframe class="embed-responsive-item col-lg-4 col-md-6" src="https://www.youtube.com/embed/cvV28xzjclA" style="margin-bottom: 2%; height: 20vw;" 
                title="YouTube video player" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
              </iframe>
    
              <iframe class="embed-responsive-item col-lg-4 col-md-6" style="margin-bottom: 2%; height: 20vw;" 
              frameborder="0" 
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" src="https://www.dailymotion.com/embed/video/x8103m5"  allowfullscreen> 
              </iframe> 
 
            </div>  
          </div>

          <div class="container ">
          <?php echo $editVideos; ?>

        <div class="modal fade" tabindex="-1" id="Editvids" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Videos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                  <div class="form-group row no-gutters mb-4">
                    <label class="col-md-4 col-form-label text-left" for="fname">First Video</label>
                    <div class="col-md-8">
                        <input type="text" id="fname" name="creatorfname" class="form-control">
                        <input type="number" id="fnameID" name="fnameID" class="form-control" style="display:none;">
                    </div>
                  </div>

                  
                  <div class="contain">
                          <div class="add-button btn btn-outline-success" > 
                            <svg  xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" 
                                class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                          </div>

                          <div class="remove-button btn btn-outline-danger" > 
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                          </div>
                        </div>
                  </div>

                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div> 
        </div>
        </section>    

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
    var item = 0;
    
    $(document).ready(function(){
      var socials = ['Twitter', 'Facebook', 'LinkedIn', 'Youtube', 'Personal Website 1', 'Personal Website 2'];

      // When the add button is clicked
      $('.add-button').on("click", function(){
        html = '<div id="social'+ (item + 1) +'" class="form-group row no-gutters mb-1 animated bounceInLeft">' +
                      '<label class="col-md-4 col-form-label text-left" for="' + socials[item] + '">'+ socials[item] +'</label>' +
                      '<div class="col-md-8">' +
                          '<input type="text" id="' + socials[item] + '" name="' + socials[item] + '" class="form-control">' +
                      '</div>' +
                    '</div>';

       

        // Add new social field
        var el = '#social' + item;
        $(html).insertAfter(el);

        // Display remove button
        $('.remove-button').fadeIn(function(){
            $(this).show();
        });

        // Increment item
        item++;

        // Remove add button if the social fields are full
        if(item > 5){
          $('.add-button').fadeOut(function(){
            $(this).hide()
          });
        }
        
      });
    
      // When the remove button is clicked 
      $('.remove-button').on('click', function(){

        // Remove the recently added social field 
        $('#social'+ (item)).removeClass('bounceInLeft').addClass('bounceOutRight')
          .fadeOut(function(){
            $(this).remove();
        });

        // decrement item
        item--;

        // Remove remove button if the social fields are only one
        if(item == 0){
          $('.remove-button').fadeOut(function(){
            $(this).hide()
          });
        }else{
          $('.add-button').fadeIn(function(){
            $(this).show();
        });
        }
      });
    });
    
  </script>

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

  <!-- Update the avi -->
  <script>
		function pictureInput(event){
      var input = document.getElementById('picture');

      var reader = new FileReader();
      reader.onload = function(){
        var dataURL = reader.result;
        var output = document.getElementById('pic');
        output.src = dataURL;
      };
      reader.readAsDataURL(input.files[0]);

      return false;
      }

		$('#pic-btn').on('click', function(){
			$('#picture').click();
		});
	</script>

</body>

</html>