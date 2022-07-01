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


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-md-6" style="background: url(assets/img/students.jpg);height: 420px;background-size: cover;"></div>

                <div class="col-12 col-sm-8 col-md-5 col-lg-5 col-xl-4">
                  <form id="login" action="/teacher/add-teacher" method="post" accept-charset="utf-8">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="/" class="">
                                <h3 class="text-success"><i class="fa fa-home me-2"></i>DVSchool</h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="Enter your email address...">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Enter your password...">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <* echo csrf() *>
												<div class="form-group my-3">
													<div id="info"></div>
												</div>
                        <button class="btn btn-success py-3 w-100 mb-4">Sign In</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>
    <!-- Template Javascript -->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
		<script src="/assets/js/Validate.js"></script>
    <script>
    
    $('#login').submit(function (e) {
      e.preventDefault();
          v.autoForm(this, '#info');
          if (!v.err())
            $.ajax({
              url: '/teacher/add-teacher',
              type: 'post',
              data: $('#login').serialize(),
              success: res => {
                if (res.code) {
                  v.displayError('#info', 1, res.msg);
                  location = res.redirect;
                } else v.displayError('#info', 2, res.msg);
              },
              error: res => {
                v.displayError('#info', 2, 'There is an account with that email address');
              }
            });
    });
    </script>
</body>

</html>
