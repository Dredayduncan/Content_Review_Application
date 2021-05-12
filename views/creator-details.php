<?php
  //Establish Database Connection
  include "../auth/config.php";

  
  // Begin session
  session_start();

  // Get the items to display based on the role of the user 
  $editProfile = '';
  $editGallery = '';
  $editVideos = '';
  $menu = '';
  $info = '';
  $rate = '<section id="rating">

          <div class="container" data-aos="fade-up">
            <div class="section-header">
              <h2>Rate This Creator</h2>
              <p>Tell us what you think ?</p>
            </div>
          </div>

          <div  class=" rater container ">
            <div id="rater" class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                <input type="radio" class="star" id="star5" name="rating" value="5" /><label for="star5" title="5 star"></label>
                <input type="radio" class="star" id="star4" name="rating" value="4" /><label for="star4" title="4 star"></label>
                <input type="radio" class="star" id="star3" name="rating" value="3" /><label for="star3" title="3 star"></label>
                <input type="radio" class="star" id="star2" name="rating" value="2" /><label for="star2" title="2 star"></label>
                <input type="radio" class="star" id="star1" name="rating" value="1" /><label for="star1" title="1 star"></label>
            </div>
          </div>

        </section>';

  if (isset($_SESSION['cid'])){
    if ($_SESSION['cid'] == $_GET['cid']){
      $editProfile = '<div class="col-2">
                  <button id="profile" type="button" class="btn btn-outline-success" data-bs-toggle="modal" 
                  data-bs-target="#EditProfile">Edit Profile</button>
                  </div> ';

      $editGallery = '<div class="button d-flex justify-content-center mb-5">
                      <button id="galla" type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#Editgallery">
                      Edit Gallery</button>
                      </div>';

      $editVideos = '<div class="button d-flex justify-content-center mb-5">
                      <button id="vods" type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#Editvids">Edit Videos</button>
                      </div>';

      $rate = '';
    }
  }

  
  if (isset($_SESSION['role'])){
    // Check if the user or creator has rated the current creator
    $sql = "SELECT rating FROM Rating WHERE ratorid ='". $_SESSION['userEmail'] . "' and creator_id =". $_GET['cid'];

    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) == 1){
      $dat = mysqli_fetch_assoc($res);
      
      $rate .= "<script> document.getElementById('star".$dat['rating']."').click();</script>";
      
    }

    $menu = '<li><a href="history.php">History</a></li>
            <li><a href="favorites.php">Favourites</a></li>';

    if ($_SESSION['role'] == 'creator'){
      $info = '<li style="margin-top: -2%;"><a> 
        <div class="img-log-div">
          <img src="../assets/avis/'.$_SESSION["avi"].'" alt="Speaker 1" class="img-fluid img-log dropdown-toggle" data-bs-toggle="dropdown">

          <ul class="dropdown-menu" style="background-color: #060c22;">
            <form action="../index.php?logout=yes" method="post">
              <button type="submit" class="list-group-item btn btn-outline-success ml-4 pt-1 pl-1 pr-1 pb-1">Sign Out</button>
            </form>
            </ul>
        </div>
      </a></li>';
    }
    elseif ($_SESSION['role'] == 'user'){
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
    }
  }
  else{
    $rate = '';
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
  function socials1($twitch, $fb, $yt, $twitter, $linkedIn, $pw1, $pw2){
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
        $socials .= '<a href="'.$pw2.'"><i class="fa fa-globe"></i></a>';
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
          <p id='cType'>
            <?php 
              $cType = $creator['fname'] . ' has not updated their type of content :(';

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
              <h2 id='name'><?php echo $creator['fname'] . " " . $creator['lname']; ?></h2>
              <?php 
                echo socials1($creator['Twitch'], $creator['Facebook'], $creator['Youtube'], $creator['Twitter'], $creator['LinkedIn'], $creator['PWebsite1'], $creator['PWebsite2']); 

                $prebio = '<p id="bi" style="color: #6c757d;">';
                $bio = $creator['fname'] . ' has not updated their bio :(';
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
                        </div>
                      </div>

                      <div class="form-group row no-gutters mb-4">
                        <label class="col-md-4 col-form-label text-left" for="lname">Last Name</label>
                        <div class="col-md-8">
                            <input type="text" id="lname" name="creatorlname" class="form-control">
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
                        </div>
                      </div>

                      <div class="form-group row no-gutters mb-4">
                        <label class="col-md-4 col-form-label text-left" for="bio">Bio</label>
                        <div class="col-md-8">
                          <textarea id='bio' name = "bio" cols="36" rows="5"></textarea>
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
          
          <div id="owl-demo" class='owl-carousel owl-theme' data-aos='fade-up' data-aos-delay='100'>
          <?php
            $creatorid = $_GET['cid'];
            $sql = "SELECT content from Content WHERE creator_id = ".$creatorid." and contentType = 'IMAGE' ";
            $result = mysqli_query($conn, $sql);
            
            if(!$result)
                die("ERROR: Could not able to execute $sql. " . mysqli_error($conn));
            else{
                
                if(mysqli_num_rows($result)== 0){
                  echo "<p>".$creator["fname"]. " does not have any images :(</p>";
                }else{

                  $res = "";
                  $i = 0;
                  while($data = mysqli_fetch_array($result)){
                    $res .= "
                      <div class='item'><a href='".$data['content']."' class='venobox' id = ' img".$i." '><img src='".$data['content']."' alt=''></a></div>
                    ";

                    $i++;
                  }

                  echo $res;
                }
            }

          ?>
          </div>
        </div>
    
        </section><!-- End Gallery Section -->

        <div class="container ">

          <?php echo $editGallery; ?>
          
        <div class="modal fade" tabindex="-1" id="Editgallery" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                      <div id="image0" class="form-group row no-gutters mb-4">
                        <label class="col-md-4 col-form-label text-left" for="fname">image0</label>
                        <div class="col-md-8">
                            <input type="text" id="img0" name="img0" class="form-control gall">
                        </div>
                      </div>

                      <div class="contain">
                              <div class="btn btn-outline-success add-btn" > 
                                <svg  xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" 
                                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                              </div>

                              <div class="btn btn-outline-danger remove-btn" > 
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                              </div>
                            </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary saveImage">Save changes</button>
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

          <?php
            $creatorid = $_GET['cid'];
            $sql = "SELECT content from Content WHERE creator_id = ".$creatorid." and contentType = 'VIDEO' ";
            $result = mysqli_query($conn, $sql);
            if(!$result)
                die("ERROR: Could not able to execute $sql. " . mysqli_error($conn));
            else{
                
                if(mysqli_num_rows($result)== 0){
                  echo "<p>".$creator["fname"]. " does not have any videos :(</p>";
                }else{
                  echo "
                    <div class='container'>
                      <div class='row'>
                    ";
                  while($data = mysqli_fetch_array($result)){
                    echo "
                      <
                      <iframe class='embed-responsive-item col-lg-4 col-md-6' src='".$data['content']."' style='margin-bottom: 2%; height: 20vw;' 
                        title='YouTube video player' frameborder='0' 
                        allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen>
                      </iframe>
                    ";
                  }
                  echo "</div></div>";
                }
                
                
            }

          ?>

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

                  <div id="video0" class="form-group row no-gutters mb-4">
                    <label class="col-md-4 col-form-label text-left" for="vid0">video0</label>
                    <div class="col-md-8">
                        <input type="text" id="vid0" name="vid0" class="form-control vids" >
                    </div>
                  </div>

                  
                  <div class="contain">
                          <div class="btn btn-outline-success addd-btn" > 
                            <svg  xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" 
                                class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                          </div>

                          <div class="rm-btn btn btn-outline-danger" > 
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                          </div>
                        </div>
                  </div>

                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveVideo">Save changes</button>
                  </div>
                </div>
              </div>
            </div> 
        </div>
        </section>    

        <?php echo $rate; ?>

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
    var item = 0;
    var imgItem = 0;
    var vidItem = 0;
    
    $(document).ready(function(){

    // Manage buttons in the edit profile modal
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
        }
        else{
          $('.add-button').fadeIn(function(){
            $(this).show();
        });
        }
      });

    // Manage buttons in the edit image modal

    // When the add button is clicked
    $('.add-btn').on("click", function(){

        var id = "image"+ (imgItem + 1);
        var nonID = "img"+ (imgItem + 1);
         html = '<div id='+ id +' class="form-group row no-gutters mb-4 animated bounceInLeft">' +
                      '<label class="col-md-4 col-form-label text-left" for="'+ id +'">'+ id +'</label>' +
                      '<div class="col-md-8">' +
                          '<input type="text" id='+ nonID +' name='+ nonID +' class="form-control gall">' +
                      '</div>' +
                    '</div>';

        // Add new social field
        var el = '#image' + imgItem;
        $(html).insertAfter(el);

        // Display remove button
        $('.remove-btn').fadeIn(function(){
            $(this).show();
        });

        // Increment imgItem
        imgItem++;
        
      });
    
      // When the remove button is clicked 
      $('.remove-btn').on('click', function(){

        // Remove the recently added social field 
        $('#image'+ (imgItem)).removeClass('bounceInLeft').addClass('bounceOutRight')
          .fadeOut(function(){
            $(this).remove();
        });

        // decrement imgItem
        imgItem--;

        // Remove remove button if the social fields are only one
        if(imgItem == 0){
          $('.remove-btn').fadeOut(function(){
            $(this).hide()
          });
        }
      });

    // Manage buttons in the edit video modal

    // When the add button is clicked
    $('.addd-btn').on("click", function(){

      var id = "video"+ (vidItem + 1);
      var nonID = "vid"+ (vidItem + 1);
      html = '<div id='+ id +' class="form-group row no-gutters mb-4 animated bounceInLeft">' +
                    '<label class="col-md-4 col-form-label text-left" for="'+ id +'">'+ id +'</label>' +
                    '<div class="col-md-8">' +
                        '<input type="text" id='+ nonID +' name='+ nonID +' class="form-control vids">' +
                    '</div>' +
                  '</div>';

      // Add new social field
      var el = '#video' + vidItem;
      $(html).insertAfter(el);

      // Display remove button
      $('.rm-btn').fadeIn(function(){
          $(this).show();
      });

      // Increment vidItem
      vidItem++;

    });

    // When the remove button is clicked 
    $('.rm-btn').on('click', function(){

      // Remove the recently added social field 
      $('#video'+ (vidItem)).removeClass('bounceInLeft').addClass('bounceOutRight')
        .fadeOut(function(){
          $(this).remove();
      });

      // decrement vidItem
      vidItem--;

      // Remove remove button if the social fields are only one
      if(vidItem == 0){
        $('.rm-btn').fadeOut(function(){
          $(this).hide()
        });
      }
      });
    });

    // Update the image table when save changes is clicked 
    $('.saveImage').on('click', function(){
        var images = $('.modal-body').find('.gall');

        // create array of image links
        var imgs = [];

        // populatee the array
        for (var i = 0; i < images.length; i++) {
          imgs.push(images[i].value);
        }

        $.post("control.php", {choice: 'UpdateImages', images: JSON.stringify(imgs)}, function(data){
          window.location.replace("creator-details.php?cid=" + <?=json_encode($_SESSION['cid']);?>);
         
        });
    });

    // Update the video table when save changes is clicked 
    $('.saveVideo').on('click', function(){
        var videos = $('.modal-body').find('.vids');

        // create array of image links
        var vids = [];

        // populatee the array
        for (var i = 0; i < videos.length; i++) {
          vids.push(videos[i].value);
        }

        $.post("control.php", {choice: 'UpdateVideos', videos: JSON.stringify(vids)}, function(data){
          //window.location.replace("creator-details.php?cid=" + <?=json_encode($_SESSION['cid']);?>);
          alert(data);
          
        });
          return false;
    });

    // Manage owl carousel 
    var owl = $("#owl-demo");
 
    owl.owlCarousel({
        items: 4,
        navigation : true
    });

    // Rate the creator when the stars have been clicked  
    $(".star").on("click",function(){
  
      $.post("control.php", {choice: 'rating', rating: $(this).val(), creatorid: <?=json_encode($_GET['cid']);?>, ratorid: <?=json_encode($_SESSION['userEmail']);?>}, function(data){
            alert(data);
        });
    });

    // Fill the profile inputs when the edit profile button has been clicked 
    $('#profile').on('click', function(){
      $('#fname').val($('.details h2').html().split(" ")[0]);
      $('#lname').val($('.details h2').html().split(" ")[1]);
      $('#pic').attr('src', $('.img-fluid').attr('src'));

      var content = $('#cType').html().replace(/\s+/g, " ").trim().split(" ");

      if (content.length == 1){
        $('#content').val(content).change();
      }
      else{
        $('#content').val(' ');
      }

      bio = $('#bi').html().replace(/\s+/g, " ").trim().split(" ");
  
      if (bio[0] !== $('.details h2').html().replace(/\s+/g, " ").trim().split(" ")[0] ){
        $('#bio').val($('#bi').html());
      }
      else{
        $('#bio').val('');
      }

      var links = $('.socials a');

    });

    // Fill the profile inputs when the edit images button has been clicked 
    $('#galla').on('click', function(){
  
      // Get the images from the creator
      var imgs = $('.item a');

      // Get the links and store them in an array
      var imgLinks = [];

      for (var i = 0; i < imgs.length; i++){
        imgLinks.push(imgs[i].getAttribute('href'));
      }

      // populate the modal with the slots for the images
      var images = '';
      for (var i = 0; i < imgLinks.length; i++){
        var id = "image"+ (imgItem + 1);
        var nonID = "img"+ (imgItem + 1);
        
        html = '<div id='+ id +' class="form-group row no-gutters mb-4 animated bounceInLeft">' +
                  '<label class="col-md-4 col-form-label text-left" for="'+ id +'">'+ id +'</label>' +
                  '<div class="col-md-8">' +
                      '<input type="text" id='+ nonID +' name='+ nonID +' class="form-control gall" value="'+ imgLinks[i] +'">' +
                  '</div>' +
                '</div>';
        
        images += html;

        imgItem++;
      }

      // Append the results to the images modal
      $(images).insertAfter('#image0');

      if (imgs.length > 1){
        $('#image0').remove();
      }
      
    });

    // Fill the profile inputs when the edit videos button has been clicked 
    $('#vods').on('click', function(){
      // Get the images from the creator
      var vids = $('.embed-responsive-item');

      // Get the links and store them in an array
      var vidLinks = [];

      for (var i = 0; i < vids.length; i++){
        vidLinks.push(vids[i].getAttribute('href'));
      }

      // populate the modal with the slots for the images
      var videos = '';
      for (var i = 0; i < vidLinks.length; i++){
        var id = "video"+ (vidItem + 1);
        var nonID = "vid"+ (vidItem + 1);
        
        html = '<div id='+ id +' class="form-group row no-gutters mb-4 animated bounceInLeft">' +
                  '<label class="col-md-4 col-form-label text-left" for="'+ id +'">'+ id +'</label>' +
                  '<div class="col-md-8">' +
                      '<input type="text" id='+ nonID +' name='+ nonID +' class="form-control gall" value="'+ vidLinks[i] +'">' +
                  '</div>' +
                '</div>';
        
        videos += html;

        vidItem++;
      }

      // Append the results to the videos modal
      $(videos).insertAfter('#video0');

      if (vids.length > 1){
        $('#video0').remove();
      }
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