<?php
	// Check if the user is a creator
	$pic = "";
	$role = "user";

	if (!isset($_GET['role'])){
		header("Location: login.php");
	}

	if ($_GET['role'] == 'creator'){
		$role = 'creator';
		$pic = '<div class="form-group mb-3" style="background-color: transparent;">
		<input type="file" id="picture" onchange="pictureInput(event)" style="display: none;" name="file" />
		<input id="pic-btn" style="width:365px;" type="button" class=" btn btn-danger rounded submit px-3" 
		value="Select Profile Picture..."/></div>
		<div class="d-flex justify-content-center">
			<img id="pic" height="200" style="margin-top: -3%; margin-bottom: 1%; border-radius: 50px;">
		</div>';
	}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Sign Up </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="../css/style2.css">

	</head>
	<body style="background-color: #060c22;">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(../images/signup.jpg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100 d-flex justify-content-center">
			      			<h3 class="mb-4">Sign Up</h3>
			      		</div>
			      	</div>
					<form id="signup" action="signupBack.php" class="signin-form" method="POST" enctype="multipart/form-data" >
			      		<div class="form-group mb-3">
			      			<label class="label" for="fname">First Name</label>
			      			<input type="text" name="fname" class="form-control" placeholder="First name" required>
						</div>

						<div class="form-group mb-3">
			      			<label class="label" for="lname">Last Name</label>
			      			<input type="text" name="lname" class="form-control" placeholder="Last name" required>
						</div>

						<div class="form-group mb-3">
			      			<label class="label" for="email">Email Address</label>
			      			<input type="text" name="email" class="form-control" placeholder="Email" required>
						</div>

						<div class="form-group mb-3">
							<label class="label" for="password">Password</label>
							<input type="password" name="password" class="form-control" placeholder="Password" required>
						</div>

						<div class="form-group mb-3">
							<label class="label" for="password2">Password</label>
							<input type="password" name="pass" class="form-control" placeholder="Re-Enter Password" required>
							<input name="role" class="form-control" style="display: none;" value="<?php echo $role; ?>">
						</div>

						<?php echo $pic;?>
						
						<div class="form-group">
							<button type="submit" form="signup" class=" btn btn-danger rounded submit px-3" style="width:365px;">Sign Up</button>
						</div>
		          </form>
		          <p class="text-center">Already have an account? <a data-toggle="tab" href="login.php">Log in</a></p>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
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

