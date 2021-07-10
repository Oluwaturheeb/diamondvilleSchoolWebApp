<?php

function csrf ($c = false) {
	echo Validate::csrf($c);
}

function assets ($loc) {
	return 'assets/'. $loc;
}

function authId () {
	return Auth::authId();
}

function auth ($data = null) {
	return Auth::auth($data);
}

function authCheck ($loc = '') {
	if (!authId())
		if (!$loc)
			goBack();
		else
			redirect($loc);
	
}

function res ($data = '', $status = 200) {
	return Http::res($data, $status);
}

function req ($data = '', $c = '') {
	return Http::req($data, $c);
}

function redirect ($to = '/') {
	header('location: '. $to);
	die();
}

function goBack() {
	if (isset($_SERVER['HTTP_REFERER']))
		redirect($_SERVER['HTTP_REFERER']);
	else
		redirect();
}

function config ($data) {
	return Config::get($data);
}

function session ($data = '', $set = '', $c = false) {
	if (!$data) {
		return Session::get();
	} else {
		if (!$set) {
			return Session::get($data);
		} else {
			if (!$c) {
				Session::set($data, $set);
			} else {
				Session::set($data, $set, $c);
			}
		}
	}
}

function redirectLogin () {
	if (!empty(authId()))
		if (stripos($_SERVER['SCRIPT_NAME'], 'login'))
			goBack();
}

function error($msg = '', $info = 'Internal server error!', $status = 500) {
	ob_end_clean();

	if (Http::is_ajax()) res(['code' => 0, 'msg' => $msg], $status);
	(config('error/page') == 'default') ? $file = 'template/error/error' : $file = config('error/page');
	
	callfile($file, ['code' => $status, 'info' => $info, 'msg' => $msg]);
	die();
}

function getCookie ($name = '') {
	return Session::getCookie($name);
}

function setCookies ($name, $val, $c = true) {
	Session::setCookie($name, $val, $c);
}

function callfile ($file, $text = '') {
	$title = $text;
	if (stripos($file, '.') != 0) {
		require_once $file;
	} else {
		require_once $file . '.php';
	}
}

function logtext ($logText, $type = 'info') {
	Logger::log($logText, $type);
}

function isAjax () {
	return Http::is_ajax();
}

function addViews ($table, $view, $to, $col = 'views') {
	$d = new Db();
	$d->table($table)->set([$col], [$view + 1])->where($to)->res();
}

function inUri($str) {
	if (stripos($_SERVER['REQUEST_URI'], $str)) return true; else  return false;
}

function appConfig ($data = '') {
	
	if (session('appConfig')) {
		get:
		if ($data) {
			foreach (session('appConfig') as $c) {
				if ($data == $c->option_name) {
					return $c->option_value;
					break;
				}
			}
			return '';
		} else {
			return session('appConfig');
		}
	} else {
		$d = Db::instance();
		$app = $d->table(config('project/config'))->get()->res();
		session('appConfig', $app);
		goto get;
	}
}

function uuid($l = 20) {
	if (!is_numeric($l)) error('The uuid function requires an integer parameter');
	return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-', $l)), 1, $l);
}

function sendMail ($subject, $to, $from, $template) {
	if (!isset($subject, $to, $from, $template)) error('Missing parameter!', 'sendMail error!', 500);
	$m = (new Xender())->sub($subject)->sendTo($to)->send($template, $from);

	if ($m) return true; else return false;
}