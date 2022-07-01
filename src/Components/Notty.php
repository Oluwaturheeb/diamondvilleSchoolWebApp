<?php
namespace Devtee\Tlyt\Components;

class Notty {
	public $db, $msg = null, $to = null, $error;

	public function __construct($table = '') {
		$this->db = Db::instance();
		if (!$table) $table = 'notty';
		$this->db->table($table);

	}

	public function init($table = '') {
		if (!$table) $table = $this->table;
		$sql = "create table if not exists $table(id int auto_increment, from_user int, to_user int, time datetime default now(), msg text not null, flag int default 0, primary key(id))";
		$this->_db->customQuery($sql)->res();
		return true;
	}

	public function msg ($msg) {
		$this->msg = $msg;
		return $this;
	}

	public function to ($to, $user = '') {
		if (!$user) $user = AUTHID;
		$d = Db::instance();
		$d->add(['msg', 'to_user', 'from_user'], [$this->_msg, $to, $user]);
		return $this;
	}

	public function get ($user = '', $userTable = 'user') {
		if (!$user) $user = AUTHID;

		$d = $this->_db;
		$d->get();
		if ($userTable) $d->join($userTable, ['id', 'from_user']);
		$d->where(['to_user', $user]);
		return $this;
	}

	public function setReadFlag (int $notty, $user = '') {
		$d = Db::instance();
		$d->set(['flag'], [1])->where($notty);

		if ($user) $this->db->where(['to_user', $notty]);
		return $this;
	}

	public function setUnreadFlag (int $notty, $user = '') {
		$d = Db::instance();
		$d->set(['flag'], [0])->where($notty);

		if ($user) $this->db->where(['to_user', $notty]);
		return $this;
	}

	public function allAsRead ($user = '') {
		if (!$user) $user = AUTHID;
		$this->db->set(["flag"], [1])->where(['to_user', $user]);
		return $this;
	}

	public function allAsUnread ($user = '') {
		if (!$user) $user = AUTHID;
		$this->db->set(["flag"], [0])->where(['to_user', $user]);
		return $this;
	}

	public function delete($id, $user) {
		if (!$user) $user = AUTHID;
		$this->db->del();

		if (isset($id)) $this->db->where($id);
		else if (isset($user)) $this->db->where(['to_user', $user]);
		return $this;

	}

	public function exec () {
		$this->db->res();
			if (!$this->db->error()) return $this;
			else return false;
	}

	public function error() {
		return $this->db->error();
	}
}