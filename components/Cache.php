<?php

class Cache   {
	static $loc = __DIR__.'/cache/';
	
	protected static function getUrl () {
		$file = Validate::_hash($_SERVER['SCRIPT_FILENAME'], 32);
		if (!is_dir(self::$loc)) mkdir(self::$loc);
		return self::$loc . $file;
	}
	
	public static function showCache () {
		// rename file
		if (config('cache/cache')) {
			$pfile = self::getUrl();
			if (file_exists($pfile)) {
				if (filemtime($pfile) > time() - config('cache/cacheexp')) {
					echo file_get_contents($pfile);
					die();
				} else {
					unlink($pfile);
				}
			}
		}
		ob_start();
	}
	
	public static function createCache () {
		if (config('cache/cache')) {
			$pages = explode(',',config('cache/pages'));
			$fun = function ($page) {
				$p = trim ($page);
				if (inUri($p) || $p == 'index' || $p == 'home') {
					$buff = ob_get_flush();
					file_put_contents(self::getUrl(), $buff);
				}
			};
			array_map($fun, $pages);
		}
	}
	
	public static function clearCache () {
		Utils::r_delete(self::$loc);
		return;
	}
}