<?php

if (req()) {
    $a = new Authentication('ad_user');
    $log = $a->lpass('inc/email/mail.php');

    if ($log['code']) res($log);
    else res($log);
}

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
                <div class="col-sm-6 col-md-4 col-lg-3 mx-auto">
                    <h1>Email your email address</h1>
                    <form class="form-group" method="post" id="Tlogin">
                        <div class="form-group">
                            <label for="euser">Email</label>
                            <input type="text" name="username" placeholder="Enter email or username" class="form-control" id="euser">
                        </div>
                        <div class="form-group">
                            <div class="info"></div>
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <script src="assets/js/jquery.js" async defer></script>
        <script src="assets/js/Validate.js" async defer></script>
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
                            consolog.log(e);
                        }
                    })
                }
            });
        </script>
    </body>
</html>