<?php
require_once "Autoload.php";

if(!Session::check("user"))
	Redirect::to("/login");
else 
	$title = "My dashboard";

require_once "inc/header.php";
$e = new Easy();
$e->table("student");
$e->fetch(["concat(first, ' ', last)"], ["a_id", "=", Session::get("user")]);
?>

	<div class="container">
		<?php print_r($e) ?>
	</div>





<?php
require_once "inc/footer.php";