<?php

session_start();

?>

<?php require("libs/fetch_data.php");?> 
<?php require('blogadmin/dbcon.php');?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title><?php getwebname("titles"); echo"|"; gettagline("titles");?>| Sign Up</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link id="browser_favicon" rel="shortcut icon" href="blogadmin/images/<?php geticon("titles"); ?>">
	<meta charset="utf-8" name="description" content="<?php getshortdescription("titles");?>">
	<meta name="keywords" content="<?php getkeywords("titles");?>" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/single.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800"
	rel="stylesheet">
</head>

<body>

<?php
// include 'blogadmin/dbcon.php'

if(isset($_POST['submit'])){
	$full_name	 		= mysqli_real_escape_string($con, $_POST['full_name']);
	$email		 		= mysqli_real_escape_string($con, $_POST['email']);
	$phone_number 		= mysqli_real_escape_string($con, $_POST['phone_number']);
	$password 			= mysqli_real_escape_string($con, $_POST['password']);
	$conform_password 	= mysqli_real_escape_string($con, $_POST['conform_password']);

	$pass  = password_hash($password, PASSWORD_BCRYPT);
	$cpass = password_hash($conform_password, PASSWORD_BCRYPT);

	$emailquery = " select * from signup where email='$email' ";
	$query = mysqli_query($con, $emailquery);

	$emailcount = mysqli_num_rows($query);

	if($emailcount>0){
		echo "email already exists";
	}else{
			if($password === $conform_password){

				$insertquery = "insert into signup(full_name, email, phone_number, password, conform_password) values('$full_name','$email','$phone_number','$pass','$cpass')";
			
				$iquery = mysqli_query($con, $insertquery);
						if($con){
								?>
									<script>
										alert("Inserted Sucessful");
									</script>
								<?php
							}else{
								?>
									<script>
										alert("No Connection");
									</script>
								<?php
								}
							
				}else{
					?>
						<script>
							alert("password are not matching ");
						</script>
					<?php
				}
		}

}

?>
	<!--/main-->

<section class="middle-sec-agileinfo-w3lr">

	<div>
			<div class="container">

				<div class="card mb-2 bg-light">
					<div class="col-lg-6">
							<h1 class="card-title mb-2 text-center">Sign Up Here!</h1>
							<!-- <p class="text-center">Fill up the form with correct values.</p> -->
							<p>
								<a herf="" class="btn btn-block btn-gmail"> <i class="fa fa-gmail"></i>Login via Gmail</a>
								<a herf="" class="btn btn-block btn-facebook"> <i class="fa fa-facebook-f"></i> Login via facebook</a>
							</p>

							<p class="divider-text">
								<span class="bg-light">OR</span>
							</p>
						<form action="<?php echo htmlentities($_SERVER['PHP_SELF'] ); ?>" method="POST">

							<label for="fullname"><b>Full Name</b></label>
							<input class="form-control" id="full_name" type="text" name="full_name" required>

							<label for="email"><b>Email </b></label>
							<input class="form-control" id="email" type="email" name="email" required>

							<label for="phonenumber"><b>Phone Number</b></label>
							<input class="form-control" id="phone_number"  type="phonenumber" name="phone_number" required>

							<label for="password"><b>Password</b></label>
							<input class="form-control" id="password" type="password" name="password" required>

                    	    <label for="conform_password"><b>Conform Password</b></label>
							<input class="form-control" id="conform_password" type="conform_password" name="conform_password" required>
							
							<hr class="mb-3">
							<input class="btn btn-primary" type="submit" id="signup" name="submit" value="sign up">

							<p class="text-center">Have an account? <a href="signin.php">Sign In</a> </p>
						</form>
				</div>			

	
				</div>
			</div>
		</section>
	<!--//main-->
	

	
					<!---->
					<!-- js -->
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
					<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
					 <script type="text/javascript">

					
					
					// <script src="js/jquery-2.2.3.min.js"></script>
					<!-- //js -->
					<!--/ start-smoth-scrolling -->
					<script src="js/move-top.js"></script>
					<script src="js/easing.js"></script>
					<script>
						jQuery(document).ready(function ($) {
							$(".scroll").click(function (event) {
								event.preventDefault();
								$('html,body').animate({
									scrollTop: $(this.hash).offset().top
								}, 900);
							});
						});
					</script>
			 		<!--// end-smoth-scrolling -->

					<script>
						$(document).ready(function () {
			/*
									var defaults = {
							  			containerID: 'toTop', // fading element id
										containerHoverID: 'toTopHover', // fading element hover id
										scrollSpeed: 1200,
										easingType: 'linear' 
							 		};
							 		*/

							 		$().UItoTop({
							 			easingType: 'easeOutQuart'
							 		});

							 	});
							 </script>
							 <a href="#home" class="scroll" id="toTop" style="display: block;">
							 	<span id="toTopHover" style="opacity: 1;"> </span>
							 </a>

							 <!-- //Custom-JavaScript-File-Links -->
							 <script src="js/bootstrap.js"></script>


							</body>

							</html>