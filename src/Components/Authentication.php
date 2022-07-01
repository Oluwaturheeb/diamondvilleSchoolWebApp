<?php
namespace Devtee\Tlyt\Components;

class Authentication {
	private $_e;
	public $table;

	public function __construct ($table = 'auth') {
		$this->_e = new Db($table);
		$this->table = $table;
		$this->_e->table($this->table);
	}

	private static function trackLogin () {
		if (!session('trackLogin')) session('trackLogin', 0);

		if (session('trackLogin') >= config('auth/login_attempts')) {
			if (!session('trackLogin2')) sleep(5);

			if (session('trackLogin2') >= config('auth/login_attempts')) {
				if (!session('trackLogin3')) sleep(10);

				if (session('trackLogin3') >= config('auth/login_attempts')) {
					sleep(60);
					res(['code' => 0, 'error' => 'Too many login attempts!']);
				} else session('trackLogin3', session('trackLogin3') + 1);
			} else session('trackLogin2', session('trackLogin2') +1);
		} else session('trackLogin', session('trackLogin') +1);
	}

	public function login (mixed $col = 'email', string $password = 'password', bool $remember = false, string $lastActiveColumn = '') {
		// login protection
		$this->trackLogin();
		// default msg
		$res = ['code' => 0, 'msg' => 'Credentials does not match any account!'];

		$d = $this->_e->get();
		if (is_array($col)) $d->orWhereManyToOne($col, req()->$col[0]);
		else $d->where([$col, req()->$col]);

		$log = $d->res();

		if ($d->count()) {
			foreach ($log as $k) {
				if  ($k->$password) {
					if (password_verify(req()->$password, $k->$password)) {
						session('auth', $k);
						session('authId', $k->id);
						if ($lastActiveColumn)
							$this->updateLogin(session('authId'), $lastActiveColumn);

						if ($remember)
							setCookies('authId', session('auth')->id, $remember);

						$res = ['code' => 1, 'msg' => 'You are logged!'];
						break;
					}
				}
			}
		}

		return (object) $res;
	}

	public function reg (string $password = 'password', array $append = [],  bool $login = true) {
		// merge the new password append param if available
		(count($append)) ? $key = array_merge($append[0], [$password]) : 	$key = [$password]; // key/column
    (count($append)) ? $val = array_merge($append[1], [self::password(req()->$password)]) : $val = [self::password(req()->$password)];
		$c = new Crud($this->table);
		$id = $c->create()->remove([$password, '__csrf'])->append($key, $val)->exec();

		if (!$c->count() && $c->error()) {
			return ['msg' => 'There is an account with that email address!', 'code' => 0];
		} else {
			if ($login == true) {
				$log = $this->_e->get()->where($id)->res(1);
				session('auth', $log);
				session('authId', $log->id);
			}
			return ['code' => 1, 'msg' => 'Registration completed!'];
		}
	}

	/**
	 * Supply both field names in an array
	 * db field name and verify field name
	 * provide the email to change its password or the id of the account
	*/
	public function chpwd (array $field = [], $email = '', $compare = true) {
		// $this->trackLogin();
		$msg = ['code' => 0, 'msg' => 'Invalid password supplied!'];
		if ($compare) {
			if (count($field) !== 2) return $msg;
			else {
				$v = new Validate();$v->validator([
					$field[0] => ['match' => $field[1]]
				]);

				if ($v->error()) return ['code' => 0, 'msg' => $v->error()];
			}
		}


		$c = new Crud($this->table);
		$c->update()->remove();

		if (count($field) == 1) $c->append($field, [req($field[0])]);
		else $c->append([$field[0]], [$this->password(req($field[0]))]);

		$c->where($email)->exec();

		return ['code' => 1, 'msg' => 'Password updated successfully!'];
	}

	public function lpass ($path = '') {
		$this->trackLogin();
		$c = new Crud($this->table);
		$user = $c->fetch()->exec();

		if ($c->error() || !$c->count()) {
			res(['code' => 0, 'msg' => 'Email does not match any account, try again!']);
		} else {
			// No verification
			if (!$path) {
				res(['code' => 1, 'msg' => 'Account found!']);
			} else {
				// send email with Xender+++
				$m = (new Xender())->sendTo(req('email'))->sub('Password recovery')->desc('Password recovery')->send($path, config('mail/from'));

				if ($m) res(['code' => 1, 'msg' => 'Email has been sent!']);
				else res(['code' => 0, 'msg' => 'Unknown error, contact administrator']);
			}
		}
	}

	public static function authId() {
		return session('authId');
	}

	public static function auth($data = '') {
		if ($data)
			return (isset(session('auth')->$data) ? session('auth')->$data : false);
		else
			return session('auth');
	}

	private static function password ($password) {
		if (config('auth/password_type') === 'default') return Validate::hash($password);
		else return config('auth/password_type')($password);
	}

	private function updateLogin ($id, $col = 'last_log') {
		$this->_e->set([$col], [date('Y-m-d H:i:s', time())])->where($id)->res();
	}

	public function activeLogin () {
		if (!authId()) {
			if ($active = getCookie('authId')) {
				$this->_log = $this->_e->get()->where($active)->res(1);
				if ($this->_e->count()) {
					Session::set('auth', $this->_log);
					Session::set('authId', $this->_log->id);
					$this->updateLogin(authId());
				}
			}
		}
	}
}
