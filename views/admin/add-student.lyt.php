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
              <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
									<div class="bg-light rounded h-100 ">
										<div class="d-flex justify-content-center">
											<div class="img my-5">
												<i class="fa fa-user"></i>
												<span>
													<i class="fa fa-camera"></i>
													<input type="file" id="imageFile" capture="environment" accept="image/*" data-type="student">
												</span>
											</div>
										</div>
										<form action="/student/add-student/post" method="post" id="addTeacher" class="p-4">
											<h6 class="mb-4">Add Student</h6>
											<div class="form-floating mb-3">
												<input type="text" name="fullname" class="form-control" id="fullname" placeholder="Enter fullname...">
												<label for="fullname">Fullname</label>
											</div>
											<div class="form-floating mb-3">
												<input name="dob" type="date" class="form-control" id="dob">
												<label for="floatingInput">Date of Birth</label>
											</div>
											<div class="form-floating mb-3">
												<textarea name="hadd" class="form-control" placeholder="Enter address..."
													id="hadd" style="height: 150px;"></textarea>
												<label for="hadd">Address</label>
											</div>
											<div class="form-floating mb-3">
												<select name="gender" class="form-select" id="class"
													aria-label="Floating label select example">
													<option value=''>Gender</option>
													<option>Female</option>
													<option>Male</option>
												</select>
												<label for="class">Gender</label>
											</div>
											<div class="form-floating mb-3">
												<select name="class" class="form-select" id="class"
													aria-label="Floating label select example">
													<option value=''>Select class</option>
													<option>Jss 1</option>
													<option>Jss 2</option>
													<option>Jss 3</option>
													<option>Sss 1</option>
													<option>Sss 2</option>
													<option>Sss 3</option>
												</select>
												<label for="class">Select class</label>
											</div>
											<div class="form-floating mb-3">
												<select name="dept" class="form-select" id="dept"
													aria-label="Floating label select example">
													<option>Junior</option>
													<option>Art</option>
													<option>Commercial</option>
													<option>Science</option>
												</select>
												<label for="dept">Select Department</label>
											</div>
											<h6 class="mb-4">Parent's section</h6>
											<div class="form-floating mb-3">
												<select name="pre" class="form-select" id="pre"
													aria-label="Floating label select example">
													<option value="" selected>Title</option>
													<option>Miss</option>
													<option>Mr</option>
													<option>Mrs</option>
												</select>
												<label for="pre">Title</label>
											</div>
											<div class="form-floating mb-3">
												<input type="text" name="p_name" class="form-control" id="p_name" placeholder="Enter parent's name...">
												<label for="p_name">Parent's Name</label>
											</div>
											<div class="form-floating mb-3">
												<input name="email" type="email" class="form-control" id="email" placeholder="Enter email address...">
												<label for="email">Email</label>
											</div>
											<div class="form-floating mb-3">
												<input name="phone" type="tel" class="form-control" id="phone" placeholder="Enter Phone number...">
												<label for="phone">Phone Number</label>
											</div>
											<div class="form-group">
												<div id="info" class="my-3"></div>
												<button class="btn btn-success" type="submit">Submit</button>
											</div>
											<* csrf() *>
										</form>
									</div>
                </div>
              </div>
            </div>
            <!-- Sale & Revenue End -->

            <* includeView('admin/footer') *>
            </body>
          </html>
