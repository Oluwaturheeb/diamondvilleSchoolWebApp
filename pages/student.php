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

// getting the current session

$e->table("event");
$cc = $e->fetch(["content"], ["type", "session"])->exec(1);
$c_ses = $cc->content;

$e->table("student");
$r = $e->fetch(["concat(first, ' ', last) as name", "class", "picture", "pre", "dept"], ["a_id", "=", $user])
->exec(1);
Session::set("session", $c_ses);
Session::set("class", $r->class);
Session::set("dept", $r->dept);
?>

		<div class="col-12 mt-3">
			<div class="header">
				<img src="<?php echo $r->picture ?>" alt="<?php echo $r->name ?>" class="img-thumbnail">
				<div>
					<b><?php echo $r->name ?></b>
					<small><?php echo $r->class ?></small>
					<small><i><?php echo $r->dept, " class" ?></i></small>
				</div>
			</div>
			<div class="mt-4"><i><?php echo Utils::time(), " -- ", $c_ses; ?></i></div>
		</div>

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

					if (Session::get("session") == $ss->session) {
						$e->table("event");
						$e->fetch(["content"], ["type", "result"])->exec(1);
						if (!$e->count()) {
							$tr = "<tr><td>$ss->session</td><td colspan='4'>Result for this session is witheld by the Adminstrator's Department</td></tr>";
						}
					}
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
						<table class="table table-stripe">
							$thh
							<tbody>
								$trr
							</tbody>
						</table>
__here;
					} elseif ($ss->class == "Jss 2") {
						$trr .= $tr;
						$j2 = <<<__here
						<div class="h2 my-3">$ss->class</div>
						<table class="table table-stripe">
							$thh
							<tbody>
								$trr
							</tbody>
						</table>
__here;
					} elseif ($ss->class == "Jss 3") {
						$trr .= $tr;
						$j3 = <<<__here
						<div class="h2 my-3">$ss->class</div>
						<table class="table table-stripe">
							$thh
							<tbody>
								$trr
							</tbody>
						</table>
__here;
					} elseif ($ss->class == "Sss 1") {
						$trr .= $tr;
						$s1 = <<<__here
						<div class="h2 my-3">$ss->class</div>
						<table class="table table-stripe">
							$thh
							<tbody>
								$trr
							</tbody>
						</table>
__here;
					}elseif ($ss->class == "Sss 2") {
						$trr .= $tr;
						$s2 = <<<__here
						<div class="h2 my-3">$ss->class</div>
						<table class="table table-stripe">
							$thh
							<tbody>
								$trr
							</tbody>
						</table>
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

		<div class="col-12 col-sm-8 mt-5">
			<div class="action">
				<div class="report">
					<h2>Report</h2>
					<?php echo $report; ?>
				</div>
			</div>
		</div>
<?php
require_once "inc/footer.php";