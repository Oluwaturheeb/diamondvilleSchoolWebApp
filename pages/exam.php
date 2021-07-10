<?php
authCheck('/login');
$u = session('student');
if ($u->active == 1) redirect('student');

$user = authId();
$cls = $u->class;
$sss = session('session');
$dept = $u->dept;
$title = 'Exam center';

require_once 'inc/header.php';

$exam = session('exam');

if(time() >= strtotime($exam)):
	// getting data from attendance if the student have sat for an exam b4 for the given session
	$d = Db::instance();
	$data = $d->table('attendance')->get(['subject'])->where(['a_id', $user], ['session', $sss], ['sit', 0])->res(1);
	
	$d->table('exam');
	if ($d->count()) {
		// if yes get the next exam on the list
		$subject = $data->subject;
		$d->get()
		->where( 
			['class', $cls],
			['subject', $subject]
		);
	} else {
		// if not then get the first exam from the database;
		$d->get()
		->where(['class', $cls]);
	}
	
	$data = $d->res(1);

	if ($data):
  
	$r = $data;
	session('subject', $r->subject);
	$q = explode('***EXAM***', $r->question);
	$a = explode('***EXAM***', $r->opt_a);
	$b = explode('***EXAM***', $r->opt_b);
	$c = explode('***EXAM***', $r->opt_c);
	$d = explode('***EXAM***', $r->opt_d); 
	$t = $r->time_allowed;

	$all = Utils::json(['question' => $q, 'a' => $a, 'b' => $b, 'c' => $c, 'd' => $d]);
?>
<div class='exam col-sm-8 col-md-8 p-5 mx-auto'>
	<script src="assets/js/timezz.js"></script>
	<script>
		var time = <?php echo $t ?>;
		var date = new Date();
		var toStop = date.setMinutes(date.getMinutes() + time);
		var cl = timezz('.timer', {
			date: toStop
		});
	</script>
	<div class="text-center">
		<h1>DiamondVille</h1>
		<h4>Comprehensive School</h4>
		<h5>Examination Portal</h5>
		<div class="mt-3">
			<h4><?php echo $r->subject; ?></h4>
		</div>
		<div class="timer my-5" id="">
			<div class="p-2" data-hours></div>
			<div class="p-2" data-minutes></div>
			<div class="p-2" data-seconds></div>
		</div>
	</div>
	<h4 class="text-center"><small class="count"></small></h4>
	<div class="e-question my-5"><span></span></div>
	
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
	nav, footer {
		display: none !important;
	}
	.container {
		margin: 0;
		padding: 0;
		width: 100%;
	}
	h1 {
		color: var(--pry);
	}
</style>
<?php csrf(); else: ?>
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
	<?php /*if(!empty($data)): 
	foreach($data as $sub):
		foreach($sub as $key => $val):
			if($val == 1):
				echo "<div class='done'>$key</div>";break;
			else:
				echo "<div class='next'>$key</div>";break;
			endif;
		endforeach;
	endforeach;
	endif;*/?>
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
	$e->table('attendance');
	
	$e->set(['sit'], [1])
	->concat(['and', 'and'])
	->where(['session', $sss], ['a_id', $user],['subject', '$r->subject'])
	->exec();
}
*/
require_once 'inc/footer.php';