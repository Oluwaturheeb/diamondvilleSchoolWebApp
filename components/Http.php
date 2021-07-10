<?php
class Http {
	public static function req ($r = null, $type = OBJ) {
		if (!empty($_GET))
			$req = self::getGetData();
		elseif (!empty($_POST))
			$req = self::getPostData();
		else
			if (inUri('api')) $req = API::data();
			else $req = false;

		// if (empty(func_get_args())) return $req;
		if (!empty($r) && is_string($r)) return self::getRequest($r, $req);
		elseif ($type == ARR) return Utils::toArr(self::getRequest($r, $req));
		else return Utils::toObj(self::getRequest($r, $req));
		// elseif (is_string($r)) return self::getRequest($r, $req); 

	}

	/** 
	 * This method returns what is requested from the request object
	*/
	private static function getRequest ($str, $data) {
		if (!$data) return;
		if (!$str) return $data;

		if (is_array($str)) {
			$c = [];
			$newReq = [];
			foreach ($str as $key)
				if (array_key_exists($key, $data)) {
					$c[] = 1;
					$newReq[$key] = $data[$key];
				}

			if (count($c) === count($str)) return $newReq;
		} else {
			if (isset($data[$str])) return $data[$str];
		}
		return false;
	}

	private static function getPostData () {
		if (!$_POST) return;

		$req = $_POST;
		$k = array_keys($req);
		$v = array_values($req);
		$s = array_search('__csrf', $k);

		if ($s !== false) {
			array_splice($k, $s, 1);
			array_splice($v, $s, 1);
		}

		if (self::sVar('QUERY_STRING')) {
			$getInPost = self::sVar('QUERY_STRING');
			array_merge(array_keys($getInPost), $k);
			array_merge(array_values($getInPost), $v);
		}
		
		return Validate::filter(array_combine($k, $v));
	}

	private static function getGetData () {
		return Validate::filter($_GET);
	}
	
	public static function res ($data = 'ok', int $status = 200) {
		if (is_array($data)) {
			$k = array_keys($data); $v = array_values($data);
			$s = array_search('status', $k);
			if ($s !== false) {
				array_splice($k, $s, 1);
				array_splice($v, $s, 1);
				$data = array_combine($k, $v);
			}
		} else {
			$data = ['code' => 1, 'msg' => $data];
		}
		
		switch ($status) {
			case 200:
				header('HTTP/1.1 200 OK');
			break;
			case 400:
				header('HTTP/1.1 Invalid request');
			break;
			case 401:
				header('HTTP/1.1 200 Access denied');
			break;
			case 403:
				header('HTTP/1.1 200 Forbidden');
			break;
			case 404:
				header('HTTP/1.1 404 Not found');
			break;
			case 500:
				header('HTTP/1.1 500 Internal Server Error');
			break;
			case 419:
				header('HTTP/1.1 419 Invalid form');
			break;
			case 422:
				header('HTTP/1.1 422 Validation error');
			break;
		}
		header('content-type: application/json');
		die(Utils::json($data));
	}

	public static function is_ajax(){
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
			return true;
		}
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