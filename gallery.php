<?php require("libs/fetch_data.php");?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title><?php getwebname("titles"); echo"|"; gettagline("titles");?>| Gallery</title>
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
		<li class="breadcrumb-item active">Gallery</li>
	</ol>
	<!--//banner-->
	<!--/main-->

	<section class="bottom-slider">

			<div class="container">
				<h3 class="tittle">Gallery</h3>
			</div>

				<div class="course_demo1">
					<h4>Picture</h4>
						<ul id="flexiselDemo1">
							<?php getgalleryposts("gallery");?>
						</ul>

					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="embed-responsive embed-responsive-21by9">
										<iframe allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" frameborder="0" height="315" src="https://www.youtube-nocookie.com/embed/oeLZnpJ_nv8" width="560"></iframe>
									</div>
								</div>
												
							</div>
						</div>
					</div>
				</div>
	</section>
					
	<!-- <!-- <section class="bottom-slider">

					<div class="course_demo1">
					<h4>Vedeos</h4>
						<ul id="flexiselDemo1">
							<?php getbottomsliderposts("gallery");?>
						</ul>
					</div>
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="embed-responsive embed-responsive-21by9">
										<iframe allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" frameborder="0" height="315" src="https://www.youtube-nocookie.com/embed/oeLZnpJ_nv8" width="560"></iframe>
									</div>
								</div>
												
							</div>
						</div>
					</div>
	</section> -->
		
					<!--//main-->

					<!--footer-->
					<?php include("footer.php");?>
					<!---->
					<!-- js -->
					<script src="js/jquery-2.2.3.min.js"></script>
					<!-- //js -->
					<!-- desoslide-JavaScript -->
					<script src="js/jquery.desoslide.js"></script>
					<script>
						$('#demo1_thumbs').desoSlide({
							main: {
								container: '#demo1_main_image',
								cssClass: 'img-responsive'
							},
							effect: 'sideFade',
							caption: true
						});
					</script>

					<!-- requried-jsfiles-for owl -->
					<script>
						$(window).load(function () {
							$("#flexiselDemo1").flexisel({
								visibleItems: 3,
								animationSpeed: 1000,
								autoPlay: true,
								autoPlaySpeed: 3000,
								pauseOnHover: true,
								enableResponsiveBreakpoints: true,
								responsiveBreakpoints: {
									portrait: {
										changePoint: 480,
										visibleItems: 1
									},
									landscape: {
										changePoint: 640,
										visibleItems: 2
									},
									tablet: {
										changePoint: 768,
										visibleItems: 3
									}
								}
							});

						});
					</script>
					<script>
						$(window).load(function () {
							$("#flexiselDemo2").flexisel({
								visibleItems: 3,
								animationSpeed: 1000,
								autoPlay: true,
								autoPlaySpeed: 3000,
								pauseOnHover: true,
								enableResponsiveBreakpoints: true,
								responsiveBreakpoints: {
									portrait: {
										changePoint: 480,
										visibleItems: 1
									},
									landscape: {
										changePoint: 640,
										visibleItems: 2
									},
									tablet: {
										changePoint: 768,
										visibleItems: 3
									}
								}
							});

						});
					</script>
					<script src="js/jquery.flexisel.js"></script>
					<!-- //password-script -->
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
							
							var defaults = {
							  			containerID: 'toTop', // fading element id
										containerHoverID: 'toTopHover', // fading element hover id
										scrollSpeed: 1200,
										easingType: 'linear' 
									};
									

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