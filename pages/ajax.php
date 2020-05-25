<?php
require_once "Autoload.php";

$a = new Auth();

switch ($a->req()["type"]) {
	case "login":
	 	$res = $a->login()->set();
	 	//checking for multiple login sys
		if(Config::get("auth/single")) {
			echo $res;
		}else {
			// here i use number to denote priviledge / acc type and string to determine where js is going to redirect to
			if (is_numeric($res)) {
				Session::set("level", $res);
				if ($res <= 2) {
					$res = "admin";
				} elseif ($res == 3) {
					$res = "student";
				}
				echo "ok $res";
			} else {
				echo $res;
			}
		}
		
		break;
	case "register":
		echo $a->reg(["email", "password"])->set();
		break;
	case "chpwd":
		echo $a->chpwd();
		break;
	case "lpwd":
		echo $a->lpass();
		break;
}