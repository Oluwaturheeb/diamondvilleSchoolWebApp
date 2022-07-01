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
              <h2 class="text-primary mb-0"><i class="fa fa-home"></i></h2>
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

          <!-- Students -->
          <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4">
              <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Students</h6>
              </div>
              <div class="table-responsive">
                <form class="mb-4 validate-ignore no-ajax" method="get" accept-charset="utf-8">
                  <div class="input-group">
                    <select name="class" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                      <option>Jss 1</option>
                      <option>Jss 2</option>
                      <option>Jss 3</option>
                      <option>Sss 1</option>
                      <option>Sss 2</option>
                      <option>Sss 3</option>
                    </select>
                    <select name="dept" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                      <option>Junior</option>
                      <option>Art</option>
                      <option>Commercial</option>
                      <option>Science</option>
                    </select>
                    <button class="btn btn-outline-success">Button</button>
                  </div>
                </form>
                <* if (isset($students)): *>
								<form method="post" action="/admin/student/action">
                  <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                      <tr class="text-dark">
                        <th scope="col"><input class="form-check-input validate-ignore" type="checkbox" id="check-all"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Age</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
											<* foreach ($students as $student): *>
											<tr>
												<td><input class="form-check-input validate-ignore" type="checkbox" name="student[]" value="<* echo $student->id *>"></td>
												<td colspan="1">
													<div class="d-flex align-items-center py-3">
														<img class="rounded-circle flex-shrink-0" src="<* echo $student->picture *>" alt="" style="width: 40px; height: 40px;">
														<div class="w-100 ms-3">
															<div class="d-flex w-100 justify-content-between">
																<h6 class="mb-0">
																	<a href="/student/<* echo $student->id *>" class="<* if (!$student->active) echo 'text-danger' *>"><* echo ucwords($student->fullname) *></a>
																</h6>
															</div>
															<small>
																<* echo $student->class . '(' . $student->dept .')' *>
															</small>
															</div>
													</div>
												</td>
												<td colspan="1"><* echo $student->gender *></td>
												<td colspan="1"><* echo $student->age *></td>
												<td>
													<a class="student-id" data-value="<* echo $student->a_id . '//'. $student->class *>" href="" data-toggle="modal" data-target="#result-modal">
														<i class="fa fa-file-signature fa-file me-2"></i>
													</a>
													<!-- <a class="student-id" data-value="<* echo $student->a_id . '//'. $student->class *>" href="" data-bs-toggle="modal" data-bs-target="#result-modal">
														<i class="fa fa-trash-alt"></i>
													</a> -->
											</td>
											</tr>
											<* endforeach; *>
										</tbody>
									</table>
									<* if (auth()->type == 1): *>
									<div class=" form-floating form-group my-3">
										<select name="action" class="form-select" id="action" aria-label="Example select with button addon">
											<option value="">Select Action</option>
											<option>Promote</option>
											<option>Suspend</option>
											<option>Unsuspend</option>
										</select>
										<label for="action">Select Action</label>
									</div>
									<div class="form-floating form-group my-3">
										<select name="class" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
											<option value="">Select class</option>
											<option>Jss 1</option>
											<option>Jss 2</option>
											<option>Jss 3</option>
											<option>Sss 1</option>
											<option>Sss 2</option>
											<option>Sss 3</option>
										</select>
										<label for="class">To class</label>
									</div>
									<div class="form-floating form-group my-3 dept">
										<select name="dept" class="form-select" id="dept" aria-label="Example select with button addon">
                      <option>Junior</option>
                      <option>Art</option>
                      <option>Commercial</option>
                      <option>Science</option>
                    </select>
										<label for="class">To class</label>
									</div>
									<div class="form-group" style="text-align: left">
										<div id="info" class="my-3"></div>
										<button class="btn btn-success my-btn btn-lg">Submit</button>
									</div>
									<* csrf() *>
									<* endif *>
								</form>
							<* endif *>
							</div>
						</div>
					</div>
          <!-- Sale & Revenue End -->
          <* if (auth()->type == 2): *>
          <!-- Result modal -->
          <div class="modal fade" id="result-modal" data-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Student Report</h5>
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="report" class="mb-4" action="/teacher/student/result" method="post">
                  <div class="modal-body">
                      <* $option = ''; foreach(explode(',', $auth->subject) as $subject): *>
                        <* $option .= "<option>$subject</option>"; *>
                      <* endforeach; *>
                      <div class="input-group mb-4">
                        <select name="subject[]" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                          <* echo $option *>
                        </select>
                        <select name="session[]" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                          <option>First Term</option>
                          <option>Second Term</option>
                          <option>Third Term</option>
                        </select>
                        <input name="score[]" class="form-control" placeholder="Score..." type="number" max="100">
                        <input name="total[]" class="form-control" placeholder="Total..." type="number" max="100">
                      </div>
                      <input type="hidden" name="student_id" value="">
                      <input type="hidden" name="class" value="">
                      <* csrf() *>
                  </div>
                  <div class="modal-footer">
                    <div id="info"></div>
                    <div>
                      <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                      <button type="button" class="btn btn-success addField"><i class="fa fa-file-medical" style="color: #fff !important;"></i></button>
                      <button class="btn btn-success">Submit Report</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Result modal end -->
          <* endif *>
					<* includeView('admin/footer'); *>
					<script>
						<* if (auth()->type == 2): *>
						$('a.student-id').click(function (e) {
							e.preventDefault();
							var id = $(this).attr('data-value').split('//');
							$('input[name=student_id]').val(id[0]);
							$('input[name=class]').val(id[1]);
						});
						$('.addField').click(function() {
							$('.modal-body').append(`
							<div class="input-group mb-4">
								<select name="subject[]" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
									<* echo $option *>
								</select>
								<select name="session[]" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
									<option>First Term</option>
									<option>Second Term</option>
									<option>Third Term</option>
								</select>
								<input name="score[]" class="form-control" placeholder="Score..." type="number" max="100">
								<input name="total[]" class="form-control" placeholder="Total..." type="number" max="100">
							</div>
							`);
						});
						<* endif; *>
/*
						$('form').submit(function(e) {
							if (!$(this).hasClass('validate-ignore')) e.preventDefault();
							v.autoForm(this);
							if (!v.err()) v.ajax($('#info'));
						});*/
					</script>

  </body>
</html>
