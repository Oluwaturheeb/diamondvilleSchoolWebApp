<?php
require_once "Autoload.php";

if(!Session::check("user"))
	Redirect::to("/login");
else
	$title = "Admin panel";
	
if (Session::get("user") > 2) 
	Redirect::to("/student");

require_once "inc/header.php";

// calling our classes
$e = new Easy();

$ses = Session::get("level");
$user = Session::get("user");


// fetching subjects

$e->table("subject");
$sub = $e->fetch(["subject"])->exec();
$sub = explode(", ", $sub[0]->subject);

// getting the current session

$e->table("event");
$events = $e->fetch()->exec();
foreach ($events as $key) {
	if ($key->type == "session") {
		$c_ses = $key->content;
	}
}

// getting current user data

$e->table("teacher");
$r = $e->fetch(["concat(pre, '. ', first, ' ', last) as name", "class", "subject", "picture"], ["a_id", "=", $user])->exec(1);
if ($ses == 2) 
	Session::set("class", $r->class); 
	Session::set("session", $c_ses);
?>

			<div class="hidden">
				<div class="col-12 col-sm-10 profile">
					<span class="close">&times;</span>
				</div>
			</div>
			<div class="col-12 mt-3">
				<div class="header">
					<img src="<?php echo $r->picture ?>" alt="<?php echo $r->name ?>" class="img-thumbnail">
					<div>
						<b><?php echo $r->name ?></b>
						<i><?php echo $r->subject ?></i>
						<small><i><?php echo $r->class ?></i></small>
					</div>
				</div>
				<div class="mt-4"><i><?php echo Utils::time(), " -- ", $c_ses; ?></i></div>
			</div>

			<div class="col-12 col-sm-9 mt-3 p-3">
				<div class="action">

					<!-- Teachers -->
					<?php if ($ses == 1): ?>
					<div class="teachers">
						<h2>Teachers</h2>
						<?php
						$td = $e->fetch(["concat(pre, '. ', first, ' ', last) as name", "class", "subject", "picture", "a_id"], ["a_id", "!=", Session::get("user")])->exec();
						foreach ($td as $t): ?>
							<div class="header">
								<div class="image">
									<img src="<?php echo $t->picture ?>" alt="<?php echo $t->name ?>" class="img-thumbnail">
									<form method="post" enctype="multipart/form-data" id="change-pic">
										<input type="file" name="img[]" class="uploader" id="file" capture="">
										<input type="hidden" name="teacher" value="<?php echo $t->a_id; ?>">
										<span>Edit...</span>
									</form>
								</div>
								<div>
									<a href="teacher/<?php echo $t->a_id ?>" class="details"><b><?php echo $t->name ?></b></a>
									<i><?php echo $t->subject ?></i>
									<small><i><?php echo $t->class ?></i></small>
								</div>
							</div>
						<?php endforeach; ?>
					</div>

					<!-- Add subject -->

					<div class="add-subject">
						<h1>Subjects</h1>
						<form method="post">
							<div class="form-group">
								<label for="class">Class</label>
								<select id="class" name="class" class="form-control input-line classes">
									<option value="">Select class</option>
									<option>Jss</option>
									<option>Sss</option>
								</select>
							</div>
							<div class="form-group" style="display: none;">
								<label for="dept">Department</label>
								<select class="form-control input-line" name="dept" id="dept">
									<option value="Junior">Select department</option>
									<option>Art</option>
									<option>Commercial</option>
									<option>Science</option>
								</select>
							</div>
							<div class="form-group">
								<label for="subject">Subject</label>
								<input type="text" name="subject" id="subject" class="form-control input-line">
								<small>Use comma to separate subjects.</small>
							</div>
							<div class="form-group">
								<input type="hidden" name="type" value="add-subject">
								<div class="info"></div>
								<button class="button">Submit</button>
							</div>
						</form>
					</div>

					<!-- students -->
					
					<div class="students">
						<h2>Students</h2>
						<?php
						$e->table("student");
						$sd = $e->fetch(["concat(first, ' ', last) as name", "pin", "dept", "class", "age", "picture", "a_id"])->exec();

						foreach ($sd as $s): ?>
							<div class="header">
								<div class="image">
									<img src="<?php echo $s->picture ?>" alt="<?php echo $s->name ?>" class="img-thumbnail">
									<form method="post" enctype="multipart/form-data" id="change-pic">
										<input type="file" name="img[]" class="uploader" id="file" capture="">
										<input type="hidden" name="student" value="<?php echo $s->a_id; ?>">
										<span>Edit...</span>
									</form>
								</div>
								<div>
									<a href="student/<?php echo $s->a_id; ?>"><b><?php echo $s->name ?></b></a>
									<i><?php echo $s->age, "yrs" ?></i>
									<i><?php echo $s->class ?></i>
									<i><?php echo $s->dept, " class" ?></i>
									<small><i><?php echo $s->pin ?></i></small>
								</div>
							</div>
						<?php endforeach; ?>
					</div>

					<!-- report -->

					<div class="report">
						<h2>Report</h2>
						<form method="post" action="ajax">
							<div class="form-group">
								<label>Class</label>
								<select name="class" id="class" class="form-control input-line classes">
									<option value="">Select class</option>
									<option>Jss 1</option>
									<option>Jss 2</option>
									<option>Jss 3</option>
									<option>Sss 1</option>
									<option>Sss 2</option>
									<option>Sss 3</option>
								</select>
							</div>
							<div class="form-group" style="display: none;">
								<label for="dept">Department</label>
								<select class="form-control input-line" name="dept" id="dept">
									<option value="Junior">Junior</option>
									<option>Art</option>
									<option>commercial</option>
									<option>Science</option>
								</select>
							</div>
							<div class="form-group" style="display: none;">
								<input type="hidden" name="type" value="score">
							</div>
							<div class="info"></div>
						</form>
						<div class="report-result"></div>
					</div>
					
					<!-- info -->

					<?php elseif ($ses == 2): ?>
					<div class="info">
						<h2>Account Information</h2>
					</div>
					
					<!-- report -->
					<div class="report">
						<h2>Report</h2>
						
					</div>

					<!-- exam -->
					<div class="exam">
						<h2>Exam</h2>
						<p class="note text-left mb-3">
						<small>Note: If there is already a question saved, any question set will be an update to the subject!</small>
						</p>
						<form method="post" id="" class="mt-4">
							<div class="form-group select">
								<label>Class</label>
								<select name="class" class="form-control input-line" id="exam-sub">
									<option value="">Select class</option>
									<?php foreach(explode(", ", $r->class) as $c): ?>
										<option><?php echo $c; ?></option>
									<?php endforeach; ?>
								</select>
								<div class="subject-info"></div>
							</div>
							<div class="form-group select">
								<label>Subject</label>
								<select name="subject" class="form-control input-line" id="exam-sub">
									<option value="">Select subject</option>
									<?php foreach(explode(", ", $r->subject) as $s): ?>
										<option><?php echo $s; ?></option>
									<?php endforeach; ?>
								</select>
								<div class="subject-info"></div>
							</div>
							<div class="form-group set">
								<label>Total question</label>
								<input type="number" id="set" class="form-control input-line" placeholder="Enter number...">
							</div>
							<div>
								<input type="hidden" name="type" value="exam">
							</div>
							<div class="form-question form-group"></div>
						</form>
					</div>

					<?php endif; ?>
				
					<!-- Add teacher -->
					<?php if ($ses == 1): ?>
					<div class="add-teacher">
						<form method="post" id="create-teacher" class="" autocomplete="">
							<h2>Add teacher</h2>
							<div class="form-group">
								<label for="pre">Prefix</label>
								<select name="pre" id="pre" class="form-control input-line">
									<option value="">Prefix</option>
									<option>Miss</option>
									<option>Mr</option>
									<option>Mrs</option>
								</select>
							</div>
							<div class="form-group">
								<label for="first">Firstname</label>
								<input name="first" type="text" id="first" placeholder="Enter firstname..." class="form-control input-line">
							</div>
							<div class="form-group">
								<label for="last">Lastname</label>
								<input name="last" type="text" id="last" placeholder="Enter lastname..." class="form-control input-line">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input name="email" type="email" id="email" placeholder="Enter email address" class="form-control input-line">
							</div>
							<div class="form-group">
								<label for="dob">Date of birth</label>
								<input name="dob" type="date" id="dob" class="form-control input-line">
							</div>
							<div class="form-group">
								<label for="hadd">Address</label>
								<input name="hadd" type="text" id="hadd" placeholder="Enter address..." class="form-control input-line">
							</div>
							<div class="form-group">
								<label for="class">Class</label>
								<select class="form-control input-line classes" name="class[]" id="class" multiple>
									<option value="">Select class</option>
									<option>Jss 1</option>
									<option>Jss 2</option>
									<option>Jss 3</option>
									<option>Sss 1</option>
									<option>Sss 2</option>
									<option>Sss 3</option>
								</select>
							</div>
							<div style="display: none;"></div>
							<div class="form-group">
								<label for="subject">Subject</label>
								<select class="form-control input-line subject" name="subject[]" id="class" row="2" multiple>
									<option value="">Select subject</option>
									<?php foreach($sub as $s):?>
									<option><?php echo $s; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<input type="hidden" name="create" value="teacher">
								<div class="info"></div>
								<button class="button">Submit</button>
							</div>
						</form>
					</div>
					
					<!-- Add student -->
					
					<div class="add-student mt-4">
						<form method="post" id="create-student" class="" autocomplete="">
							<h2 class="my-3">Add student</h2>
							<div class="form-group">
								<label for="first">Firstname</label>
								<input name="first" type="text" id="first" placeholder="Enter firstname..." class="form-control input-line">
							</div>
							<div class="form-group">
								<label for="last">Lastname</label>
								<input name="last" type="text" id="last" placeholder="Enter lastname..." class="form-control input-line">
							</div>
							<div class="form-group">
								<label for="gender">Gender</label>
								<select name="gender" id="gender" class="form-control input-line">
									<option value="">Gender</option>
									<option>Female</option>
									<option>Male</option>
								</select>
							</div>
							<div class="form-group">
								<label for="dob">Date of birth</label>
								<input name="dob" type="date" id="dob" class="form-control input-line" min="1990-01-01" max="2015-01-01">
							</div>
							<div class="form-group">
								<label for="hadd">Address</label>
								<input name="hadd" type="text" id="hadd" placeholder="Enter address..." class="form-control input-line">
							</div>
							<div class="form-group">
								<label for="class">Class</label>
								<select class="form-control input-line classes" name="class" id="class">
									<option value="">Select class</option>
									<option>Jss 1</option>
									<option>Jss 2</option>
									<option>Jss 3</option>
									<option>Sss 1</option>
									<option>Sss 2</option>
									<option>Sss 3</option>
								</select>
							</div>
							<div class="form-group" style="display: none;">
								<label for="dept">Department</label>
								<select class="form-control input-line" name="dept" id="dept">
									<option value="Junior">Junior</option>
									<option>Art</option>
									<option>commercial</option>
									<option>Science</option>
								</select>
							</div>
							<div class="form-group">
							<div class="h3 my-3">Parent's section</div>
								<label for="pre">Prefix</label>
								<select name="pre" id="pre" class="form-control input-line">
									<option value="">Prefix</option>
									<option>Mr</option>
									<option>Mrs</option>
								</select>
							</div>
							<div class="form-group">
								<label for="p-first">Firstname</label>
								<input name="p_first" type="text" id="p-first" placeholder="Enter firstname..." class="form-control input-line">
							</div>
							<div class="form-group">
								<label for="p-last">Lastname</label>
								<input name="p_last" type="text" id="p-last" placeholder="Enter lastname..." class="form-control input-line">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input name="email" type="email" id="email" placeholder="Enter email address" class="form-control input-line">
							</div>
							<div class="form-group">
								<label for="phone">Phone</label>
								<input name="phone" type="tel" id="phone" placeholder="Enter phone number..." class="form-control input-line">
							</div>
							<div class="form-group">
								<input type="hidden" name="create" value="student">
								<div class="info"></div>
								<button class="button">Add!</button>
							</div>
						</form>
					</div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Other side  -->

			<?php if ($ses == 1): ?>
			<div class="col-12 col-sm-3 mt-3 p-3 bl">
				<div>
					<h3>Active events</h3>
					<?php foreach ($events as $key): ?>
						<div class="active">
							<b><?php echo ucfirst($key->type); ?></b>
							<br>
							<small><?php echo ucfirst($key->content); ?></small>
							<div class="close delete-event" id="<?php echo $key->id; ?>">&times;</div>
							<hr>
						</div>
					<?php endforeach; ?>
				</div>
				<form method="post" action="ajax" id="session">
					<h3>Acadamic session</h3>
					<div class="form-group check2radio">
						<input type="checkbox" name="content" value="First term">
						First term
					</div>
					<div class="form-group check2radio">
						<input type="checkbox" name="content" value="Second term">
						Second term
					</div>
					<div class="form-group check2radio">
						<input type="checkbox" name="content" value="Third term">
						Third term
					</div>
					<div>
						<div class="info"></div>
						<input type="hidden" name="type" value="session">
					</div>
				</form>
				<hr>
				<form method="post" action="ajax">
					<h3>Exam</h3>
					<div class="form-group check2radio">
						<input type="checkbox" name="content" value="Yes">
						Exam begins
					</div>
					<div>
						<div class="info"></div>
						<input type="hidden" name="type" value="exams">
					</div>
				</form>
				<hr>
				<form method="post" action="ajax">
					<h3>Results</h3>
					<div class="form-group check2radio">
						<input type="checkbox" name="content" value="Yes">
						Release results
					</div>
					<div>
						<div class="info"></div>
						<input type="hidden" name="type" value="result">
					</div>

				</form>
			</div>
			<?php endif; ?>
			
<?php
require_once "inc/footer.php";