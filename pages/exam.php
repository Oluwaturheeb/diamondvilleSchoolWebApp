<?php
require_once "Autoload.php";

if (!Session::check("user"))
	Redirect::to("/login");

if (Session::get("active") == 1) 
	Redirect::to("student");

$user = Session::get("user");
$cls = Session::get("class");
$sss = Session::get("session");
$dept = Session::get("dept");

$title = "Exam center";
require_once "inc/header.php";

$e = new Easy();
$e->table("event");
$echeck = $e->fetch(["id", "content", "type"], ["type", "exams"])->exec(1);

if(time() >= @strtotime($echeck->content)):
	// getting data from attendance if the student have sat for an exam b4 for the given session
	$e->table("attendance");
	$e->concat(["and", "and"]);
	$data = $e->fetch(["subject"], ["a_id", $user], ["session", $sss], ["sit", 0])->exec(1);

	$e->table("exam");
	if ($e->count()) {
		// if yes get the next exam on the list
		$subject = $data->subject;
		$e->fetch(
			["question", "opt_a", "opt_b", "opt_c", "opt_d", "subject"], 
			["class", $cls],
			["subject", $subject]
		);
	} else {
		// if not then get the first exam from the database;
		$e->fetch(
			["question", "opt_a", "opt_b", "opt_c", "opt_d", "subject"], 
			["class", $cls]
		);
	}
	
	$data = $e->exec(1);

	if($data):
  
	$r = $data;
	Session::set("subject", $r->subject);
	$q = explode("___", $r->question);
	$a = explode("___", $r->opt_a);
	$b = explode("___", $r->opt_b);
	$c = explode("___", $r->opt_c);
	$d = explode("___", $r->opt_d); 

	$all = Utils::json(["question" => $q, "a" => $a, "b" => $b, "c" => $c, "d" => $d]);
?>
<div class="exam col-sm-8 col-md-8 p-5">
	<script src="assets/js/timezz.js"></script>
<script>
			var date = new Date();
			var toStop = date.setHours(date.getHours() + 1);
			var cl = timezz('.timer', {
		    date: toStop
		 });
	</script>
	<div class="col-10">
		<div class="timer mt-3" id="">
			<div class="p-2" data-hours></div>
			<div class="p-2" data-minutes></div>
			<div class="p-2" data-seconds></div>
		</div>
	</div>
	<div class="my-3">
		<h3><?php echo $r->subject ?></h3>
		<small></small>
	</div>
	<div class="e-question mb-3"><span></span></div>
	
	<div class="option">
		<div class="e-a mb-3" id="e-a"><input accesskey="a" name="opt_a" value="A" type="checkbox"> A. <span></span></div>
		<div class="e-b mb-3" id="e-b"><input accesskey="b" name="opt_b" value="B" type="checkbox"> B. <span></span></div>
		<div class="e-c mb-3" id="e-c"><input accesskey="c" name="opt_c" value="C" type="checkbox"> C. <span></span></div>
		<div class="e-d mb-3" id="e-d"><input accesskey="d" name="opt_d" value="D" type="checkbox"> D. <span></span></div>
	</div>
	<div class="exam-info"></div>
	<div class="control-btn my-3">
	 	<button class="btn btn-success" type="button" id="next">Next question</button>
	</div>
</div>

<script>
	var loop = <?php echo $all ?>;
</script>
<script src="assets/js/exam.js"></script>
<style type="text/css">
	.active {
		padding: 10px;
		border-left: 3px solid var(--pry);
		box-shadow: 1px 1px 2px var(--pry);
	}

	.e-question {
		padding: 10px;
		border-left: 3px solid var(--hover);
		word-spacing: 5px;
		box-shadow: 1px 1px 2px var(--hover);
	}

	.e-question::first-letter{
		text-transform: capitalize;
	}
</style>
<?php else: ?>
<h1 class="my-4">No exam!</h1>
<?php
endif;
else:
?>
<h1 class="my-4">Not yet time for exam!</h1>
<?php endif; ?>


<!-- <div class="menu">
	<a href="student.php">Home</a>
	<div class="subject">
	<?php if(!empty($data)): 
	foreach($data as $sub):
		foreach($sub as $key => $val):
			if($val == 1):
				echo "<div class='done'>$key</div>";break;
			else:
				echo "<div class='next'>$key</div>";break;
			endif;
		endforeach;
	endforeach;
	endif;?>
	</div>
</div>
<div class="toggler-menu">
	<span></span>
	<span></span>
	<span></span>
</div> -->


<?php
// marking attendance upon seeing the exam
/*if (@$r) {
	$e->table("attendance");
	
	$e->set(["sit"], [1])
	->concat(["and", "and"])
	->where(["session", $sss], ["a_id", $user],["subject", "$r->subject"])
	->exec();
}
*/
require_once "inc/footer.php";