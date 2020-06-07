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
		echo $a->error();
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

if ($a->req("profile")) {

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