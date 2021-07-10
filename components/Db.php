<?php

class Db {
	public $paging = false, $next = 0, $prev;
	private static $_instance;
	protected $_pdo, $_error = false, $_table, $_sql, $_query_value = [], $_misc,  $_sort,
	$_count, $_lastid, $where = true, $_transaction = false, $_result = null;
	
	public function __construct () {
		if ($this->_error) return $this->error();
		try{
			$this->_pdo = $this->config();
		} catch (Exception $e) {
			$this->_error = $e->getMessage();
		}
	}

	public static function instance () {
		if (!isset(self::$_instance)) {
			self::$_instance = new Db();
		}
		return self::$_instance;
	}

	public function errorSafe () {
		$this->_transaction = true;
		$this->_pdo->beginTransaction();
		return $this;
	}

	public function commit() {
		$this->_pdo->commit();
		return $this;
	}

	public function undoQuery () {
		if ($this->_transaction) {
			$this->_pdo->rollback();
			$this->_transaction = false;
		}
		return $this;
	}

	public function table ($name) {
		if (is_array($name)) {
			$this->_error = 'Table name should be string';
		} else {
			$this->_table = "`{$name}`";
		}
		return $this;
	}

	public function query ($sql, $opt = []) {
		$this->_error = false;
		try {
			if ($this->_query = $this->_pdo->prepare($sql)) {
				if (@count($opt)) {
					$i = 1;
					foreach ($opt as $clause) {
						$this->_query->bindValue($i, $clause);
						$i++;
					}
				}

				if ($this->_query->execute()) {
					if ($this->_transaction) $this->commit();
					$this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
					$this->_count = $this->_query->rowCount();
				} else {
					$this->_error = $this->_query->errorInfo()[2];
					print_r($this);
					$this->undoQuery();
				}
			}
			$this->_lastid = $this->_pdo->lastInsertId();
		} catch (Exception $e) {
			$this->_error = $e->getMessage();
			if ($this->_error) $this->undoQuery();
		}
		return $this;
	}

	public function customQuery ($sql, $ops = []) {
		if (is_array($ops)) {
			$this->_sql = $sql;
			$this->_query_value = $ops;
		} else {
			$this->_error = 'This method expect an array for second parameter';
		}
		return $this;
	}

	public function add ($col, $val) {
		if (!$this->_error) {
			$p = array_fill(0, count($val), '?');

			$this->_sql = 'insert into '. $this->_table .' (' . $this->safe_str($col) .') values(' . implode(', ', $p) . ')';
			$this->_query_value = $val;
		}
		return $this;
	}

	public function get (...$col) {
		if ($this->_error) return $this;
		if ($col) (is_array($col[0])) ? $col = $this->safe_str($col[0]) : $col = $this->safe_str($col);
		else $col = '*';

		$this->_sql = "select {$col} from {$this->_table}";
		return $this;
	}

	public function getDistinct (...$col) {
		if (!$this->_error) {
			if ($col) $col = $this->safe_str($col);
			else $col = '*';

			$this->_sql = "select distinct {$col} from {$this->_table}";
		}
		return $this;
	}

	public function join ($table, $pre, $type = '') {
		// error 
		if (is_array($table)) {
			$this->_error = '**Arg Error: String is required Array given. Method called Join!';
			return $this;
		} 
		$this->_sql .= " {$type} join `{$table}`" . $this->predicate($pre, $table);
		return $this;
	}
	
	public function set ($cols, $vals) {
		if (!$this->_error) {
			$col = $value = ''; $i = 1;

			foreach($cols as $keys => $values){
				$col .= "`{$values}` = ?";
				
				if($i < count($cols)){
					$col .= ', ';
				}
				$i++;
			}

			$this->_query_value = $vals;
			$this->_sql = "update {$this->_table} set {$col} "; 
		}
		return $this;
	}

	public function rm () {
		if (!$this->_error) {
			$this->_sql = "delete from {$this->_table} ";
		}
		return $this;
	}

	public function find (...$where) {
		if (!$this->_error) {
			if (!empty($where)) {
				if (end($where) === true) {
					$where = $where[0];
				} else {
					$where = $where;
				}

				$form = $this->gen($this->form($where, true), 'and');
				$w = str_replace('=', 'like', $form[0]);

				$ff = function ($a) {
					return "%{$a}%";
				};

				if ($this->where) {
					$this->_sql .= ' where ';
					$this->where = false;
				} else {
					$this->_sql .= ' and ';
				}

				$this->queryValue(array_map($ff, $form[1]));

				$this->_sql .= " $w";
			}
		}

		return $this;
	}
	
	public function orFind (...$where) {
		if (!$this->_error) {
			if (!empty($where)) {
				if (end($where) === true) {
					$where = $where[0];
				} else {
					$where = $where;
				}

				$form = $this->gen($this->form($where, true), 'or');
				$w = str_replace('=', 'like', $form[0]);

				$ff = function ($a) {
					return "%{$a}%";
				};

				if ($this->where) {
					$this->_sql .= ' where ';
					$this->where = false;
				} else {
					$this->_sql .= ' or ';
				}

				$this->queryValue(array_map($ff, $form[1]));

				$this->_sql .= " $w";
			}
		}
		return $this;
	}
	
	public function where (...$id) {
		if (!$this->_error && $id) {
			if (end($id) === true) $args = $id[0];
			else $args = $id;

			$gen = $this->gen($this->form($args), 'and');
			
			$this->queryValue($gen[1]);

			if ($this->where) {
				$this->_sql .= ' where ';
				$this->where = false;
			} else {
				$this->_sql .= ' and ';
			}

			if ($this->_misc !== true) {
				$this->_sql .= $gen[0];
			} else {
				$this->_sql = substr($this->_sql, 0, -1);
				$this->_sql .= ' ' . $gen[0] . ')';
			}
		}
		return $this;
	}
	
	public function having (...$id) {
		if (!$this->_error && $id) {
			if (end($id) === true) $args = $id[0];
			else $args = $id;

			$gen = $this->gen($this->form($args), 'and');
			
			$this->queryValue($gen[1]);
			$have = str_ireplace('where', 'having', $gen[0]);

			if ($this->where) {
				$this->_sql .= ' having ';
				$this->where = false;
			} else {
				$this->_sql .= ' and ';
			}

			if ($this->_misc !== true) {
				$this->_sql .= $have;
			} else {
				$this->_sql = substr($this->_sql, 0, -1);
				$this->_sql .= ' ' . $have . ')';
			}

		}
		return $this;
	}
	
	public function orHaving (...$id) {
		if (!$this->_error && $id) {
			if (end($id) === true) $args = $id[0];
			else $args = $id;

			$gen = $this->gen($this->form($args), 'and');
			
			$this->queryValue($gen[1]);
			$have = str_ireplace('where', 'having', $gen[0]);

			if ($this->where) {
				$this->_sql .= ' where ';
				$this->where = false;
			} else {
				$this->_sql .= ' or ';
			}

			if ($this->_misc !== true) {
				$this->_sql .= $have;
			} else {
				$this->_sql = substr($this->_sql, 0, -1);
				$this->_sql .= ' ' . $have . ')';
			}

		}
		return $this;
	}
	
	public function orWhere (...$id) {
		if (!$this->_error && $id) {
			if (end($id) === true) $args = $id[0];
			else $args = $id;
			
			$gen = $this->gen($this->form($args), 'or');
			
			$this->queryValue($gen[1]);

			if ($this->where) {
				$this->_sql .= ' where ';
				$this->where = false;
			} else {
				$this->_sql .= ' or ';
			}

			if ($this->_misc !== true) {
				$this->_sql .= $gen[0];
			} else {
				$this->_sql = substr($this->_sql, 0, -1);
				$this->_sql .= ' ' . $gen[0] . ')';
			}
		}
		return $this;
	}
	
	public function whereIn($col, array $val = []) {
		if (!$col) $this->_error = "whereIn method missing required argument!";
		if ($this->_error) return $this;

		if ($this->where) {
			// no initial where clase
			if (empty($val)) {
				$this->_sql .= " where {$col} in ";
				$this->where = false;
			} else {
				$this->where = false;
				$new = implode(', ', array_fill(1, count($val), '?'));
				$this->_sql .= " where {$col} in ({$new})";
			}
		} else {
			if (empty($val)) {
				$this->_sql .= " and where {$col} in ";
			} else {
				$new = implode(', ', array_fill(1, count($val), '?'));
				$this->_sql .= " and where {$col} in ({$new})";
			}
		}
		
		$this->queryValue($val);
		return $this;
	}
	
	// where a single value matches different columns
	public function whereManyToOne ($col, $val, $sign = []) {
		if (!$this->_error && $val) {
			$q = '';
			foreach ($col as $n => $a) {
				if (empty($sign) || !is_array($sign)) {
					$sign = '=';
				} else {
					$sign = $sign[$n];
				}
				if ($n > 0) {
					$q .= ' and ';
				}
				
				$q .= $a. ' ' . $sign . ' ?';
			}

			
			$this->queryValue(array_fill(0, count($col), $val));
			
			if ($this->where) {
				$this->_sql .= ' where ';
				$this->where = false;
			} else {
				$this->_sql .= ' and ';
			}

			$this->_sql .= ' where ' .$q;
		}
		return $this;
	}
	
	public function orWhereManyToOne ($col, $val, $sign = []) {
		if (!$this->_error && $val) {
			$q = '';
			foreach ($col as $n => $a) {
				if (empty($sign) || !is_array($sign)) {
					$sign = '=';
				} else {
					$sign = $sign[$n];
				}
				if ($n > 0) {
					$q .= ' or ';
				}
				
				$q .= $a. ' ' . $sign . ' ?';
			}
			
			$this->queryValue(array_fill(0, count($col), $val));
			if ($this->where) {
				$this->_sql .= ' where ';
				$this->where = false;
			} else {
				$this->_sql .= ' and ';
			}
			$this->_sql .= ' where ' .$q;
		}
		return $this;
	}
	

	public function pages ($ppage = 5, $url = 'pageControl') {
		if ($this->_error) return $this;

		if ($url != 'pageControl') {
			if (req($url)) $each = req($url); else $each = 1;

			if (is_numeric($each)) {
				$this->query($this->_sql, $this->_query_value);
				if ($this->_count) $last = ceil($this->count() / $ppage);
				else $last =1;

				if ($each >= $last) $each = $last;
			} else {
				$each = 1;
			}
			
			if ($last > 1) {
				if ($each < $last) {
					$next = $each + 1;
					$prev = $each - 1;
				} else if ($each >= $last) {
					$next = $last;
					$prev = $last - 1;
				}
				$this->paging = true;
				$this->next = $next;
				$this->prev = $prev;
			}
		} else $each = 1;
		
		$this->_sql .= ' limit ' . ($each - 1) * $ppage . ', ' . $ppage;
		return $this;
	}

	public function autopages ($ppage = 10){
		$this->query($this->_sql, $this->_query_value);

		if ($this->_error) return false;
		$total = $this->count();
		$last = ceil($total / $ppage);
		$t = $total - $ppage;

		if( $t < 0) $t = 0;
		return $t . ', ' . $ppage;
	}
	
	public function sort ($col = 'id', $order = 'desc') {
		if (!$this->_error && $col) {
			if ($col === 'rand') $this->_sql .= " order by rand()";
			else		 $this->_sql .= " order by {$col} {$order}";
		}
		return $this;
	}
	
	public function union ($tab, array $cols = []) {
		if (!$this->error()) {
			$this->_sql .= ' union ';
			$nq = 'select '. implode(', ', $cols) . ' from '. $tab;
			$this->_sql .= $nq;
		}
		return $this;
	}

	public function sub ($t, $col = ['*']) {
		if (!$this->_error) {
			$this->_query_value = [];
			$s = ' (select ' . implode(', ', $col) . " from $t)";
			if (stristr($this->_sql, '= ?')) {
				$this->_sql = str_ireplace('= ?', 'in', $this->_sql);
			} else {
				$this->_sql = str_ireplace('?', '', $this->_sql);
			}
			$this->_sql .= $s;
			$this->_misc = true;
		}
		return $this;
	}

	public function res ($f = false) {
		if ($this->_error) {
			return $this->_error;
		} else {
			$this->_sort = null;
			$this->_misc = null;
			$this->query($this->_sql, $this->_query_value);
			$this->_query_value = [];
			$this->where = true;

			if (stristr($this->_sql, 'insert')) {
				return $this->_lastid;
			} else {
				if ($f == false || !$this->count())
					return $this->_result;
				else 
					return $this->_result[0];
			}
		}
	}

	public function error(){
		return $this->_error;
	}
	
	public function count(){
		return $this->_count;
	}

	public function out () {
		return $this->_sql;
	}

	public function exp () {
		$this->query('explain ' . $this->_sql, $this->_query_value);
	}
	
	public function __tostring() {
		return $this->out() . '<br>' . Utils::json($this->_query_value);
	}

	// protected methods

	// this method takes a multi-dimention array as arg.

	protected function form ($args) {
		if (count($args) == 1) {
			$arg = $args[0];

			if (!is_array($arg) && is_numeric($arg)) {
				$where = [['id', '=', $arg]];
			} elseif (is_array($arg)) {
				if(count($arg) == 2) {
					$where = [[$arg[0], '=', $arg[1]]];
				} else {
					$where = $arg;
					$where[1] = str_ireplace(['&lt;', '&gt;'], ['<', '>'], $where[1]);
					$where = [$where];
				}
			} else {
				$where = $args;
			}
		} elseif (count($args) > 1) {

			$where = [];
			for ($i = 0; $i < count($args); $i++) { 
				$arr = $args[$i];
				if(!empty($arr)) {
					if (is_numeric($arr)) {
						$w = ['id', '=', $arr];
						array_push($where, $w);
					} elseif(count($arr) == 2) {
						$w = [$arr[0], '=', $arr[1]];

						array_push($where, $w);
					} elseif (count($arr) > 2) {
						$w = $arr;
						$w[1] = str_ireplace(['&lt;', '&gt;'], ['<', '>'], $w[1]);
						array_push($where, $w);
					} else {
						$this->_error = '**Error: This method expecs numeric character as args!';
						return false;
					}
				}
			}
		}
		return $where;
	}
	
	private function queryValue ($item) {
		if (!empty($this->_query_value)) {
			$this->_query_value = array_merge($this->_query_value, $item);
		} else {
			$this->_query_value = $item;
		}
		return $this;
	}

	protected function gen ($where, $cc) {
		if (is_array($where[0])){
			$op = $value = '';
			$where = @array_filter($where);
			for ($i = 0, $j = 1;$i < @count($where); $i++, $j++) {
				$v1 = $where[$i][0];
				$v2 = $where[$i][1];
				$v3 = $where[$i][2];
	
				if (is_array($v1)) {
					if (is_array($v2)) {
						$v2_con = $v2[0];
						$v2_sign = $v2[1];
					} else {
						$v2_con = 'or';
						$v2_sign = $v2;
					}
					$v11 = $this->safeStr($v1[0]);
					$v12 = $this->safeStr($v1[1]);
					$op .= "({$v11} {$v2_sign} ?  {$v2_con} $v12 {$v2_sign} ?)";
					$value .= "{$v3}, {$v3}";
				} else {
					$v1 = $this->safeStr($v1);
					$op .= "{$v1} {$v2} ?";
					$value .= "{$v3}";
				}
				
				if($j < count($where)){
					$value .= ', ';
				 $op .= " {$cc} ";
				}
			}
	
			$value = explode(', ', $value);
			$op = " {$op}";
			return [$op, $value];
		} else {
			$this->_error = '**Arg Error: This method expects a multi-dimentional array as parameter 1 gen';
			return false;
		}
	}

	// this method works for join

	protected function safeStr (string $str) {
		if (stripos($str, '.')) {
			$str = explode('.', $str);
			$str = "`{$str[0]}`.`{$str[1]}`";
		} else {
			$str = "`{$str}`";
		}

		return $str;
	} 

	protected function predicate ($pre, $table= '', $concat = 'and') {
		if (!$pre) {
			$this->_error = '**Arg Error: No value given. Method called Predicate';
		} else {
			if (!is_array($pre)) return " using({$pre})";
			
			$ret = '';
			if (is_array($pre[0])) {
				foreach ($pre as $p => $v) {
					if ($p > 0) {
						$ret .= " $concat ";
					}
					if (count($v) == 3) {
						if ($v[0][0] == '@') $p1 = $this->safeStr($table.'.'. substr($v[0], 1)); else $p1 = $this->safeStr($v[0]);
						if  ($v[2][0] == '@') $p2 = $this->safeStr($table.'.'. substr($v[2], 1)); else $p2 = $this->safeStr($v[2]);
	
						$ret .= $p1. ' ' . $v[1]. ' ' .$p2;
					} else {
						if ($v[0][0] == '@') $p1 = $this->safeStr($table.'.'. substr($v[0], 1)); else  $p1 = $this->safeStr($v[0]);
						if  ($v[1][0] == '@') $p2 = $this->safeStr($table.'.'. substr($v[1], 1)); else $p2 = $this->safeStr($v[1]);
	
						$ret .= $p1. ' = ' .$p2;
					}
				}
			} else {
				if (count($pre) == 3) {
					if ($pre[0][0] == '@') $p1 = $this->safeStr($table.'.'. substr($pre[0], 1)); else $p1 = $this->safeStr($pre[0]);
					if  ($pre[2][0] == '@') $p2 = $this->safeStr($table.'.'. substr($pre[2], 1)); else $p2 = $this->safeStr($pre[2]);

					$ret = $p1. ' ' . $pre[1]. ' ' .$p2;
				} else {
					if ($pre[0][0] == '@') $p1 = $this->safeStr($table.'.'. substr($pre[0], 1)); else $p1 = $this->safeStr($pre[0]);
					if  ($pre[1][0] == '@') $p2 = $this->safeStr($table.'.'. substr($pre[1], 1)); else $p2 = $this->safeStr($pre[1]);

					$ret = $p1. ' = ' .$p2;
				}
			}
			return ' on ' . $ret;
		}
		return false;
	}

	private function safe_str (array $col) {
		$fun = function ($data) {
			// numeric value
			if (is_numeric($data)) return $data;

			// db function
			if ($data[0] == '@') return substr($data, 1);
			
			// look for dot notation and possibly * and as
			if (stripos($data, '.')) {
				$d = explode('.', $data);
				if ($d[1] == '*')  {
					$col = $d[1];
				} else if (stripos($d[1], ' as ')) {
					$c = explode(' ', $d[1]);
					$col = "`{$c[0]}` as `{$c[2]}`";
				} else {
					$col = "`{$d[1]}`";
				}
				$data = "`{$d[0]}`.$col";
				
				return $data;
			} else if (stripos($data, ' as ')) {
				$c = explode(' ', $data);
				$data = "{$c[0]}` as `{$c[2]}";
			}
			return "`$data`";
		};

		$col = array_map($fun, $col);
		return implode(', ', $col);
	}

	private function config ($host = '', $db = '', $user = '', $pwd = '') {
		if ($host)
			return new PDO('mysql:host='. $host .';dbname=' . $db, $user, $pwd);
		return new PDO('mysql:host='. config('db/host') .';dbname=' . config('db/database'), config('db/usr'), config('db/pwd'));
	}
}