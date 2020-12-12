<?php
require_once "Autoload.php";

if(!Session::check("user"))
	Redirect::to("/login");
else 
	$title = "My dashboard";

$user = Session::get("user");
$v = new Validate();

if ($_GET) {
	$v->val_req(["number" => true]);

	if ($v->error()) 
		Redirect::to();

	$user = $v->fetch("a_id");
	$title = "Student report";
}

require_once "inc/header.php";
$e = new Easy();

// getting the current session either from the db or from admin visiting the student account

if (empty($_GET)) {
	$e->table("event");
	$cc = $e->fetch(["content", "type"])->exec();
	
	if ($e->count()) {
		foreach ($cc as $key) {
			if ($key->type == "session") 
				$c_ses = $key->content;
			elseif ($key->type == "result")
			//result event date
				$date = $key->content;
		}
		Session::set("session", $c_ses);
	} else {
		$date = null;
		$c_ses = "Session unavailable";
	}
} else {
	$c_ses = Session::get('session');
}
// getting student info

if (isset($_GET["a_id"])){ 
$e->table(["student", "auth"]);
	$r = $e->rfetch(
		["student.*", "email"], 
		[["a_id", "auth.id"]],
		)
		->exec(1);
		// from from a visiting admin we should always set this 
		Session::set('user-info', $r);
} else {
	if (!Session::get('user-info')) {
		$e->table("student");
		$r = $e->fetch(
			["*"] ,
			["a_id", $user]
			)
			->exec(1);
		Session::set('user-info', $r);
		Session::set("class", $r->class);
		Session::set("dept", $r->dept);
		Session::set("active", $r->active);
	}	
}

$r = Session::get('user-info');
$dashdate = Utils::time($r->dob);

$dash = <<<__here
						<strong>Fullname</strong>
						<p class="pl-2">$r->fullname ($r->gender)</p>
						<strong>Guardian Fullname</strong>
						<p class="pl-2">$r->pre. $r->p_name</p>
						<strong>Student ID</strong>
						<p class="pl-2">$r->pin</p>
						<strong>Date Of Birth</strong>
						<p class="pl-2">$dashdate ($r->age)</p>
						<strong>Address</strong>
						<p class="pl-2">$r->hadd</p>
__here;

if (@$r->active) 
	$active = "Welcome <b>$r->fullname</b>, you can only view and print your result since you are no longer a part of the system!";
else 
	$active = Utils::time() . " -- " . $c_ses;
	
	if ($r):
?>

		<div class="col-12 mt-3">
			<div class="header">
				<?php
				if (Session::get("level") < 3) {
				$admin = "<div>$r->pre. $r->p_name (Parent/Guardian)</div>";
				} else {
					$admin = "";
				}
				echo <<<__here
				<img src="$r->picture" alt="$r->fullname" class="img-thumbnail">
				<div>
					<b>$r->fullname</b>
					$admin
					<small>$r->class</small>
					<small><i>$r->dept class</i></small>
				</div>
			</div>
__here; 
endif;
?>

		<div class="bl mt-4 px-3"><i><?php echo $active ?></i></div>
		</div>

		<?php
		if ($r):
		?>
		<?php
		$e->table("score");
		$sc = $e->fetch(["*"], ["a_id", $user])->exec();

		// $subject = [];

		$th = $td = $rep = $cur = $trr = $tr = "";

		// all available class to avoid undefined var error!
		$j1 = $j2 = $j3 = $s1 = $s2 = "";

		foreach($sc as $ss) {
				$data = Utils::djson($ss->data);
				// $data =
				for ($i = 0, $count = count(array_reverse($data)); $i < $count; $i++) {
					$session = $ss->session;
					$th .= "<th>{$data[$i]["subject"]}</th>";
					$td .= "<td>{$data[$i]["score"]}</td>";
				}

				$thh = "<thead><th>Session</th> {$th}</thead>";
				$th = "";
				
				$tr .= "<tr><td> {$session} </td> {$td} </tr>";
				$td = "";

				// listing the results from the current class and previous classes

				if($ss->class == $r->class) {
					// checking if we can display the result for this session
					var_dump(time() >= strtotime($date));
					if (empty($date))
						$tr = 'unspecified date';
					elseif (time() <= strtotime(@$date)) 
						$tr = "<tr><td>$ss->session</td><td colspan='4'>Result for this session is been witheld by the Adminstrator's Department till $date</td></tr>";
					
					$trr .= $tr;
					$cur = <<<__here
					<div class="h2 my-3">$r->class <small>(Current class)</small></div>
					<table class="table table-stripe">
						<thead>
							$thh
						<tbody>
							$trr
						</tbody>
					</table>
__here;
					$tr = "";
				} else {
					if ($ss->class == "Jss 1") {
						$trr .= $tr;
						$j1 = <<<__here
						<div class="h2 my-3">$ss->class</div>
						<details>
							<summary>See results</summary>
							<table class="table table-stripe">
								$thh
								<tbody>
									$trr
								</tbody>
							</table>
						</details>
__here;
					} elseif ($ss->class == "Jss 2") {
						$trr .= $tr;
						$j2 = <<<__here
						<div class="h2 my-3">$ss->class</div>
						<details>
							<summary>See results</summary>
							<table class="table table-stripe">
								$thh
								<tbody>
									$trr
								</tbody>
							</table>
						</details>
__here;
					} elseif ($ss->class == "Jss 3") {
						$trr .= $tr;
						$j3 = <<<__here
						<div class="h2 my-3">$ss->class</div>
						<details>
							<summary>See results</summary>
							<table class="table table-stripe">
								$thh
								<tbody>
									$trr
								</tbody>
							</table>
						</details>
__here;
					} elseif ($ss->class == "Sss 1") {
						$trr .= $tr;
						$s1 = <<<__here
						<div class="h2 my-3">$ss->class</div>
						<details>
							<summary>See results</summary>
							<table class="table table-stripe">
								$thh
								<tbody>
									$trr
								</tbody>
							</table>
						</details>
__here;
					}elseif ($ss->class == "Sss 2") {
						$trr .= $tr;
						$s2 = <<<__here
						<div class="h2 my-3">$ss->class</div>
						<details>
							<summary>See results</summary>
							<table class="table table-stripe">
								$thh
								<tbody>
									$trr
								</tbody>
							</table>
						</details>
__here;
					}
					// i ran out of logic here so i wanted to try something if its gonna work

					if ($ss->session == "Third term") {
						$trr = "";
					}
					$tr = "";

				}
			}
			$report = $cur . $s2 . $s1 . $j3 . $j2 . $j1;
			?>
			<?php
			else:
			$report = '<p>No student match the query!</p>';
			endif;
		?>

		<div class="col-12 col-sm-8 mt-5 mx-3">
			<div class="action">
				<div class="dashboard">
					<h2>Dashboard</h2>
					<div class="my-4 px-3">
						<?php echo $dash ?>
					</div>
				</div>
				<div class="report">
					<h2>Report</h2>
					<?php echo $report; ?>
				</div>
			</div>
		</div>
<?php
require_once "inc/footer.php";