<?php

class User extends Db {
	public $table = 'ad_user', $auth = 'id', $img = 'picture';
	
	// c is telling this method not use session but rather to use the supplied id to get user data
	
	public static function getProfile ($id, $table = 'user') {
		return (new Db())->table($table)->get()->where($id)->res(1);
	}

	public static function updateUser ($key, $val) {
		AUTH->$key = $val;
	}
}