<?php
authCheck('/login');
$title = 'My dashboard';

$user = AUTHID;
$d = Db::instance();

if (req('a_id')) {
	$c = (new Validate())->validator(req(), [
		'a_id' => ['number' => true]
	])->error();

	if ($c) error($c);

	$user = req('a_id');
	$title = 'Student report';
}

// getting the current session either from the db or from admin visiting the student account

if (!session('session')) {
	$events = $d->table('event')
	->get()
	->where(['type', '!=', ''])->res();
	
	$ses = [];
	foreach ($events as $key)
		if ($key->type == 'session')
			session('session', $key->content);
		elseif ($key->type == 'result')
			session('result', $key->content);
		elseif ($key->type == 'exam') 
			session('exam', $key->content);
}

$c_ses = session('session');
$date = session('result');


if (session('level') == 3) {
	if (!session('student')) {
		$r = $d->table('student')->get()->where(['a_id', $user])->res(1);
		if (!$r) error('Cannot find the account you are looking for on this server!');
		session('student', $r);
	}
	$r = session('student');
} else {
	$r = $d->table('student')->get()->where(['a_id', $user])->res(1);
}

$dob = Utils::datetime($r->dob);
$dash = <<<__here
						<strong>Fullname</strong>
						<p class="pl-2">$r->fullname ($r->gender)</p>
						<strong>Guardian Fullname</strong>
						<p class="pl-2">$r->pre. $r->p_name</p>
						<strong>Student ID</strong>
						<p class="pl-2">$r->pin</p>
						<strong>Date Of Birth</strong>
						<p class="pl-2">$dob ($r->age)</p>
						<strong>Address</strong>
						<p class="pl-2">$r->hadd</p>
__here;

if ($r->active) $active = "Welcome <b>$r->fullname</b>, you can only view and print your result since you are no longer a part of the system!";
else $active = Utils::datetime() . ' <br> ' . $c_ses;
callfile('inc/header', $title)
?>

		<div class="col-12 mt-3">
			<div class="header">
				<?php
				if (session('level') < 3) {
					$admin = "<div>$r->pre. $r->p_name (Parent/Guardian)</div>";
				} else {
					$admin = "";
				}
				echo <<<__here
				<img src="$r->picture" width="50px" height="50px" style="border-radius: 100%">
				<div>
					<b>$r->fullname</b>
					$admin
					<small>$r->class</small>
					<small><i>$r->dept class</i></small>
				</div>
			</div>
__here; 
?>

		<div class="bl mt-4 p-3"><i><?php echo $active ?></i></div>
		</div>

		<?php
		if ($r):
		?>
		<?php
		$d->table('score');
		$sc = $d->get()->where(['a_id', $user])->res();

		// $subject = [];

		$th = $td = $rep = $cur = $trr = $tr = '';

		// all available class to avoid undefined var error!
		$j1 = $j2 = $j3 = $s1 = $s2 = '';

		foreach($sc as $ss) {
				$data = Utils::djson($ss->data, ARR);
				// $data =
				for ($i = 0, $count = count(array_reverse($data)); $i < $count; $i++) {
					$session = $ss->session;
					$th .= "<td>{$data[$i]["subject"]}</td>";
					$td .= "<td>{$data[$i]["score"]}</td>";
				}

				$thh = "<tr><td>Session</td> {$th}</tr>";
				$th = "";
				
				$tr .= "<tr><td> {$session} </td> {$td} </tr>";
				$td = "";

				// listing the results from the current class and previous classes

				if($ss->class == $r->class) {
					// checking if we can display the result for d current session
					
					if (time() <= strtotime($date)) 
						$tr = "<tr><td>$ss->session</td><td colspan='4'>Result for this session is been witheld by the Adminstrator's Department till $date</td></tr>";
					
					$trr .= $tr;
					$cur = <<<__here
					<div class="h4 my-3">$r->class <small>(Current class)</small></div>
					<table class="table table-stripe">
						$thh
						$trr
					</table>
__here;
					$tr = '';
				} else {
					if ($ss->class == 'Jss 1') {
						$trr .= $tr;
						$j1 = <<<__here
						<div class="h4 my-3">$ss->class</div>
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
					} elseif ($ss->class == 'Jss 2') {
						$trr .= $tr;
						$j2 = <<<__here
						<div class="h4 my-3">$ss->class</div>
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
					} elseif ($ss->class == 'Jss 3') {
						$trr .= $tr;
						$j3 = <<<__here
						<div class="h4 my-3">$ss->class</div>
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
					} elseif ($ss->class == 'Sss 1') {
						$trr .= $tr;
						$s1 = <<<__here
						<div class="h4 my-3">$ss->class</div>
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
					} elseif ($ss->class == 'Sss 2') {
						$trr .= $tr;
						$s2 = <<<__here
						<div class="h4 my-3">$ss->class</div>
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

					if ($ss->session == 'Third term') {
						$trr = '';
					}
					$tr = '';

				}
			}
			$report = $cur . $s2 . $s1 . $j3 . $j2 . $j1;
			?>
			<?php
			else:
			$report = '<p>No student match the query!</p>';
			endif;
		?>

		<div class="col-12 mt-5 mx-3">
			<div class="action">
			
				<div class="dashboard">
					<h2>Dashboard</h2>
					<div class="my-4 px-3">
						<?php echo $dash ?>
					</div>
				</div>
				
				<div class="report">
					<div class="job">Print</div>
					<h2 class="no-print">Report</h2>
					<div class="print-item">
						<header>
							<div class="print text-center">
								<h1>DiamondVille</h1>
								<h4>Comprehensive School</h4>
								<h4><?php echo $r->fullname; ?>'s Report</h4>
							</div>
						</header>
						<?php echo $report; ?>
						<style>
							header{
								text-align: center;
							}
							
							h1 {
								color: #5EB73F;
							}
							
							h4, .h4 {
								color: #CA9B09;
							}
							
							tr td:first-child {
								background: #5EB73F;
								color: #fff;
								/* colspan: 3; */
							}
							
							td {
								text-align: center;
							}
							
							table {
								width: 100%;
							}
							
							.my-3 {
								margin: 1rem 0;
							}
						</style>
					</div>
				</div>
				
			</div>
		</div>
		<style>
			.print {
				display: none;
			}
		</style>
<?php
require_once 'inc/footer.php';