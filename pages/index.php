<?php
require_once "Autoload.php";
$title = "Welcome";
require_once "inc/header.php";
$r = new Rel();
$r->table(["post", "profile"]);
$data = $r->fetch(["title", "url", "views", "time"], ["name"]);//->exec();
?>

	<div class="container">
		
	</div>
		

<?php 
// this include the app js files
require_once "inc/footer.php";