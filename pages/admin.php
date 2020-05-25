<?php
require_once "Autoload.php";

if(!Session::check("user"))
	Redirect::to("/login");
else 
	$title = "Admin panel";

require_once "inc/header.php";
$e = new Easy();
$e->table("teacher");
$r = $e->fetch(["concat(first, ' ', last) as name", "class", "picture", "pre"], ["a_id", "=", Session::get("user")])->exec(1);
?>
			<div class="col-12">
				<div class="header">
					<img src="<?php echo $r->picture ?>" alt="<?php echo $r->name ?>" class="img-thumbnail">
					<div>
						<b><?php echo $r->pre, $r->name ?></b>
						<br/>
						<small><i><?php echo $r->class ?></i></small>
					</div>
				</div>
			</div>
			<div class="action">
			
				<!-- Add teacher -->
			
				<div id="add-teacher">
					<form method="post" id="create-teacher" class="" autocomplete="off">
						<h2>Add teacher</h2>
						<div class="form-group">
							<label for="pre">Prefix</label>
							<select name="pre" id="pre" class="input-round">
								<option value="">Prefix</option>
								<option>Miss</option>
								<option>Mr</option>
								<option>Mrs</option>
							</select>
						</div>
						<div class="form-group">
							<label for="first">Firstname</label>
							<input name="first" type="text" id="first" placeholder="Enter firstname..." class="input-round">
						</div>
						<div class="form-group">
							<label for="last">Lastname</label>
							<input name="last" type="text" id="last" placeholder="Enter lastname..." class="input-round">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input name="email" type="email" id="email" placeholder="Enter email address" class="input-round">
						</div>
						<div class="form-group">
							<label for="dob">Date of birth</label>
							<input name="dob" type="date" id="dob" class="input-round">
						</div>
						<div class="form-group">
							<label for="hadd">Address</label>
							<input name="hadd" type="text" id="hadd" placeholder="Enter address..." class="input-round">
						</div>
						<div class="form-group">
							<label for="class">Class</label>
							<select class="input-round" name="class" id="cls">
								<option value="">Select class</option>
								<option>Jss 1</option>
								<option>Jss 2</option>
								<option>Jss 3</option>
								<option>Sss 1</option>
								<option>Sss 2</option>
								<option>Sss 3</option>
							</select>
						</div>
						<div class="form-group">
							<div class="info"></div>
							<button class="button">Submit</button>
						</div>
					</form>
				</div>
				
				<!-- Add student -->
				
				<div class="add-student mt-4">
					<form method="post" id="create-student" class="" autocomplete="off">
						<h2 class="my-3">Add student</h2>
						<div class="form-group">
							<label for="first">Firstname</label>
							<input name="first" type="text" id="first" placeholder="Enter firstname..." class="input-round">
						</div>
						<div class="form-group">
							<label for="last">Lastname</label>
							<input name="last" type="text" id="last" placeholder="Enter lastname..." class="input-round">
						</div>
						<div class="form-group">
							<label for="gender">Gender</label>
							<select name="gender" id="gender" class="input-round">
								<option value="">Gender</option>
								<option>Female</option>
								<option>Male</option>
							</select>
						</div>
						<div class="form-group">
							<label for="dob">Date of birth</label>
							<input name="dob" type="date" id="dob" class="input-round" min="1990-01-01" max="2015-01-01">
						</div>
						<div class="form-group">
							<label for="hadd">Address</label>
							<input name="hadd" type="text" id="hadd" placeholder="Enter address..." class="input-round">
						</div>
						<div class="h3 my-3">Parent's section'</div>
						<div class="form-group">
							<label for="pre">Prefix</label>
							<select name="pre" id="pre" class="input-round">
								<option value="">Prefix</option>
								<option>Mr</option>
								<option>Mrs</option>
							</select>
						</div>
						<div class="form-group">
							<label for="p-first">Firstname</label>
							<input name="p_first" type="text" id="p-first" placeholder="Enter firstname..." class="input-round">
						</div>
						<div class="form-group">
							<label for="p-last">Lastname</label>
							<input name="p_last" type="text" id="p-last" placeholder="Enter lastname..." class="input-round">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input name="email" type="email" id="email" placeholder="Enter email address" class="input-round">
						</div>
						<div class="form-group">
							<div class="student-info"></div>
							<button class="button">Add!</button>
						</div>
					</form>
					<form method="post" enctype="multipart/form-data" id="img">
						<div class="h2 my-3">Upload picture</div>
						<div class="form-group">
							<div class="holder">
								<input type="file" name="files[]" id="file" class="file-input student">
								<span></span>
							</div>
						</div>
						<div class="form-group">
						 <div class="img-info"></div>
							<button class="button">Upload</button>
						</div>
					</form>
				</div>
			</div>
<?php
require_once "inc/footer.php";