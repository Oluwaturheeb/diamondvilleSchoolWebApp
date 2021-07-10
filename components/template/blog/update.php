<?php 
authCheck();
if (!req()) error();

$c = new Crud('post');
$data = $c->fetch()->exec(1);

if ($data->user !== AUTHID) error();
// print_r($data);

callfile ('inc/header', 'Edit Post');
?>
<div class="container">
		<div class="row">
			<div class="col-10">
				<form class="form-group" id="create-post" method="post">
					<div class="">
						<label for=""></label>
						<input type="" name="" class="form-control" id="" placeholder="">
					</div>
					<div class="">
						<label for=""></label>
						<input type="" name="" class="form-control" id="" placeholder="">
					</div>
					<div class="">
						<label for=""></label>
						<input type="" name="" class="form-control" id="" placeholder="">
					</div>
					<div class="">
						<label for=""></label>
						<input type="" name="" class="form-control" id="" placeholder="">
					</div>
					<div class="">
						<label for=""></label>
						<input type="" name="" class="form-control" id="" placeholder="">
					</div>
					<div class="">
						<label for=""></label>
						<input type="" name="" class="form-control" id="" placeholder="">
					</div>
					<div class="">
						<div class="info"></div>
						<button type="button" class="btn btn-danger"></button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php 
// this include the app js files
require_once "inc/footer.php";