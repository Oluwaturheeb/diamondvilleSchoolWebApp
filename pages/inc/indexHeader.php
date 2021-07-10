<?php callfile ('const'); ?>
<!DOCTYPE html>
<html>

<head>
    <base href="/">
    <meta lang="<?php echo config('project/lang') ?>">
    <meta charset="utf-8">
	<meta name="description" content="">
	<meta name="keyword" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scaleable=no">
    <title>Welcome to DiamondVille Comprehensive School</title>

    <!-- Vendor CSS Files -->
    <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="assets/boot/bootstrap.css">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css?time=<?php echo time() ?>" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo CSS, 'animate.min.css'?>">
	<link rel="stylesheet" href="<?php echo CSS, "gallery.css" ?>">
    <link rel="stylesheet" href="<?php echo CSS, "app.css?time=", time() ?>">
    <script src="<?php echo jQuery ?>"></script>
    <script src="<?php echo JS, "wow.js" ?>"></script>
    <script src="<?php echo JS, "Validate.js" ?>"></script>
</head>

<body>
    <?php callfile('inc/defaultHeader'); ?>
    <div class="bg">
        <h1>DiamondVille</h1>
        <i>Comprehensive School</i>
    </div>