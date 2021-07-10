<?php require_once "inc/indexHeader.php"; ?>

<div class="container">
	<div class="row">
		<div class="col-12 mx-auto post-search" style="margin-top: 7rem; background: var(--sec);">
			<div class="text-center py-4">
				<h2>Search for post</h2>
				<form class="form-group col-md-8 mx-auto mt-4">
					<div class="input-group col-lg-12">
						<input type="search" name="keyword" id="keyword" class="form-control" placeholder="Search for post...">
						<div class="input-group-append">
							<button class="btn btn-success">Search</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
		
<div class="container">
	<div class="row">
		<div class="col-12 blog-listing">
			<div class="mx-auto blog-list">
				<div class="bordered">
					<div class="img">
						<img src="assets/img/event/event-1.jpg" alt="blog-cover" class="img-fluid">
					</div>
					<div class="details">
						<div class="h4">education the best money can buy</div>	
					</div>
				</div>
			</div>

			<div class="mx-auto blog-list">
				<div class="bordered">
					<div class="img">
						<img src="assets/img/event/event-1.jpg" alt="blog-cover" class="img-fluid">
					</div>
					<div class="details">
					<div class="h4">end of the year party</div>	
					</div>
				</div>
			</div>

			<div class="mx-auto blog-list">
				<div class="bordered">
					<div class="img">
						<img src="assets/img/event/event-1.jpg" alt="blog-cover" class="img-fluid">
					</div>
					<div class="details">
						<div class="h4">annual inter house sport</div>
					</div>
				</div>
			</div>

			<div class=" mx-auto blog-list">
				<div class="bordered">
					<div class="img">
						<img src="assets/img/event/event-1.jpg" alt="blog-cover" class="img-fluid">
					</div>
					<div class="details">
					<div class="h4">end of the year party</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
require_once 'inc/footer.php';