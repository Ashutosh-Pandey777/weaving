<?php require("libs/fetch_data.php");?> 
<?php require('blogadmin/configs.php');?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title><?php getwebname("titles"); echo"|"; gettagline("titles");?>| Soft-Skill</title>
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
	<!--Header-->
	<?php include("header.php");?>
	<!--//header-->
	<!--/banner-->
	<div>
		<img src="images/banner.jpeg" height="300" width="1525">
	</div>
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="index.php">Home</a>
		</li>
		<li class="breadcrumb-item active">Soft-Skill</li>
	</ol>
	<!--//banner-->
	<!--/main-->

<section class="main-content-w3layouts-agileits">
	<div class="container">	
			<h3 class="tittle">Soft-Skill</h3>
	</div>
	<div>
		<form action="soft-skill.php" method="post">
			<div class="container">

				<div class="row">
					<div class="col-lg-6">
						<h1>Registration</h1>
						<p>Fill up the form with correct values.</p>
						<hr class="mb-3">
						<label for="firstname"><b>First Name</b></label>
						<input class="form-control" id="first_name" type="text" name="first_name" required>

						<label for="lastname"><b>Last Name</b></label>
						<input class="form-control" id="last_name"  type="text" name="last_name" required>

						<label for="email"><b>Email </b></label>
						<input class="form-control" id="email" type="email" name="email" required>

						<label for="address"><b>Address</b></label>
						<input class="form-control" id="address" type="text" name="address" required>

						<label for="phonenumber"><b>Phone Number</b></label>
						<input class="form-control" id="phone_number"  type="phonenumber" name="phone_number" required>

						<label for="skill"><b>Required Skill</b></label>
						<input class="form-control" id="skill" type="skill" name="skill" required>

						<hr class="mb-3">
						<input class="btn btn-primary" type="submit" id="register" name="create" value="Register">
					</div>
			
			
		</form>
	 


	<!--/right-->
	<aside class="col-lg-6 agileits-w3ls-right-blog-con text-right">
					<div class="right-blog-info text-left">
						<h4><strong>Categories</strong></h4>
						<ul class="list-group single">
							<?php countcategories();?>
						</ul>
						<div class="tech-btm widget_social">
							<h4>Stay Connected</h4>
							<ul>
								<li>
									<a class="facebook" href="<?php getlinks("links","facebook");?>">
										<i class="fab fa-facebook-f"></i>
										<span class="count"></span> Facebook</a>
									</li>

										<li>
											<a class="twitter" href="<?php getlinks("links","twitter");?>">
												<i class="fab fa-twitter"></i>
												<span class="count"></span> Twitter</a>
											</li>
												<li>
													<a class="instagram" href="<?php getlinks("links","instagram");?>">
														<i class="fab fa-instagram"></i>
														<span class="count"></span> Instagram</a>
														</li>
												<li>
													<a class="youtube" href="<?php getlinks("links","youtube");?>">
														<i class="fab fa-youtube"></i>
														<span class="count"></span> Youtube</a>
													</li>
													<li>
														<a class="linked" href="<?php getlinks("links","linkedin");?>">
															<i class="fab fa-linkedin"></i>
															<span class="count"></span> Linkedin</a>
														</li>

											</ul>
										</div>
									</div>
								</aside>

					<!--//right-->
				</div>
			</div>
		</section>
	<!--//main-->
	

					<!--footer-->
					<?php include("footer.php");?>
					<!---->
					<!-- js -->
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
					<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
					 <script type="text/javascript">
						 $(function(){
							
							$('#register').click(function(e){

								var valid = this.form.checkValidity();

							if(valid){

								var first_name			=	$('#first_name').val();
								var last_name 			=	$('#last_name').val();
								var email 				=	$('#email').val();
								var address				=	$('#address').val();
								var phone_number		=	$('#phone_number').val();
								var skill	 			=	$('#skill').val();


								e.preventDefault();

									$.ajax({
										type: 'POST',
										url: 'process-skill.php',
										data: {first_name: first_name,last_name: last_name,email: email,address: address,phone_number: phone_number,skill: skill,},
										success: function(data){
											Swal.fire({
														'title': 'Successfull',
														'text': data,
														'type': 'success'

													})
										},
										error: function(data){
											Swal.fire({
														'title': 'Errors',
														'text': 'There were errors while saving the data',
														'type': 'error'

													})
										}
									});								

							}else{
									
								
								}

						});

					});
					
					
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