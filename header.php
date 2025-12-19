<?php
session_start();
?>
<!doctype html>
<html lang="zxx">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>FeedOne
		</title>
		<!-- Template CSS -->
		<link rel="stylesheet" href="assets/css/style-starter.css">
		<!-- Template CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<link href="//fonts.googleapis.com/css?family=Poppins:300,400,400i,500,600,700&display=swap" rel="stylesheet">
		<!-- Template CSS -->
	</head>

<body>

	<!--w3l-header-->
<header id="site-header" class="fixed-top">
    <div class="container">
		<nav class="navbar navbar-expand-lg navbar-dark stroke">
			<h1> <a class="navbar-brand" href="index.php">
					<span class="fa fa-heart"></span> <span class="sub-logo">Feed</span>One
				</a></h1>
			<!-- if logo is image enable this   
	<a class="navbar-brand" href="#index.php">
		<img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
	</a> -->
			<button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse"
				data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
				<span class="navbar-toggler-icon fa icon-close fa-times"></span>
				</span>
			</button>

			<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
				<ul class="navbar-nav ml-auto">
					<?php
					if(isset($_SESSION["user_type"])){
						if($_SESSION["user_type"]=="Admin"){
						?>
							<li class="nav-item ">
								<a class="nav-link" href="adminindex.php">Home <span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                    NGO
                                </a>
                                <div class="dropdown-menu px-3">
                                    <a class="nav-link" href="add_ngo.php">Add</a>
                                    <a class="nav-link" href="view_ngo.php">Manage</a>
                                </div>
                            </div>
                        	</li>
							 <li class="nav-item ">
								<a class="nav-link" href="view_food_admin.php">Manage Donation</a>
							</li>
							<li class="nav-item ">
								<a class="nav-link" href="view_user.php">Manage User</a>
							</li>
							<li class="nav-item ">
								<a class="nav-link" href="view_enquiry.php">Manage Enquiry</a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link" href="logout.php">Logout</a>
							</li>
							<?php
						}
						else if($_SESSION["user_type"]=="ngo"){
							?>
							<li class="nav-item @@home__active">
								<a class="nav-link" href="ngoindex.php">Home <span class="sr-only">(current)</span></a>
							</li>
							<!-- <li class="nav-item ">
								<a class="nav-link" href="causes.php">Causes</a>
							</li> -->
						
							<li class="nav-item @@contact__active">
								<a class="nav-link" href="status.php">Status</a>
							</li>
							
							<li class="nav-item @@contact__active">
								<a class="nav-link" href="user_enquiry.php">Add Enquiry</a>
							</li>
							<li class="nav-item @@contact__active">
								<a class="nav-link" href="logout_ngo.php">Logout</a>
							</li>
							<?php
						}
						else{
							?>
							<li class="nav-item @@home__active">
								<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
							</li>
							<!-- <li class="nav-item @@causes__active">
								<a class="nav-link" href="causes.php">Causes</a>
							</li> -->
							<li class="nav-item @@causes__active">
								<a class="nav-link" href="view_ngo_user.php">NGO's</a>
							</li>
							<li class="nav-item @@contact__active">
									<div class="dropdown">
										<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
											Donation
										</a>
										<div class="dropdown-menu px-3">
											<a class="nav-link" href="add_food.php">Add</a>
											<a class="nav-link" href="user_food.php">Manage</a>
										</div>
									</div>
												
								</li>
							</li>
							<li class="nav-item @@contact__active">
								<a class="nav-link" href="user_enquiry.php">Contact</a>
							</li>
							<li class="nav-item @@contact__active">
								<a class="nav-link" href="logout_user.php">Logout</a>
							</li>
          
							<?php
						}
					}else{
						?>
						<li class="nav-item @@home__active">
							<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
						</li>
						<!-- <li class="nav-item @@causes__active">
							<a class="nav-link" href="causes.php">Causes</a>
						</li> -->
						<li class="nav-item @@causes__active">
								<a class="nav-link" href="view_ngo_user.php">NGO's</a>
							</li>
						<li class="nav-item @@contact__active">
							<a class="nav-link" href="user_enquiry.php">Contact</a>
						</li>
						<li class="nav-item @@contact__active">
									<div class="dropdown">
										<a class="nav-link btn btn-primary px-4 dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
											Log In
										</a>
										<div class="dropdown-menu px-5">
											<a class="nav-link" href="adminlogin.php">As Admin</a>
											<a class="nav-link" href="userlogin.php">As User </a>
											<a class="nav-link" href="ngo_login.php">As NGO </a>
										</div>
									</div>
												
								</li>
						<?php
					}
					?>
					

                    <!-- <li class="nav-item ml-lg-4">
						<a class="nav-link donate btn btn-style" href="donate.php">Log In</a>

					</li> -->
				</ul>
			</div>
		</nav>
		  <div class="nav-overlay" id="navOverlay"></div>
    </div>
</header>
<!--/header-->
<div class="inner-banner">
</div>