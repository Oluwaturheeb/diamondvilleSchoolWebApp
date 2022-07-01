<!DOCTYPE html>
<html>

<head>
	<* includeView('main/header') *>
</head>

<body>
	<script>
		var w = new WOW({
			animateClass: 'animate__animated'
		});
		w.init();
	</script>
	<nav class="">
		<div class="logo">
			<div class="dp-menu">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<div class="dp-link">
				<* if ($level = auth('type')): *>
				<* if ($level == 1): *>
				<a href="/admin-dashboard" class="">Dashboard</a>
				<* elseif ($level == 2): *>
				<a href="/teacher-dashboard" class="">Dashboard</a>
				<* elseif ($level == 3): *>
				<a href="/dashboard">Dashboard</a>
				<* endif; *>
				<a href="/logout">Logout</a>
				<* else: *>
				<a href="/login">Login</a>
				<* endif; *>
			</div>
			<a href="/" class="logo">
				DiamondVille
			</a>
		</div>
		<div class="links">
			<a href="/">Home</a>
			<a href="/about">About</a>
			<a href="#contact">Contact</a>
			<a href="/blog">Blog</a>
			<a href="/gallery">Gallery</a>
		</div>
	</nav>
	<div class="bg">
		<h1>DiamondVille</h1>
		<i>Comprehensive School</i>
	</div>

			<!-- ======= Loader Section ======= -->
	<!-- <div class="load">
			<div class="ring green icofont-spin"></div>
			<div class="ring blue icofont-spin"></div>
	</div> -->

	<!-- ======= Hero Section ======= -->
	<section id="hero" class="d-flex align-items-center" style="background-image: url(assets/img/gallery/DiamondVille_715371715_1611869940.png)">
		<div class="container">
			<div class="land-anim text-center">
				<h1 class="animate__animated animate__zoomInDown">DiamondVille</h1>
				<div class="h3 animate__animated animate__bounceInUp">Comprehensive School</div>
				<div class="classes mt-3 animate__animated animate__lightSpeedInLeft">
					<span class="cre">Creche</span>
					<span class="nur">Nursery</span>
					<span class="pri">Primary</span>
					<span class="sec">Secondary</span>
				</div>
				<div class="admission text-center animate__animated animate__rollIn">
					Admission in progress
				</div>
			</div>
		</div>
	</section><!-- End Hero -->

	<div class="container">
		<div class="row">
			<main id="main">
				<!-- ======= About Section ======= -->
				<section id="about" class="about">
					<div class="container">

						<div class="row content">
							<div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
								<h2>DiamondVille Comprehensive School</h2>
								<h3 style="color: var(--header);">Creche, Nursery, Primary and Secondary</h3>
							</div>
							<div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left" data-aos-delay="200">
								<p>
									At DiamondVille Comprehensive School, we offer your child/ward the best of education from the
									nursery level to the secondary level.
									With adequate facilities in serene and secure environment
								</p>
								<ul>
									<li><i class="fa fa-check my-1"></i> Affordable school fees</li>
									<li><i class="fa fa-check my-1"></i> Up to date Western Syllabus</li>
									<li><i class="fa fa-check my-1"></i> Talent Development, etc.</li>
								</ul>
							</div>
						</div>

					</div>
				</section>
				<!-- End About Section -->

				<!-- ======= Counts Section ======= -->
				<section id="counts" class="counts">
					<div class="container">
						<div class="row counters text-center" style="display: flex;justify-content: center;">
							<div class="col-lg-3 col-6 text-center">
								<span data-toggle="counter-up">1,463</span>
								<p>Total Students</p>
							</div>

							<div class="col-lg-3 col-6 text-center">
								<span data-toggle="counter-up">53</span>
								<p>Teachers</p>
							</div>

						</div>

					</div>
				</section>
				<!-- End Counts Section -->

				<!-- ======= Cta Section ======= -->
				<section id="cta" class="cta">
					<div class="container">

						<div class="text-center" data-aos="zoom-in">
							<h3>School Quote</h3>
							<p>Discipline is the bridge between <br><strong>Goals</strong> and <strong>Accomplishment</strong></p>
						</div>

					</div>
				</section>
				<!-- End Cta Section -->

				<!-- ======= Portfolio Section ======= -->
				<section id="about" class="portfolio">
					<div class="container">

						<div class="section-title" data-aos="fade-left">
							<h2>About DiamondVille</h2>
							<p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
								sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
								ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
						</div>

						<div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

							<div class="col-lg-4 col-md-6 portfolio-item filter-app">
								<div class="portfolio-wrap">
									<img loading="lazy" src="assets/img/gallery/DiamondVille_413693481_1611869939.png" alt="DiamondVille Talent Discovery" class="img-fluid" alt="">
									<div class="portfolio-info">
										<h4>Academic Execellence</h4>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-md-6 portfolio-item filter-web">
								<div class="portfolio-wrap">
									<img loading="lazy" src="assets/img/gallery/DiamondVille_62889982_1611869940.png" alt="DiamondVille Academic Execellence" class="img-fluid">
									<div class="portfolio-info">
										<h4>Well Equipped Lab</h4>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-md-6 portfolio-item filter-app">
								<div class="portfolio-wrap">
									<img loading="lazy" src="assets/img/gallery/IMG-20210201-WA0006.jpg" alt="DiamondVille Teachers" class="img-fluid">
									<div class="portfolio-info">
										<h4>Qualified Teachers</h4>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-md-6 portfolio-item filter-card">
								<div class="portfolio-wrap">
									<img loading="lazy" src="assets/img/gallery/DiamondVille_760908272_1611869939.png" alt="Secure & Serene Environment" class="img-fluid">
									<div class="portfolio-info">
										<h4>Serene & Secure Environment</h4>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-md-6 portfolio-item filter-web">
								<div class="portfolio-wrap">
									<img loading="lazy" src="assets/img/gallery/DiamondVille_413693481_1611869939.png" alt="DiamondVille Talent Discovery" class="img-fluid">
									<div class="portfolio-info">
										<h4>Talent Development</h4>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-md-6 portfolio-item filter-web">
								<div class="portfolio-wrap">
									<img loading="lazy" src="assets/img/gallery/DiamondVille_413693481_1611869939.png" alt="DiamondVille Talent Discovery" class="img-fluid">
									<div class="portfolio-info">
										<h4>First Aid & Sick Bay</h4>
									</div>
								</div>
							</div>

						</div>

					</div>
				</section>
				<!-- End Portfolio Section -->

				<!-- ======= Testimonials Section ======= -->
				<!-- <section id="testimonials" class="testimonials section-bg">
					<div class="container">

						<div class="row">
							<div class="col-lg-4">
								<div class="section-title" data-aos="fade-right">
									<h2>Parent Reviews</h2>
									<p>Raving reviews from parents who see DiamondVille as the best choice for children.</p>
								</div>
							</div>
							<div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
								<div class="owl-carousel testimonials-carousel">

									<div class="testimonial-item">
										<p>
											<i class="icofont-quote-left quote-icon-left"></i>
											Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
											rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam,
											risus at semper.
											<i class="icofont-quote-right quote-icon-right"></i>
										</p>
										<img loading="lazy" src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
										<h3>Mrs. Alarape Ogundimu</h3>
									</div>

									<div class="testimonial-item">
										<p>
											<i class="icofont-quote-left quote-icon-left"></i>
											Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid
											cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet
											legam anim culpa.
											<i class="icofont-quote-right quote-icon-right"></i>
										</p>
										<img loading="lazy" src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
										<h3>Mr. John Ohanire</h3>
										<h4>Designer</h4>
									</div>

									<div class="testimonial-item">
										<p>
											<i class="icofont-quote-left quote-icon-left"></i>
											Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem
											veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint
											minim.
											<i class="icofont-quote-right quote-icon-right"></i>
										</p>
										<img loading="lazy" src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
										<h3>Mr. Clement Igwe</h3>
									</div>

								</div>
							</div>
						</div>

					</div>
				</section> -->
				<!-- End Testimonials Section -->

				<!-- ======= Team Section ======= -->
				<section id="team" class="team">
					<div class="container">

						<div class="row">
							<div class="col-lg-4">
								<div class="section-title" data-aos="fade-right">
									<h2>School Management</h2>
									<p>This is our board of management</p>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="row">

									<div class="col-lg-6">
										<div class="member" data-aos="zoom-in" data-aos-delay="100">
											<div class="pic"><img loading="lazy" src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
											</div>
											<div class="member-info">
												<h4>Walter White</h4>
												<span>Propietress</span>
												<div class="social">
													<a href=""><i class="icofont-facebook"></i></a>
													<a href=""><i class="icofont-twitter"></i></a>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-6 mt-4 mt-lg-0">
										<div class="member" data-aos="zoom-in" data-aos-delay="200">
											<div class="pic"><img loading="lazy" src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
											</div>
											<div class="member-info">
												<h4>Sarah Jhonson</h4>
												<span>Head Teacher</span>
												<div class="social">
													<a href=""><i class="icofont-facebook"></i></a>
													<a href=""><i class="icofont-twitter"></i></a>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-6 mt-4">
										<div class="member" data-aos="zoom-in" data-aos-delay="300">
											<div class="pic"><img loading="lazy" src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
											</div>
											<div class="member-info">
												<h4>William Anderson</h4>
												<span>School Secetary</span>
												<div class="social">
													<a href=""><i class="icofont-facebook"></i></a>
													<a href=""><i class="icofont-twitter"></i></a>
												</div>
											</div>
										</div>
									</div>

								</div>

							</div>
						</div>

					</div>
				</section>
				<!-- End Team Section -->

				<!-- ======= Blog Section ======= -->
				<section id="services" class="services section-bg">
					<div class="container">

						<div class="row">
							<div class="col-lg-4">
								<div class="section-title" data-aos="fade-right">
									<h2>Blog</h2>
									<p>Get in depth information about the school with DiamondVille blog page.</p>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="row">
									<div class="col-md-6 d-flex align-items-stretch">
										<div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
											<h4 class="h4"><a href="/blog">diamondVille: education the best money can buy.</a>
											</h4>
											<p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
										</div>
									</div>

									<div class="col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
										<div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
											<h4 class="h4"><a href="/blog">Annual inter house sport</a></h4>
											<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
										</div>
									</div>

									<div class="col-md-6 d-flex align-items-stretch mt-4">
										<div class="icon-box" data-aos="zoom-in" data-aos-delay="400">
											<h4 class="h4"><a href="/blog">diamondVille: end of the year party</a></h4>
											<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
										</div>
									</div>

								</div>
							</div>
						</div>

					</div>
				</section>
				<!-- End Services Section -->

				<!-- ======= Contact Section ======= -->
				<section id="contact" class="contact">
					<div class="container">
						<div class="row">
							<div class="col-lg-4" data-aos="fade-right">
								<div class="section-title">
									<h2>Contact</h2>
									<p>Reach out to us for enquiries and enrollment.</p>
								</div>
							</div>

							<div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1378.5093125694257!2d3.4181772760992355!3d6.816185834758624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103bbf19adedb54f%3A0x216acb28a4a65258!2sDiamondville%20Comprehensive%20Schools!5e1!3m2!1sen!2sng!4v1655800788786!5m2!1sen!2sng" width="100%" height="450" style="border:0;" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
								<div class="info mt-4">
									<i class="fa fa-map-marker-alt"></i>
									<h4>Location:</h4>
									<p>
										No 1, Off Ifedayo Str., Igbobi Estate, Mowe, Ogun State.<br>
										No 9 - 11, God's Grace Avenue Off Ogunrun Road, Mowe, Ogun State.
									</p>
								</div>
								<div class="row">
									<div class="col-lg-6 mt-4">
										<div class="info">
											<i class="fa fa-envelope"></i>
											<h4>Email:</h4>
											<p>
												<a href="mailto:support@diamondville.com.ng">support@diamondville.com.ng</a>
											</p>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="info w-100 mt-4">
											<i class="fa fa-phone fa-rotate-90"></i>
											<h4>Call:</h4>
											<p>
												<a href="tel:2348138367199">+234 813 8367 199</a><br>
												<a href="tel:2348036861177">+234 803 6861 177</a>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</section>
				<!-- End Contact Section -->

			</main>
			<!-- End #main -->
		</div>
	</div>
	<* includeView('main/footer') *>
</body>

</html>
