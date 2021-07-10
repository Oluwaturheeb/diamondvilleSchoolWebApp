<?php

class Crud extends Db {
	protected $_method, $_cols = '', $_input = [], $_value = [];
	
	public function __construct ($tab = null) {
		parent::__construct();
		if (!req()) error('No request object in this context!', 'Crud error', 500);
		$r = Utils::toArr(req());
		$this->_value = array_values($r);
		$this->_input = array_keys($r);
		$this->table($tab);
	}

	public function unique ($key) {
		$key = (array) $key;
		foreach($key as $v) {
			$keys[] = [$v, req($v)];
		}
		$this->get(['id'])->where($keys, true)->res();

		if ($this->count()) return true;
		
		return;
	}

	public function create () {
		if (!$this->error()){
			// if the validationRule has not been called
			if (!$this->_input) return;
			$this->add($this->_input, $this->_value);
			$this->_method = 'create';
		}
		return $this;
	}

	/*	FETCH	*/


	/*
	the default selection is to select all from the given table!

	but this can be overridden by specifying the columns to select


	This also doesnt take any argument except only if the form or the url that holds the input doesn't not match with the keys of the url or names of the form.

	example

	db column is user but the url holds id=10
	so for this reason it should be specified as in the normal where for the db class e.g ["user", "=", 10];

	and this method can only take only 2 arrays for "where", same thing for the url!

	for example
	** url
	id=1&user=10 by default and will be used to join it e.g where id=1 and user=10

	*/
	// review later for concat
	public function fetch (...$cols) {
		if(!$this->_input) $this->_error = 'No request in this context';;
		if ($this->_error) return $this;
		
		if ($this->_method) $cols = $cols[0];
		
		if ($cols) $this->get($this->_cols = $cols);
		else $this->get();

		//checking to remove more as its reserved for pagination, so that it wont b used for where clause;
		if ($this->_input) {
			$key = array_search('page', $this->_input);
	
			if ($key !== false) {
				array_splice($this->_input, $key);
				array_splice($this->_value, $key);
			}
			$wia = $this->with_supp($this->_input, $this->_value);
			$this->where($wia, true);
		}
		// pass true arg to use orWhere if there is request
		
		$this->_method = 'fetch';
		return $this;
	}
	
	/*	UPDATE	*/
	
	/*
	
	this method collect the data to be updated in the request method
	
	*/
	public function update (...$where) {
		if (!$_POST)  $this->_error = 'Update is via POST method only!';
		if (!$this->_input) $this->_error = 'No request in this context';
		if ($this->error()) return $this;
			
		$this->set($this->_input, $this->_value);
		$this->_method = 'update';
		if ($where) $this->where($this->_value = $where, true);
		return $this;
	}

	public function delete ($c = false) {
		if ($this->error()) return $this;

		$this->rm();
		if ($c) $this->orWhere($this->with_supp($this->_input, $this->_value), true);
		else $this->where($this->with_supp($this->_input, $this->_value), true);
		
		$this->_method = 'delete';
		return $this;
	}

	public function append(...$var) {
		if (count($var) < 2) error ('Parameter count does not match for append method');

		if (count($var) == 2) list($col, $val) = $var;
		else list($col, $eq, $val) = $var;

		if (is_numeric($val))
			$val = [$val];

		if (count($this->_input) && isset($eq)) {
			if (count($eq) == 1) {
				$eq = [1 => $eq[0]];
			}  elseif (count($eq) > 1) {
				$e = []; $i = -1;
				foreach ($eq as $key) {
					$e[] = ['i' => count($col) + $i, 'aa' => $key];$i++;
				}
				$eq = array_column($e, 'aa', 'i');
			}
		}

		$this->_input = array_merge($this->_input, $col);
		$this->_value = array_merge($this->_value, $val);
		$this->methodCall($this->_method);
		return $this;
	}

	public function remove (array $var = []) {
		if (!$var) {
			$this->_input = $this->_value = [];
		} else {
			foreach($var as $k) {
				$key = array_search($k, $this->_input);
				if ($key !== false) {
					unset($this->_input[$key]);
					unset($this->_value[$key]);
				}
			}
		}
		$this->methodCall($this->_method);
		return $this;
	}

	public function with ($type, ...$var) {
		if ($this->error()) return $this;
		$eq = null;
		switch ($type) {
			case 'append':
			if (count($var) == 2)
				list($col, $val) = $var;
			else
				@list($col, $eq, $val) = $var;

				if (is_numeric($val))
					$val = [$val];

				if (count($this->_input) && isset($eq)) {
					if (count($eq) == 1) {
						$eq = [1 => $eq[0]];
					}  elseif (count($eq) > 1) {
						$e = []; $i = -1;
						foreach ($eq as $key) {
							$e[] = ['i' => count($col) + $i, 'aa' => $key];$i++;
						}
						$eq = array_column($e, 'aa', 'i');
					}
				}

				$this->_input = array_merge($this->_input, $col);
				$this->_value = array_merge($this->_value, $val);
				break;
			case 'remove':
				if (empty($var[0])) {
					$this->_input = $this->_value = [];
				} else {
					foreach($var[0] as $k) {
						$key = array_search($k, $this->_input);
						if ($key !== false) {
							unset($this->_input[$key]);
							unset($this->_value[$key]);
						}
					}
				}
		}
		// now check if there is anything left on the request object

		// reset here
		$this->_sql = '';
		$this->where = true;
		$this->_query_value =[];

		if ($this->_input) {
			switch ($this->_method) {
				case 'create':
					$this->create();
					break;
				case 'update':
					$this->update();
					break;
				case 'fetch': 
					if ($this->_cols) $this->fetch($this->_cols);
					else $this->fetch();
					break;
				case 'delete':
					$this->delete();
			}
		}
		return $this;
	}

	public function methodCall ($method) {
		$this->_sql = '';
		$this->where = true;
		$this->_query_value =[];
		if ($this->_input) {
			switch ($this->_method) {
				case 'create':
					$this->create();
					break;
				case 'update':
					$this->update();
					break;
				case 'fetch': 
					if ($this->_cols) $this->fetch($this->_cols);
					else $this->fetch();
					break;
				case 'delete':
					$this->delete();
			}
		}
		return $this;
	}

	public function change(array $arr) {
		if (count($arr) != count($this->_value)) $this->error = '** Change ** column count does not match!';
		else $this->_input = $arr;
		return $this;
	}
	
	public function using (array $id) {
		if ($id && !$this->error()) {
			$where = [];
			foreach ($id as $key) {
				$k = array_search($key, $this->_input);
					if ($k !== false)
						$where[] = [$this->_input[$k], $this->_value[$k]];
			}

			if ($where) {
				$this->where($where, true);
			}
		}
		return $this;
	}

	public function with_supp ($col, $val, $op = '') {
		$f = [];
		foreach ($col as $k => $v) {
			if ($op) {
				if (isset($op[$k])) {
					$w = [$v, $op[$k], $val[$k]];
				} else {
					$w = [$v, $val[$k]];
				}
				$f[] = $w;
			} else {
				$f[] = [$col[$k], $val[$k]];
			}
		}
		return $f;
	}

	public function upsert() {
		if ($this->error()) return $this;

		if ($this->_value && $this->_input) {
			$this->fetch()->exec();

			if ($this->count()) {
				$this->update();
			} else {
				$this->create();
			}
		}
		return $this; 
	}

	public function insertWith(string $col, array $Acol = [], array $Aval = []) {
		if (!$col) return error('No column specified!');

		if ($Acol && $Aval) {
			if (count($Aval) == count($Acol)) {
				array_push ($Acol, $col);
				array_push ($Aval, $this->_lastid);
				$this->add($Acol, $Aval);
			} else {
				$this->add([$col], [$this->_lastid]);
			}
		}
		return $this;
	}

	public function exec($check = false) {
		if ($this->_error) return $this->error();
		$res = $this->res($check);
		if ($this->_error) return $this->error();

		$this->_input = $this->_value = $this->_method = null;
		return $res;
	}
}