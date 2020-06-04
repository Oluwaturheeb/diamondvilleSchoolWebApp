<?php
require_once "Autoload.php";

$a = new Auth();
$e = new Easy();
$d = Db::instance();

function response ($data) {
	if (is_array($data)) {
		echo json_encode($data);
	} else {
		echo Utils::json(["msg" => $data]);
	}
}

switch (@$a->req()["type"]) {
	case "login":
		$res = $a->login()->set();
		
		if (@$res["type"] < 3) {
			Session::set("level", $res["type"]);
			$res["type"] = "/admin";
		} else if (@$res["type"] == 3) {
			Session::set("level", $res["type"]);
			$res["type"] = "/dashboard";
		} else {
			$res["type"] = "home";
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
		$password = substr($a->hash(Utils::gen(true)),  0, 8);
		$type = 3;
	}
	$d->table("auth");
	$id = $d->add(["email", "password", "type"], [$a->fetch("email"), $e->hash($password), $type])->res();

	if ($d->error()) {
		response("There is an account with provided email address");
	} else {
		$e->table($e->req()["create"]);
		$e->create()->with("remove", ["email", "create"])->with("append", ["age", "a_id"], [Utils::age($a->fetch("dob")), $id]);

		if ($e->req()["create"] == "student") {
			$e->with("append", ["pin"], [$password]);
		} else {
			$e->with("remove", ["subject", "class"]);
			$e->with("append", ["subject", "class"], [Utils::arr2str($e->req()["subject"]), Utils::arr2str($e->req()["class"])]);
		}
		$e->exec();

		if ($e->error()) {
			response($e->error());
		} else {
			response("ok");
		}
	}
}

if (@$a->req()['type'] == "add-subject") {
	$e->table("subject");

	$e->create()->with("remove", ["type"])->exec();

	if ($e->error()) {
		response("Subject has already been crrated for this class");
	} else {
		response("ok");
	}
}

if (@$a->req()["type"] == "score") {
	$e->table($a->fetch("type"));
	$e->fetch()->exec();
	print_r($e);
}