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
            <div class=" col-10 d-flex justify-content-center">
            <h2>Creator Details</h2>
            </div>
            <div class=" col-2">
              <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#EditProfile">Edit Profile</button>
            </div>
          
        </div>
        <p>Content Type.</p>
        <!-- Edit Profile Modal -->
        <div class="modal fade" tabindex="-1" id="EditProfile" aria-hidden="true">]
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


        <div class="row">
          <div class="col-md-6">
            <img src="../assets/img/speakers/1.jpg" alt="Speaker 1" class="img-fluid">
          </div>

          <div class="col-md-6">
            <div class="details">
              <h2>Brenden Legros</h2>
              <div class="social">
                <a href=""><i class="fa fa-twitter"></i></a>
                <a href=""><i class="fa fa-facebook"></i></a>
                <a href=""><i class="fa fa-google-plus"></i></a>
                <a href=""><i class="fa fa-linkedin"></i></a>
              </div>
              <p>Voluptatem perferendis sed assumenda voluptatibus. Laudantium molestiae sint. Doloremque odio dolore dolore sit. Quae labore alias ea omnis ex expedita sapiente molestias atque. Optio voluptas et.</p>

              <p>Aboriosam inventore dolorem inventore nam est esse. Aperiam voluptatem nisi molestias laborum ut. Porro dignissimos eum. Tempore dolores minus unde est voluptatum incidunt ut aperiam.</p>

              <p>Et dolore blanditiis officiis non quod id possimus. Optio non commodi alias sint culpa sapiente nihil ipsa magnam. Qui eum alias provident omnis incidunt aut. Eius et officia corrupti omnis error vel quia omnis velit. In qui debitis autem aperiam voluptates unde sunt et facilis.</p>
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