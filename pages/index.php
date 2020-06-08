<?php
require_once "Autoload.php";
$title = "Welcome";
require_once "inc/header.php";
$e = new Easy();
$e->table("teacher");
if (Validate::req())
	$data = $e->create();
?>
<div class="col-12 mt-3 p-3">
	
</div>
<style>
.dp-link{
	margin-left: -20rem;
}

.container, footer {
	margin-left: auto;
}
</style>
<?php 
// this include the app js files
require_once "inc/footer.php";