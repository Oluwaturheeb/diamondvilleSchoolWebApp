<!-- Footer Start -->
<div class="container-fluid pt-4 px-4">
				<div class="bg-light rounded-top p-4">
					<div class="row">
						<div class="col-12 col-sm-6 text-center text-sm-start">
							&copy; <a href="#">Your Site Name</a>, All Right Reserved.
						</div>
						<div class="col-12 col-sm-6 text-center text-sm-end">
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a href="https://htmlcodex.com">HTML Codex</a>
							</br>
							Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Footer End -->
		</div>
		<!-- Content End -->


		<!-- Back to Top -->
		<a href="#" class="btn btn-lg btn-success btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>
	</div>

	<!-- JavaScript Libraries -->
	<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> -->
	<script src="/assets/vendor/jquery/jquery.min.js"></script>
	<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
	<script src="/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
	<script src="/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
	<script src="/assets/vendor/tempusdominus/js/moment.min.js"></script>
	<script src="/assets/vendor/tempusdominus/js/moment-timezone.min.js"></script>
	<script src="/assets/vendor/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
	<script src="/assets/js/Validate.js"></script>

	<!-- Template Javascript -->
	<script src="/assets/js/admin.main.js"></script>
	<script>
		$('form').submit(function(e) {
			v.autoForm(this, '#info');
			if (v.err()) e.preventDefault();
			if (!v.err() && !$(this).hasClass('no-ajax')) {
			  e.preventDefault();
			  v.ajax('#info');
			}
		});
	</script>
