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
	if ($a->req()["create"] == "teacher") {
		$type = 2;
		$password = "default000";
	} else {
		$password = substr($a->hash($u->gen(true)),  0, 8);
		$type = 3;
	}
	$d->table("auth");
	$id = $d->add(["email", "password", "type"], [$a->fetch("email"), $e->hash($password), $type])->res();

	if ($d->error()) {
		response("There is an account with provided email address");
	} else {
		$e->table($e->req()["create"]);
		$e->create()->with("remove", ["email", "create"])->with("append", ["age", "a_id"], [$u->age($a->fetch("dob")), $id]);

		if ($e->req()["create"] == "student") {
			$e->with("append", ["pin"], [$password]);
		} else {
			$e->with("remove", ["subject", "class"]);
			$e->with("append", ["subject", "class"], [$u->arr2str($e->req()["subject"]), $u->arr2str($e->req()["class"])]);
		}
		$e->exec();

		if ($e->error()) {
			response($e->error());
		} else {
			response();
		}
	}
}

if (@$a->req()['type'] == "add-subject") {
	$e->table("subject");

	$e->create()->with("remove", ["type"])->exec();

	if ($e->error()) {
		response("Subject has already been crated for this class");
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
	$d->table("exam");

	// getting all available sessions
	$cls = Session::get("class");
	$sub = Session::get("subject");
	$ses = Session::get("session");
	$user = Session::get("user");

	// getting answer from db
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
	)
	->res(1);

	$data = ["subject" => $sub, "score" => $sc];

	if ($d->count()) {
		// this means update
		$score = $u->djson($sq->data);
		$score[] = $data;
		$data = $u->json($score);
		$d->set(["data"], [$data])
		->where(
			["a_id", $user],
			["session", $ses],
		)->res();
	} else {
		// this means creating a new data;
		$data = $u->json([$data]);
		$d->add(["data", "a_id", "subject", "session", "class"], [$data, $user, $sub, $ses, $cls])->res();
	}

	if (!$d->count()) {
		response($d->error());
	} else {
		response();
	}
}

if ($a->req("profile")) {
	$e->table($a->req("acc"));

	$r = $e->fetch()->with("remove", ['acc'])->with("change", ["a_id"])->exec(1);
	$dob = explode(" ", $r->dob)[0];
	$res = <<<__here
	<div class="header">
		<img src="$r->picture" alt="$r->first" class="img-thumbnail">
		<div>
			<b>$r->pre. $r->first $r->last</b>
			<div>Someone@mail.com</div>
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