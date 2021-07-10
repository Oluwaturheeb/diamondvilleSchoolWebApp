<?php callfile ('const'); ?>
<!DOCTYPE html>
<html>

<head>
	<base href="/">
	<meta charset="utf-8">
	<meta lang="<?php echo config('project/lang') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scaleable=no">
	<title><?php echo $title, ' @ ', APP ?></title>
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo CSS . "app.css?time=", time() ?>">
	<script src="<?php echo jQuery ?>"></script>
	<script src="<?php echo JS, "Validate.js" ?>"></script>
</head>
<body>
	<?php callfile('inc/defaultHeader'); ?>
<div class="bg">
	<h1>DiamondVille</h1>
	<i>Comprehensive School</i>
</div>
	<div class="container">
		<div class="row">