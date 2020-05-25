<?php
require_once "Autoload.php";
$title = "Login";
require_once "inc/header.php";
?>
		<div class="_auth">
			<?php Session::del(); require_once "auth/login.php"; ?>
		</div>
<?php require_once "inc/footer.php";