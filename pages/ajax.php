<?php
require_once "Autoload.php";

$a = new Auth();
$e = new Easy();
$d = Db::instance();
$u = new Utils;

function response ($data = "ok") {
	if (is_array($data)) {
		echo json_encode($data);
	} else {
		echo Utils::json(["msg" => $data]);
	}
}

function attendance ($id) {
	global $e, $a;
	$e->table("subject");
	$sub = $e->fetch(["subject"], ["dept", $a->fetch("dept")])->exec(1);

	if (!is_array($id)) {
		foreach (explode(", ", $sub->subject) as $s) {
			$e->table("attendance");
			$e->add(["subject", "a_id", "session"], [$s, $id, Session::get("session")])->exec();
		}
	} else {
		foreach ($id as $value) {
			foreach (explode(", ", $sub->subject) as $s) {
				$e->table("attendance");
				$e->add(["subject", "a_id", "session"], [$s, $value, Session::get("session")])->exec();
			}
		}
	}

	
}

if (!empty($_POST)) {
	switch (@$a->req()["type"]) {
		case "login":
			$res = $a->login()->set();
			
			if (@$res['type']) {
				if ($res["type"] < 3) {
					Session::set("level", $res["type"]);
					$res["type"] = "/admin";
				} else if ($res["type"] == 3) {
					Session::set("level", $res["type"]);
					$res["type"] = "/student";
				} else {
					$res["type"] = "home";
				}
			}
			response($res);
			break;
		case "register":
			response($a->reg(["email", "password"])->set());
			break;
		case "chpwd":
			response($a->chpwd());
			break;
		case "lpwd":
			response($a->lpass());
			break;
	}

	// adding teachers and students from admin view;

	if (@$a->req()["create"]) {
		$a->val_req();
		if ($a->error()) {
			response($a->error());
		} else {
			if ($a->req()["create"] == "teacher") {
				$type = 2;
				$password = "default000";
			} else {
				$password = substr($a->hash($u->gen(true)),  0, 8);
				$type = 3;
			}
			
			$d->table("auth");
			$id = $d->add(
				["email", "password", "type"], 
				[$a->fetch("email"), $a->hash($password), $type])
				->res();

			if ($d->error()) {
				response("There is an account with provided email address");
			} else {
				$e->table($a->req("create"));
				$e->create()->with("remove", ["email", "create"])->with("append", ["age", "a_id"], [$u->age($a->fetch("dob")), $id]);

				if ($a->req("create") == "student") {
					$e->with("append", ["pin"], [$password]);
				} else {
					$e->with("remove", ["subject", "class"]);
					$e->with("append", 
						["subject", "class"], 
						[$u->arr2str($a->req()["subject"]), $u->arr2str($a->req()["class"])]);
				}
				$e->exec();
				if ($e->error()) {
					response($e->error());
				} else {
					if ($a->req("create") == "student") {
						attendance();
					}
					response();
				}
			}
		}
	}

	if (@$a->req()['type'] == "add-subject") {
		$e->table("subject");

		$e->create()->with("remove", ["type"])->exec();

		if ($e->error()) {
			response("Subject has already been created for this class");
		} else {
			response();
		}
	}

	if ($a->req("type") == "exam") {
		$a->val_req();
		if ($a->error()) {
			response($a->error());
		} else {
			$e->table($a->req("type"));
			$un = $e->unique(["subject", "class"]);
			
			// changing values
			$opt = [
				$u->arr2str($a->req("question"), "___"),
				$u->arr2str($a->req("answer"), "___"),
				$u->arr2str($a->req('opt_a'), "___"),
				$u->arr2str($a->req('opt_b'), "___"),
				$u->arr2str($a->req('opt_c'), "___"),
				$u->arr2str($a->req('opt_d'), "___"),
			];

			if (!$un) {
				// insert
				
				$e->create()
				->with("remove", ["type", "question", "answer", "opt_a", "opt_b", "opt_c", "opt_d"])
				->with("append", ["question", "answer", "opt_a", "opt_b", "opt_c", "opt_d"], $opt)->exec();
			} else {
				// update
				$e->update()
				->with("remove", ["type", "question", "answer", "opt_a", "opt_b", "opt_c", "opt_d"])
				->with("append", ["question", "answer", "opt_a", "opt_b", "opt_c", "opt_d"], $opt);
			}
			if($e->error())
				response($e->error());
			else
				response() ;
		}
	}

	// submitting exam

	if ($a->req("type") == "exam-submit") {
		// getting all available sessions
		$cls = Session::get("class");
		$sub = Session::get("subject");
		$ses = Session::get("session");
		$user = Session::get("user");

		// getting answer from exam table
		$d->table("exam");
		$ans = $d->get(["answer"])
		->where(["class", $cls], ["subject", $sub])
		->res(1);
		$ans = explode("___", $ans->answer);
		$exam = $a->req("exam-ans");

		// check against the supplied answer
		$sc = count($ans) - count(array_diff_assoc($ans, $exam));
		$sc .= " / " . count($ans);
		
		//getting student data from score table
		$d->table("score");
		$sq = $d->get(['data'])
		->concat(["and", "and"])
		->where(
			["a_id", $user],
			["session", $ses],
			["class", $cls]
		)
		->res(1);

		$data = ["subject" => $sub, "score" => $sc];

		if ($d->count()) {
			// this means update
			$score = $u->djson($sq->data);
			$score[] = $data;
			$data = $u->json($score);
			$d->set(["data"], [$data])
			->concat(["and", "and"])
			->where(
				["a_id", $user],
				["session", $ses],
				["class", $cls]
			)->res();
		} else {
			// this means creating a new data;
			$data = $u->json([$data]);
			$d->add(["data", "a_id", "session", "class"], [$data, $user, $ses, $cls])->res();
		}

		if (!$d->count()) {
			response($d->error());
		} else {
			response();
		}
	}

	if ($a->req("profile")) {
		$e->table([$a->req("acc"), "auth"]);
		$r = $e->rfetch(
			["concat(first, ' ', last) as name", "email", "dob", "age", "hadd", "picture", "pre", "phone"],
			[["a_id", "auth.id"]]
			)
			->with("remove")
			->with("append", ["a_id"], [$a->fetch("profile")])
			->exec(1);

		$dob = explode(" ", $r->dob)[0];
		$res = <<<__here
		<div class="header">
			<img src="$r->picture" alt="$r->name" class="img-thumbnail">
			<div>
				<b>$r->pre. $r->name</b>
				<div class="icon">
					<a href="mailto:$r->email"><img src="assets/img/email.png"></a>
					<a href="tel:$r->phone"><img src="assets/img/phone.svg"></a>
				</div>
				<div>$r->email</div>
				<div>$dob ($r->age)</div>
				<div>$r->hadd</div>
			</div>
		</div>
	__here;

		response(["msg" => "ok", "payload" => $res]);
	}

	// other side

	if ($a->req("type") == "session" || $a->req("type") == "exams" || $a->req("type") == "result") {
		$e->table("event");
		$unique = $e->unique("type");

		if (!$unique) {
			$e->create()->exec();
		} else {
			$e->update()->with("use", ["type"])->with("remove", ["type"])->exec();
		}

		if ($e->error()) {
			response($e->error());
		} else {
			response();
		}

		// updating session for attendance
		if ($a->req("type") == "session") {
			$e->table("attendance");
			$e->set(["session", "sit"], [$a->fetch("content"), 0])->exec();
		}
	}

	if ($a->req("type") == "delete-event") {
		$e->table("event");

		$e->del()->with("remove", ["type"])->exec();

		if ($e->count()) {
			response();
		} else {
			response($e->error());
		}
	}

	if ($a->req("type") == "score") {
		$a->val_req();

		if ($a->error()) {
			response($a->error());
		} else {
			$e->table("student");

			$ss = $e->fetch(
				["concat(first, ' ', last) as name", "student.a_id"]
			)
			->with("remove", ["type"])
			->sort("name")
			->exec();

			if (!$e->count()) {
				response("No result found for ". $a->fetch("class"));
			} else {
				$rep = "";
				foreach ($ss as $s) {
					$e->table("score");
					$sc = $e->fetch(["data", "session"])
					->with("remove", ["type", "dept"])
					->with("append", ["a_id"], [$s->a_id])
					->exec();
					// student name
					$name = $s->name;

					// initiallizing variables needed in the loop
					$th = $td = $tr = "";

					if ($e->count() == 0) {
						$rep .= "<div class='h3 my-3'><a href='student/$s->a_id'>$name</a></div><table><tr><td colspan='5'>There is no report found for $s->name in this class!</td></tr></table>";
					} else {
						// looping through the score data!;
						foreach ($sc as $key) {
							$data = Utils::djson($key->data);
							for ($i = 0, $count = count($data); $i < $count; $i++) {
								$session = $key->session;
								$th .= "<th>{$data[$i]["subject"]}</th>";
								$td .= "<td>{$data[$i]["score"]}</td>";
							}

							$thh = "<thead><th>Session</th> {$th}</thead>";
							$th = "";
							
							$tr .= "<tr><td> {$session} </td> {$td} </tr>";
							$td = "";
						}
						$rep .= <<<__here
						<div class="h3 my-3"><a href="student/$s->a_id">$name</a></div>
						<table class="table table-stripe">
							<thead>
								$thh
							<tbody>
								$tr
							</tbody>
						</table>
__here;
					}
				}
				response(["msg" => "ok", "data" => $rep]);
			}
		}
	}

	if ($a->req("action")) {
		$req = $a->req("action");

		$fn = function ($int) {
			if (!is_numeric($int)) {
				return "error";
			} else {
				return $int;
			}
		};

		$id = array_map($fn, $a->fetch("a_id"));

		if (in_array("error", $id)) {
			// return error;
			response("Unknown error occurred, try again!");
		} else {
			$id = implode(", ", $a->fetch("a_id"));

			if ($req == "Promote") {
				// promotion
				$cls = $a->fetch("class");
				$d = $a->fetch("dept");

				$e->customQuery("update student set class = '$cls', dept = '$d' where a_id in ($id)")
				->res();
				
				// delete all attendance since it wont be needed in both cases of promote and remove!

				$e->customQuery("delete from attendance where a_id in ($id)")->res();
				if (!$e->count()) {
					response("Unknown error occurred, try again!");
				} else {
					attendance($a->fetch("a_id"));
					response();
				}
			} elseif ($req == "Remove") {
				// removing 

				$e->customQuery("update student set active = '1' where a_id in ($id)")
				->res();

				if (!$e->count()) {
					response("Unknown error occurred, try again!");
				} else {
					response();
				}
			}
		}
	}

	// sending notty 

	if ($a->req("selected")) {
		$a->val_req();

		if ($a->error()) {
			response($a->error());
		} else {
			$e->table("auth");
			switch ($a->fetch("selected")) {
				case 'All':
					$e->get(["email"]);
					break;
				case 'Students':
					$e->fetch(["email"])->with("remove")->with("append", ["type"], [3]);
					break;
				case 'Teachers':
					$e->fetch(["email"])->with("remove")->with("append", ["type"], [2]);
					break;
				default:
					$e->fetch(["email"])->with("remove", ["notty"]);
					break;
			}
			$emails = $e->exec();
			$email = "";
			foreach ($emails as $value) {
				$email .= " " . $value->email;
			}
			response(["msg" => "ok", "data" => "All email have been gotten but send the msfg require an email libary to be added to this project! $email"]);
		}
	}
}


if ($_FILES) {
	$v = new Validate();
	
	$v->val_req(["number" => true]);

	if (!$v->pass()) {
		response($v->error());
	} else {
		if (isset($_POST["student"])) {
			$tab = "student";
		} else {
			$tab = "teacher";
		}

		$img = $v->uploader("img")->complete_upload("assets/img/{$tab}/");

		$e->table($tab);
		$e->set(["picture"], [$img])
		->where(["a_id", $v->fetch($tab)])
		->res();

		if ($e->count())
			response();
		else
			response($e->error());
	}
}