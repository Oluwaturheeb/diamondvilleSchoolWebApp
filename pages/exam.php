<?php
require_once "Autoload.php";
/*
if (!Session::check("user"))
	Redirect::to("/login");*/

$user = Session::get("user");
$cls = Session::get("class");

$e = new Easy();
$title = "Exam center";
require_once "inc/header.php";

$e->table("event");
$echeck = $e->fetch(["id", "content", "type"], ["type", "exams"], ["type", "session"], "or")->exec();

if($e->count() == 2):
	// getting the current session from event table
	$sss = "";
	foreach($echeck as $key) {
		if ($key->type == "session") {
			$sss .= $key->content;
		}
	}

	$e->table("score");
	// getting data from score if the student have sat for an exam b4
	$data = $e->fetch(["data", "session"], ["a_id", $user], ["class", $cls])->exec(1);

	// getting exams from here

	$e->table("exam");

	if ($e->count() == 0) {
		// if the student haven't done any exam at all
		$data = $e->fetch(["question", "opt_a", "opt_b", "opt_c", "opt_d", "subject"], ["class", "!=", "" /*Session::get("class")*/])->exec(1);
	} else {
		// if the student have sat for an exam b4
		$to = [];
		$sub = [];

		foreach ($data as $sub) {
			foreach ($sub as $key => $val) {
				if($val == 0) {
					array_push($to, $key);
					break;
				}
			}
		}

		foreach ($to as $val) {
			$data = $e->fetch(["data", "subject"], ["class", "=", $cls], ["subject", "=", $val])->exec(1);
			if($e->count()) {
				break;
			}
		}
	}
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
<div class="exam col-11 col-sm-8 col-md-6">
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
	var info = $('.exam-info');
	
	var q = loop.question;
	var a = loop.a;
	var b = loop.b;
	var c = loop.c;
	var d = loop.d;
	var count = q.length;
	var next = 1;
	var init = 0;
	var arr = [];
	$('.e-question span').html(q[0]);
	$('.e-a span').html(a[0]);
	$('.e-b span').html(b[0]);
	$('.e-c span').html(c[0]);
	$('.e-d span').html(d[0]);
	$('.my-3 small').text('No ' + next +' of ' + count);
	
	$('.control-btn button').click(function(){
		var val = $('.option input:checkbox:checked').val();
		if(!v.empty(val, true)){
			info.html('');
			$('.option input:checkbox').prop('checked', false);
			$('.option div').removeClass('active');
		
			$('.e-question span').html(q[0 + next]);
			$('.e-a span').html(a[0 + next]);
			$('.e-b span').html(b[0 + next]);
			$('.e-c span').html(c[0 + next]);
			$('.e-d span').html(d[0 + next]);

			

			$('.my-3 small').text('No ' + next +' of ' + count);

			if(arr.length != count){
				arr.push(val);
			}

			if(arr.length == count){
				$(this).html("Submit");
				var con = confirm('You are about to submit!');
				if(con){
					$.ajax({
						data: {'exam-ans': arr},
						success: e => {
							if(e == 'ok'){
								info.html("Submitted");
								v.redirect();
							}else{
								info.html(e);
							}
						}
					});
				}
			}
		}else {
			info.html('Select an answer!');
		}
		if(next != count){
				next++;
			}
	});
	
	$('.exam .option div').click(function(){
		var id = $(this).attr('id');
		$(this).addClass('active').siblings().removeClass('active');
		$(this).children('input').prop('checked', true);
		$(this).siblings().children('input').prop('checked', false);
	});
	
</script>
<style type="text/css">
	.active {
		padding: 10px;
		border-left: 3px solid var(--pry);
		box-shadow: 1px 1px 2px var(--pry);
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
require_once "inc/footer.php";