<?php
namespace Devtee\Tlyt\Components;

class Http {

	public static function jsonResponse ($data = 'ok', int $status = 200) {
		self::responseStatus($status);
		header('content-type: application/json');
		die(Utils::json($data));
	}

	public static function responseStatus ($status, bool $text = false) {
		switch ($status) {
			case 200:
				$header = 'HTTP/1.1 200 OK';
			break;
			case 400:
				$header = 'HTTP/1.1 Invalid request';
			break;
			case 401:
				$header = 'HTTP/1.1 200 Access denied';
			break;
			case 403:
				$header = 'HTTP/1.1 200 Forbidden';
			break;
			case 404:
				$header = 'HTTP/1.1 404 Not found';
			break;
			case 500:
				$header = 'HTTP/1.1 500 Internal Server Error';
			break;
			case 419:
				$header = 'HTTP/1.1 419 Invalid form';
			break;
			case 422:
				$header = 'HTTP/1.1 422 Validation error';
			break;
			default:
				$header = 'HTTP/1.1 200 OK';
		}
		if ($text) return $header;
		else header($header);
	}

	public static function is_ajax(){
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']))return true;
		return false;
	}

	public static function sVar ($value) {
		if (isset($_SERVER[$value])) return $_SERVER[$value];
	}

	public static function frameView () {
		if (!config('project/iframeView')) {
			if (self::sVar('HTTP_REFERER')) {
				if (!stristr(self::sVar('HTTP_REFERER'), HOST))
					if (!inUri('api'))
						return self::sVar('HTTP_REFERER');
			}
		}
		return false;
	}

	public static function sameSite() {
		if (self::sVar('HTTP_ORIGIN')) {
			if (HOST !== self::sVar('HTTP_ORIGIN'))
				if (!inUri('api'))
					return self::sVar('HTTP_ORIGIN');
		}
		return false;
	}
}
