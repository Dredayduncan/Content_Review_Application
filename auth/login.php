<!doctype html>
<html lang="en">
  <head>
  	<title>Login </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="../css/style2.css">

	</head>
	<body  style="background-color:rgb(37, 150, 190);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"> </h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(images/bg-1.jpg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="d-flex align-items-center justify-content-center btn-outline-danger" style="border-radius: 50%; font-size: 16px; width: 40px;height: 40px;"><span class="fa fa-facebook"></span></a>
										<a href="#" class=" d-flex align-items-center justify-content-center btn-outline-danger" style="border-radius: 50%; font-size: 16px; width: 40px;height: 40px;"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
							<form action="loginBack.php" class="signin-form" method="POST">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Email</label>
			      			<input type="text" name='email' class="form-control" placeholder="Email" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" name='password' class="form-control" placeholder="Password" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class=" btn btn-danger rounded submit px-3" style="width:365px;">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-danger mb-0">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
										<a href="#">Forgot Password</a>
									</div>
		            </div>
		          </form>
		          <p class="text-center">Sign up as  <a data-toggle="tab" href="signup.php?role=user">a user</a></p>
				  <h6 class="text-center"> OR</h6>
				  <p class="text-center">Sign up  <a data-toggle="tab" href="signup.php?role=creator">as a creator</a></p>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="/js/jquery.min.js"></script>
  <script src="/js/popper.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/main.js"></script>

	</body>
</html>

