<?php
namespace Devtee\Tlyt\Components;

class PageCache{
	static $loc = __DIR__.'/cache/';
	
	protected static function getCachedFile () {
		$file = Validate::_hash($_SERVER['REQUEST_URI'], 24);
		if (!is_dir(self::$loc)) mkdir(self::$loc);
		return self::$loc . $file;
	}
	
	public static function showCache (): void {
		if (!config('cache/enabled')) return;
		$pfile = self::getCachedFile(); // we dont need to check if url match if file exists
		if (file_exists($pfile)) {
			$hourToDeleteCache = time() - (60 * 60 * config('cache/cacheexp')); 
			if (filemtime($pfile) > $hourToDeleteCache) {
				echo file_get_contents($pfile);
				die();
			} else {
				unlink($pfile);
			}
		}
		ob_start();
	}
	
	public static function createCache (): void {
		if (! config('cache/enabled')) return;
		// cache creator
		$createCache = (function () {
			if (ob_get_contents()) file_put_contents(self::getCachedFile(), ob_get_flush());
		})();

		$fun = function ($page) {
			$p = trim ($page);
			if ($_SERVER['REQUEST_URI'] == '/' || $page == 'index') global $createCache;
			elseif (inUri($p)) $createCache;
		};
		$pages = explode(',',config('cache/pages'));
		
		// check if there is any user specified pages cache
		if ($pages) array_map($fun, $pages);
		else $createCache; // else just cache all
	}
	
	public static function clearCache (): void {
		Utils::r_delete(self::$loc);
	}
}