<?php
require_once "Autoload.php";
$title = "Login";
require_once "inc/header.php";
?>
		<div class="_auth">
			<?php Session::del(); require_once "auth/login.php"; ?>
		</div>
		<style>
		.dp-link{
			margin-left: -20rem;
		}
		
		.container, footer {
			margin-left: auto;
		}
		
		.container {
			display: grid;
			justify-content: center;
		}
		</style>
<?php require_once "inc/footer.php";