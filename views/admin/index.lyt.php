<!DOCTYPE html>
<html lang="en">

<head>
	<* includeView('admin/header') *>
</head>

<body>
	<div class="container-xxl position-relative bg-white d-flex p-0">
		<!-- Spinner Start -->
		<!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
		<!-- Spinner End -->


		<!-- Sidebar Start -->
		<* includeView('admin/sidebar') *>
		<!-- Sidebar End -->


		<!-- Content Start -->
		<div class="content">
			<!-- Navbar Start -->
			<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
				<a href="/" class="navbar-brand d-flex d-lg-none me-4">
					<h2 class="text-success mb-0"><i class="fa fa-home"></i></h2>
				</a>
				<a href="#" class="sidebar-toggler flex-shrink-0">
					<i class="fa fa-bars"></i>
				</a>
				<form class="d-none d-md-flex ms-4">
					<input class="form-control border-0" type="search" placeholder="Search">
				</form>
				<div class="navbar-nav align-items-center ms-auto">
					<div class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
							<img class="rounded-circle me-lg-2" src="<* echo $auth->picture *>" alt="" style="width: 40px; height: 40px;">
							<span class="d-none d-lg-inline-flex">
								<* echo ucwords($auth->pre. '. '. $auth->fullname) *>
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
							<a href="/admin-dashboard#" class="dropdown-item">My Profile</a>
							<a href="/logout" class="dropdown-item">Log Out</a>
						</div>
					</div>
				</div>
			</nav>
			<!-- Navbar End -->


			<!-- Sale & Revenue Start -->
			<div class="container-fluid pt-4 px-4">
				<div class="row g-4">
					<div class="col-sm-6 col-xl-3">
						<div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
							<i class="fa fa-chalkboard-teacher fa-3x text-success"></i>
							<div class="ms-3">
								<p class="mb-2">All Teacher</p>
								<h6 class="mb-0">
									<* echo $tcount *>
								</h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-xl-3">
						<div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
							<i class="fa fa-user-graduate fa-3x text-success"></i>
							<div class="ms-3">
								<p class="mb-2">Total Students</p>
								<h6 class="mb-0">
									<* echo $scount*>
								</h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-xl-3">
						<div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
							<i class="fa fa-chart-line fa-3x text-success"></i>
							<div class="ms-3">
								<p class="mb-2">Today Sale</p>
								<h6 class="mb-0">$1234</h6>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-xl-3">
						<div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
							<i class="fa fa-chart-pie fa-3x text-success"></i>
							<div class="ms-3">
								<p class="mb-2">Total Revenue</p>
								<h6 class="mb-0">$1234</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Sale & Revenue End -->

			<!-- Teachers -->
			<div class="container-fluid pt-4 px-4">
				<div class="bg-light text-center rounded p-4">
					<div class="d-flex align-items-center justify-content-between mb-4">
						<h6 class="mb-0">Teachers</h6>
						<!-- <a href="">Show All</a> -->
					</div>
					<div class="table-responsive">
						<table class="table text-start align-middle table-bordered table-hover mb-0">
							<thead>
								<tr class="text-dark">
									<th scope="col"><input class="form-check-input" type="checkbox"></th>
									<th scope="col">Name</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<* foreach ($teachers as $teacher): *>
									<tr>
										<td><input class="form-check-input" type="checkbox" name="teacher-action" value="<* $teacher->id *>"></td>
										<td colspan="1">
											<div class="d-flex align-items-center py-3">
												<img class="rounded-circle flex-shrink-0" src="<* echo $teacher->picture *>" alt="" style="width: 40px; height: 40px;">
												<div class="w-100 ms-3">
													<div class="d-flex w-100 justify-content-between">
														<h6 class="mb-0">
															<* echo ucwords($teacher->pre. '. '. $teacher->fullname) *>
														</h6>
													</div>
													<small>
														<* echo $teacher->class *>
													</small>
												</div>
											</div>
										</td>
										<td><a class="btn btn-sm btn-success" href="">Action</a></td>
									</tr>
									<* endforeach; *>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Recent Sales End -->


			<!-- Widgets Start -->
			<div class="container-fluid pt-4 px-4">
				<div class="row g-3">
					<div class="col-sm-12 col-md-6">
						<div class="h-100 bg-light rounded p-4">
							<div class="d-flex align-items-center justify-content-between mb-4">
								<h6 class="mb-0">Calender</h6>
								<a href="">Show All</a>
							</div>
							<div id="calender"></div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="h-100 bg-light rounded p-4">
							<div class="d-flex align-items-center justify-content-between mb-4">
								<h6 class="mb-0">Active Events</h6>
							</div>
							<div class="my-3">
								<h6>Set Session</h6>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="session" id="inlineRadio1" value="First Term">
									<label class="form-check-label" for="inlineRadio1">First Term</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="session" id="inlineRadio2" value="Second Term">
									<label class="form-check-label" for="inlineRadio2">Second Term</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="session" id="inlineRadio3" value="Third Term">
									<label class="form-check-label" for="inlineRadio3">Third Term</label>
								</div>
							</div>
							<* foreach($events as $e): *>
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<i class="fa fa-exclamation-circle me-2"></i>
									<span><* echo $e->content *></span>
										<* if ($e->type != 'Session'): *>
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" data-id="<* echo $e->id *>"></button>
											<* endif; *>
								</div>
								<* endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<!-- Widgets End -->
			<* includeView('admin/footer') *>
			<script>
			  $('input[name=session]').change(function () {
			    var ses = $(this).val();
			    var check = confirm(`You are setting the session to ${ses}.\nDo you want to continue?`);

			    if (check) $.ajax({
			      url: '/admin/session',
			      data: {session: ses},
			      success: e => {
			        alert(e.msg)
			        if (e.code) $('.alert:first span').text(ses);
			      },
			      error: e => alert(JSON.stringify(e))
			    })
			  })
			</script>
</body>

</html>
