<?php
if (req()) {
    $a = new Auth('auth');
    $log = $a->login('email', 'password', true);

    if ($log['code']) {
        (auth('type') > 2) ? $r = 'student' : $r = 'admin';
        $log['redirect'] = $r;
        res($log);
    } else res($log);
}

callfile ('inc/indexHeader.php');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tlyt Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-10 col-sm-6 col-md-4 mx-auto login-form">
                    <h1>Login</h1>
                    <p style="color: var(--header);">Enter you login credentials to login</p>
                    <form class="form-group" method="post" id="Tlogin">
                        <!-- <div class="form-group">
                            <label for="euser">Email or Username</label>
                            <input type="text" name="username" placeholder="Enter email or username" class="form-control" id="euser">
                        </div> -->
                        <div class="form-group">
                            <label for="euser">Email</label>
                            <div class="input-group">
                                <span>
                                    <i class="icofont-envelope"></i>
                                </span>
                                <input type="email" name="email" placeholder="Enter email address" class="form-control" id="euser">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <span>
                                    <i class="icofont-lock"></i>
                                </span>
                                <input type="password" name="password" placeholder="Password" class="form-control" id="password">
                            </div>
                        </div>
                        <?php csrf() ?>
                        <div class="form-group">
                            <div class="info"></div>
                            <button class="btn btn-success">Login</button>
                        </div>
                    </form>
                    <hr class="w-100" style="border-color: var(--pry)"/>
                    <div class="d-flex justify-content-center">
                        <a href="/forgot"><small>Forgot Password</small></a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- <script src="assets/js/app.js"></script> -->
        <script>
            $('form#Tlogin').submit(function (e) {
                e.preventDefault();

                v.autoForm(this);
                var info = $(this).find('.info');
                if (v.err()) info.html(v.err())
                else {
                    $.ajax({
                        type: 'post', 
                        dataType: 'json',
                        data: v.auto,
                        beforeSend: () => {
                            info.html('Please wait');
                        },
                        success: e => {
                            info.text(e.msg);
                            if (e.code) v.redirect(e.redirect);
                        }
                    });
                }
            });
        </script>
    </body>
</html>