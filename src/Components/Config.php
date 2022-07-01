<?php
namespace Devtee\Tlyt\Components;

class Config {
	public static function get($path){
		$config = ROOT.'config';
		if (file_exists($config))
		  $configArray = self::parseConfigFile($config);
		else error('Can not find the config file for this app');
	
		$path = explode('/', $path);
		foreach ($path as $val) {
			if(isset($configArray[$val])){
				$configArray = $configArray[$val];
			}else{
				$configArray = false;
			}
		}
		return $configArray;
	}
	
	private static function parseConfigFile ($configFile) {
	  return parse_ini_file($configFile, 1, INI_SCANNER_TYPED);
	}
	
	public static function init() {
		if (self::get('db/configArraybase') != 'tlight') {
			$d = new \mysqli(self::get('db/host'), self::get('db/usr'), self::get('db/pwd'));
			$db = self::get('db/configArraybase');
			if ($d->query('create configArraybase if not exists $db') === true) {
				$d->select_db(self::get('db/configArraybase'));
	
				$auth = 'create table if not exists auth(id int auto_increment, email varchar(150) not null, password varchar(64) not null, last_log datetime, last_pc datetime default now()';
				
				if (!self::get('auth/single')) {
					$auth .= ', type varchar(50) null';
				}
	
				$auth .= ', primary key(id), unique(email))';
				$d->query($auth);
				if (!$d->error)
					return true;
			}
		}
		return false;
	}
}