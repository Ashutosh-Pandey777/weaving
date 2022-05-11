<?php require("libs/fetch_data.php");?> 
<?php require('blogadmin/configs.php');?>
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

	<!--/main-->
 





<section class="middle-sec-agileinfo-w3lr">

	<div>
	
		<form action="index.php" method="post">
			<div class="container">
				<div class="row">
					
						<div class="col-lg-6">
							<h1>Sign In Here!</h1>
		
							<hr class="mb-">
							<label for="user_name"><b>User Name</b></label>
							<input class="form-control" id="user_name" type="text" name="user_name" required>

							<label for="password"><b>Password</b></label>
							<input class="form-control" id="password" type="password" name="password" required>

							<input class="form-group" type="checkbox" name="rememberme"> Remember ME

                    	    <p class="text-left">Forgot your password? <a href="forgotp.php">click here</a> </p>

							<hr class="mb-3">
							<input class="btn btn-primary" type="submit" id="Sign In" name="create" value="Sign In">
						</div>
				</div>
			</div>
					
			
    	</form>
	 

	

				
	</div>
</section>
	<!--//main-->
	

					<!---->
					<!-- js -->
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
					<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
					 <script type="text/javascript">
						 $(function(){
							
							$('#Sign In').click(function(e){

								var valid = this.form.checkValidity();

							if(valid){

								var user_name			=	$('#user_name').val();
								var password 			=	$('#password').val();


								e.preventDefault();

									$.ajax({
										type: 'POST',
										url: 'process-Signin.php',
										data: {user_name: first_name,password: password},
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