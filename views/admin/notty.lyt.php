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
                  <form action="/admin/send-notification" method="post" id="addTeacher" class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Notifications</h6>
                    <div class="form-floating mb-3">
                      <select name="channel" class="form-select" id="class"
                        aria-label="Floating label select example">
                        <option value="1">Both Channels</option>
                        <option value="2">Email Channel</option>
                        <option value="3">SMS Channel</option>
                      </select>
                      <label for="class">Select Channel</label>
                    </div>
                    <div class="form-floating mb-3">
                      <select name="class" class="form-select" id="class"
                        aria-label="Floating label select example">
                        <option value=''>Select Receivers</option>
                        <option>Jss 1</option>
                        <option>Jss 2</option>
                        <option>Jss 3</option>
                        <option>Sss 1</option>
                        <option>Sss 2</option>
                        <option>Sss 3</option>
                        <option>Students</option>
                        <option>Teachers</option>
                        <option>All</option>
                      </select>
                      <label for="class">Receivers</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Enter notification subject..." name="subject">
                        <label for="floatingInput">Notification subject</label>
                    </div>
                    <div class="form-floating mb-3">
                      <textarea name="notty" class="form-control" placeholder="Enter address..."
                        id="hadd" style="height: 150px;"></textarea>
                      <label for="hadd">Message</label>
                    </div>
                    <div class="form-group">
											<div id="info"></div>
                      <button class="btn btn-success" type="submit">Send Notification</button>
                    </div>
                    <* csrf() *>
                  </form>
                </div>
              </div>
            </div>
            <!-- Sale & Revenue End -->

            <* includeView('admin/footer') *>
            </body>

          </html>
