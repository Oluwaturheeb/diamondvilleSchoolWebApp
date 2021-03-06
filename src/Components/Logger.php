<?php
namespace Devtee\Tlyt\Components;

class Logger {
	//option = daily, extended
	// type = info, request, error
	const option = 'daily';
	
	public static function log ($data, $type = 'info') {
		$date = Utils::date();
		// justifying the name
		switch(self::option) {
			case 'daily':
				$opt = $date;
				break;
			case 'extended':
				$opt = 'tlight';
				break;
		}
		
		$rep = [' ', ',', '-'];
		// tlyt root for logging
		$path = ROOT .'log/';
		
		if (!is_dir($path)) mkdir($path);
		$file_name = str_replace($rep, array_fill(0, count($rep), '_'), $opt). '.log';
		self::filelog($path.$file_name, $data);
	}
	
	public static function logReq() {
		if (config('log/log_request')) {
			$s = $_SERVER;
			$type = $s['REQUEST_METHOD'];
			$url = $s['REQUEST_URI'];
			$time = Utils::datetime($s['REQUEST_TIME'], true);
			$ip = $s['REMOTE_ADDR'];
			
			if ($type != 'GET') {
				$input = Utils::json($_POST);
			} elseif (isset($s['QUERY_STRING'])) {
				$input = $s['QUERY_STRING'];
			} else {
				$input = null;
			}
			
			$log = <<<__tlyt
$time\t$ip\t$type\t$url\t$input
__tlyt;
		self::log($log, 'Request');
		}
	}
	
	private static function filelog ($f, $d) {
		$str = <<<__tlight
$d\r\n
__tlight;
	file_put_contents($f, $str, FILE_APPEND);
	}
}