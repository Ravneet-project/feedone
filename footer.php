
	<!-- footer-66 -->
	<footer class="w3l-footer-66">
		<section class="footer-inner-main">
			<div class="footer-hny-grids py-5">
				<div class="container py-lg-4">
					<div class="text-txt">
						<div class="right-side">
							<div class="row sub-columns">
								<div class="col-lg-4 col-md-6 sub-one-left pr-lg-4">
									<h2><a class="navbar-brand" href="index.php">
											<span class="fa fa-heart"></span> <span class="sub-logo">Feed</span>One
										</a></h2>
									<p class="pr-lg-4">Providing services To Man Kind Through The Help Of Kind Donaters Who provide Food To Needy ,That Food Is Taken By NGO's And Given To Needy. </p>
									<div class="columns-2">
										<ul class="social">
											<li><a href="#facebook"><span class="fa fa-facebook"
														aria-hidden="true"></span></a>
											</li>
											<li><a href="#linkedin"><span class="fa fa-linkedin"
														aria-hidden="true"></span></a>
											</li>
											<li><a href="#twitter"><span class="fa fa-twitter"
														aria-hidden="true"></span></a>
											</li>
											<li><a href="#google"><span class="fa fa-google-plus"
														aria-hidden="true"></span></a>
											</li>
											<li><a href="#github"><span class="fa fa-github"
														aria-hidden="true"></span></a>
											</li>
										</ul>
									</div>
								</div>
								<div class="col-lg-4 col-md-6 sub-one-left">
									<h6>Our Services</h6>
									<div class="mid-footer-gd sub-two-right">

										<ul>
											<li><a href="#"><span class="fa fa-angle-double-right mr-2"></span>Water
													Surve</a>
											</li>
											<li><a href="#"><span class="fa fa-angle-double-right mr-2"></span>Education
													for
													all</a>
											</li>
											<li><a href="#"><span class="fa fa-angle-double-right mr-2"></span>Food
													Serving</a>
											</li>
											<li><a href="#"><span class="fa fa-angle-double-right mr-2"></span>Animal
													Saves</a>
											</li>
										</ul>
										<ul>
											<li><a href="#"><span
														class="fa fa-angle-double-right mr-2"></span>Sponsors</a>
											</li>
											<li><a href="#"><span class="fa fa-angle-double-right mr-2"></span>Help
													Orphan</a>
											</li>
											<li><a href="#support"><span
														class="fa fa-angle-double-right mr-2"></span>Case
													Studies</a></li>
											<li><a href="#terms"><span class="fa fa-angle-double-right mr-2"></span>Our
													Organization</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="col-lg-4 col-md-6 sub-one-left">
									<h6>Happy Faces</h6>
									<div class="instagram-feeds">
										<div class="b-img"> <a href="#url"><img src="assets/images/f1.jpg"
													class="img-fluid" alt=""></a></div>
										<div class="b-img"> <a href="#url"><img src="assets/images/f2.jpg"
													class="img-fluid" alt=""></a></div>
										<div class="b-img"> <a href="#url"><img src="assets/images/f3.jpg"
													class="img-fluid" alt=""></a></div>
										<div class="b-img"> <a href="#url"><img src="assets/images/f4.jpg"
													class="img-fluid" alt=""></a></div>
										<div class="b-img"> <a href="#url"><img src="assets/images/f5.jpg"
													class="img-fluid" alt=""></a></div>
										<div class="b-img"> <a href="#url"><img src="assets/images/f6.jpg"
													class="img-fluid" alt=""></a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="below-section">
				<div class="container">
					<div class="copyright-footer">
						<div class="columns text-lg-left">
							<p>© 2024 FeedOne. All rights reserved | Designed by <a
									href="https://o7services.com"> Rohit Sabharwal</a></p>
						</div>
						<ul class="columns text-lg-right">
							<li><a href="#">Privacy Policy</a>
							</li>
							<li>|</li>
							<li><a href="#">Terms Of Use</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- copyright -->
			<!-- move top -->
			<button onclick="topFunction()" id="movetop" title="Go to top">
				<span class="fa fa-long-arrow-up" aria-hidden="true"></span>
			</button>
			<script>
				// When the user scrolls down 20px from the top of the document, show the button
				window.onscroll = function () {
					scrollFunction()
				};

				function scrollFunction() {
					if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
						document.getElementById("movetop").style.display = "block";
					} else {
						document.getElementById("movetop").style.display = "none";
					}
				}

				// When the user clicks on the button, scroll to the top of the document
				function topFunction() {
					document.body.scrollTop = 0;
					document.documentElement.scrollTop = 0;
				}
			</script>
			<!-- /move top -->

		</section>
	</footer>
	<!--//footer-66 -->
</body>

			</html>

<script src="assets/js/jquery-3.3.1.min.js"></script>

<!-- disable body scroll which navbar is in active -->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script>
	$(document).ready(function () {
		$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',

			fixedContentPos: false,
			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,
			preloader: false,

			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});

		$('.popup-with-move-anim').magnificPopup({
			type: 'inline',

			fixedContentPos: false,
			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,
			preloader: false,

			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-slide-bottom'
		});
	});
</script>
<!--//-->
<!-- stats -->
<script src="assets/js/jquery.waypoints.min.js"></script>
<script src="assets/js/jquery.countup.js"></script>
<script>
	$('.counter').countUp();
</script>
<!-- //stats -->
<script src="assets/js/owl.carousel.js"></script>
<!-- script for banner slider-->
<script>
	$(document).ready(function () {
		$('.owl-one').owlCarousel({
			loop: true,
			margin: 0,
			nav: false,
			responsiveClass: true,
			autoplay: false,
			autoplayTimeout: 5000,
			autoplaySpeed: 1000,
			autoplayHoverPause: false,
			responsive: {
				0: {
					items: 1,
					nav: false
				},
				480: {
					items: 1,
					nav: false
				},
				667: {
					items: 1,
					nav: true
				},
				1000: {
					items: 1,
					nav: true
				}
			}
		})
	})
</script>
<!-- //script -->
<!-- script for owlcarousel -->
<script>
	$(document).ready(function () {
		$('.owl-testimonial').owlCarousel({
			loop: true,
			margin: 0,
			nav: false,
			responsiveClass: true,
			autoplay: false,
			autoplayTimeout: 5000,
			autoplaySpeed: 1000,
			autoplayHoverPause: false,
			responsive: {
				0: {
					items: 1,
					nav: false
				},
				480: {
					items: 1,
					nav: false
				},
				667: {
					items: 1,
					nav: false
				},
				1000: {
					items: 1,
					nav: false
				}
			}
		})
	})
</script>
<!-- disable body scroll which navbar is in active -->
<script>
  // ✅ Offcanvas sidebar open/close + overlay + dropdown safe
  $(function () {
    var $toggler = $(".navbar-toggler");
    var $overlay = $("#navOverlay");
    var $menu    = $("#navbarTogglerDemo02");

    // open/close sidebar
    $toggler.on("click", function () {
      $("body").toggleClass("nav-open");
    });

    // overlay click => close
    $overlay.on("click", function () {
      $("body").removeClass("nav-open");
      $menu.removeClass("show");
      $("header").removeClass("active");
    });

    // ✅ Close sidebar ONLY on normal links (NOT dropdown toggle)
    $menu.on("click", "a.nav-link", function (e) {

      // if clicked link is dropdown toggle, let bootstrap open dropdown
      if ($(this).hasClass("dropdown-toggle") || $(this).attr("data-toggle") === "dropdown") {
        e.preventDefault(); // keep it on same page
        return;
      }

      // if clicking inside dropdown-menu links, close sidebar after click
      if ($(window).width() <= 991) {
        $("body").removeClass("nav-open");
        $menu.removeClass("show");
        $("header").removeClass("active");
      }
    });
  });
</script>

<!-- disable body scroll which navbar is in active -->

<!--/MENU-JS-->
<script>
  $(window).on("scroll", function () {
    var scroll = $(window).scrollTop();

    if (scroll >= 80) {
      $("#site-header").addClass("nav-fixed");
    } else {
      $("#site-header").removeClass("nav-fixed");
    }
  });

  //Main navigation Active Class Add Remove
  $(".navbar-toggler").on("click", function () {
    $("header").toggleClass("active");
  });
  $(document).on("ready", function () {
    if ($(window).width() > 991) {
      $("header").removeClass("active");
    }
    $(window).on("resize", function () {
      if ($(window).width() > 991) {
        $("header").removeClass("active");
      }
    });
  });
</script>
<!--//MENU-JS-->

<script src="assets/js/bootstrap.min.js"></script>