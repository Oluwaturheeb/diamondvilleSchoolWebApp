<?php
require_once "Autoload.php";
$title = "Welcome";
require_once "inc/header.php";
$e = new Easy();
$e->table("teacher");
if (Validate::req())
	$data = $e->del()->with("remove", ["last"]);//->exec();
?>
<div class="col-12 mt-3 p-3">
	<?php print_r($e); ?>


	<form method="post">
		<div class="input-group">
			<label>last</label>
			<input class="input-line" name="last">
		</div>
		<div class="input-group">
			<input type="hidden" name="a_id" value="1">
			<button class="button">Submit</button>
		</div>
	</form>
</div>
<style>
.dp-link{
	margin-left: -20rem !important;
}

.container, footer {
	margin-left: auto;
}
</style>
<?php 
// this include the app js files
require_once "inc/footer.php";