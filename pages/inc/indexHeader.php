<!DOCTYPE html>
<html>

<head>
	<base href="/">
	<meta charset="utf-8">
	<meta lang="<?php echo $c->get("project/lang"); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scaleable=no">
	<title><?php echo $title, " @ ", PNAME ?></title>
	<link rel="stylesheet" href="assets/boot/bootstrap.css">
	<link rel="stylesheet" href="<?php echo style . 'animate.css'?>">
	<link rel="stylesheet" href="<?php echo style . 'icofont/icofont.css'?>">
	<link rel="stylesheet" href="<?php echo style . 'owl.carousel.min.css'?>">
	
	<!-- app stylesheet -->
	
	<link rel="stylesheet" type="text/css" href="<?php echo style . "app.css" ?>">
	
	<!-- stylesheet ends here -->
	<script src="<?php echo jq ?>"></script>
	<script src="<?php echo js, "wow.js" ?>"></script>
	<script src="<?php echo js, "Validate.js" ?>"></script>
	<script src="<?php echo js, "owl.carousel.min.js" ?>"></script>
</head>
<body>
	<?php
	require_once "inc/headers/header6.php";
?>
<div class="bg">
	<h1>DiamondVille</h1>
	<i>Comprehensive School</i>
</div>