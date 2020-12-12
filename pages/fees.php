<?php
require_once "Autoload.php";

if(!Session::check("user"))
	Redirect::to("/login");
else
	$title = "Pay Fees";
	
if (Session::get("level") <= 2)
	Redirect::to("/student");

require_once "inc/header.php";

// calling our classes
$e = new Easy();

$user = Session::get("user-info");
?>
		<div class="col-md-10 mx-auto">
			<!--<div id="progress" class="my-3">
				<span class="active">1</span>
				<span>2</span>
			</div>
			<div class="h3 mt-3">Pay fees</div>
			<p class="mb-3">Welcome <strong><?php echo $user->pre . ' ' .$user->p_name ?></strong>, thank you for using this channel.</p>
			<div class="progress-tab">
				<div class="item-1">
					<form method="post" action="fees">
						<div class="form-group">
							<label for="sid">Student ID</label>
							<input type="text" id="sid" class="form-control" name="sid">
						</div>
						<div class="form-group">
							<div class="info"></div>
							<button class="btn btn-success">Submit</button>
						</div>
					</form>
				</div>
				<div class="item-2">
					<form method="post">
						<div class="form-group">
							<label for="acc">Account Number</label>
							<input type="number" name="acc" id="acc" class="form-control">
						</div>
							<div class="info"></div>
							<button class="btn btn-success">Submit</button>
						</div>
					</form>
				</div>
			</div>-->
			<h3>This feature is currently being implemented</h3>
			<a href="/student">Go back</a>
		</div>

<?php require_once "inc/footer.php"; ?>