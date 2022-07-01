<?php
namespace Devtee\Tlyt\Components;

class User{
	private $table = 'user';
	
	public static function fromDb (mixed $id, string $table = 'user') {
		return (new Db($table))->get()->where($id)->res(1);
	}
	
	public static function fromSess($name) {
	  return Session::get($name);
	}
}
