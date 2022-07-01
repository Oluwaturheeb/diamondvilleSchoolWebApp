<!DOCTYPE html>
<html lang="en">

<head>
  <* includeView('admin/header') *>
  </head>

  <body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
      <!-- Spinner Start -->
      <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div> -->
      <!-- Spinner End -->

      <* includeView('admin/sidebar') *>

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
                    <a href="#" class="dropdown-item">My Profile</a>
                    <a href="/logout" class="dropdown-item">Log Out</a>
                  </div>
                </div>
              </div>
            </nav>
            <!-- Navbar End -->



            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
				<div class="bg-light text-center rounded p-4">
					<div class="d-flex align-items-center justify-content-between mb-4">
						<h6 class="mb-0">Teachers</h6>
					  <a href="/admin/teachers/<* echo $next *>">Show All</a>
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
										<td><input class="form-check-input validate-ignore" type="checkbox" name="teacher-action" value="<* $teacher->id *>"></td>
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
										<td>
											<a class="rm-teacher" href="" data-value="<* echo $teacher->id *>">
												<i class="fa fa-trash-alt"></i>
											</a>
										</td>
									</tr>
									<* endforeach; *>
							</tbody>
						</table>
					</div>
				</div>
			</div>
            <!-- Sale & Revenue End -->

            <* includeView('admin/footer') *>
						<script>
							$('.rm-teacher').click(function (e) {
                                e.preventDefault();

								var check = confirm('You are about to delete this teacher account?')

								if (check) $.ajax({
									url: '/admin/rm-teacher',
									data: {id: $(this).attr('data-value')},
									success: e => {
										alert(e.msg)
										if (e.code) v.redirect()
									}
								})
							})
						</script>
            </body>

          </html>
