<?php

class APIRequest {
	private $_ini, $_uri, $_type = 'get', $_error, $_info;

	public function url ($uri) {
		if (!$uri) error('No url specified!', 'APIRequest error!');
		$this->_uri = $uri;
		$this->_ini = curl_init($uri);
		return $this;
	}

	public function headers (...$head) {
		curl_setopt($this->_ini, CURLOPT_HTTPHEADER, func_get_args());
		return $this;
	}
	
	public function method($m = 'get') {
		switch ($m) {
			case 'put':
				curl_setopt($this->_ini, CURLOPT_PUT, true);
			break;
			case 'post':
				curl_setopt($this->_ini, CURLOPT_POST, true);
			break;
			case 'file':
				curl_setopt($this->_ini, CURLOPT_PUT, true);
			break;
			case 'delete':
				curl_setopt($this->_ini, CURLOPT_CUSTOMREQUEST, 'DELETE');
			break;
			case 'option':
				curl_setopt($this->_ini, CURLOPT_CUSTOMREQUEST, 'OPTION');
			break;
			default:
				curl_setopt($this->_ini, CURLOPT_HTTPGET, true);
			break;
		}
		$this->_type = $m;
		return $this;
	}

	/**
	 *  @param array $key Key to the body
	 *	@param array $val Values to be passed
	 *   
	*/

	public function params ($key, $val) {
		if (count($key) != count($val)) error('Parameter count does not match!', 'APIRequest error!');

		$this->_uri = $this->_uri . '?' . http_build_query(array_combine($key, $val));
		$this->url($this->_uri);
		return $this;
	}
	
	public function body ($key, $val = [], $get = false) {
		if (!is_array($key) && !is_array($val)) {
			$key = [$key]; $val = [$val];
		} else {
			if (count($key) !== count($val)) {
				$this->_error = 'Keys and values given for body does not match!';
				return $this;
			}
		}
		
		$body = array_combine($key, $val);
		$body = $this->build_query($body);

		if ($this->_type === 'get' || $this->_type === 'delete' || $get) {
			$this->params($key, $val);
			$this->url($this->_uri);
			return $this;
		}
		curl_setopt($this->_ini, CURLOPT_POSTFIELDS, $body);
		return $this;
	}
	
	public function file ($loc) {
		$t = $this->_type;
		if ($t != 'put' && $t != 'post') {
			$this->_error = 'Put or Post method is required for file upload!';
		} else {
			if (!file_exists($loc)) {
				$this->_error = 'Cannot find the given file!';
			} else {
				$size = filesize($loc);
				$file = fopen($loc, 'r');
				curl_setopt_array($this->_ini, array_combine([CURLOPT_INFILE, CURLOPT_INFILESIZE], [$file, $size]));
			}
		}
		return $this;
	}
	
	public function send($c = false) {
		if ($this->_error) error($this->_error, 'APIRequest error!');
		if (config('state/development')) $arr = [true, false, 0, 0, 0]; else $arr = [true, false, 2, 1, 1];
		curl_setopt_array($this->_ini, array_combine(
			[CURLOPT_RETURNTRANSFER, CURLOPT_HEADER, CURLOPT_SSL_VERIFYHOST, CURLOPT_SSL_VERIFYSTATUS, CURLOPT_SSL_VERIFYPEER],
			$arr));
		$res = curl_exec($this->_ini);
		
		if (curl_error($this->_ini)) 
			error(curl_error($this->_ini), 'APIRequest error');
			
		// meta
		
		
		if ($c) $res = Utils::json($res);
		$this->_info = curl_getinfo($this->_ini);
		curl_close($this->_ini);
		return $res;
	}
	
	public function info () {
		return (object) $this->_info;
	}
	
	public function error () {
		return $this->_error;
	}

	private function build_query($data, $prefix = '') {
		$output = array();
		foreach($data as $key => $value) {
			$final_key = $prefix ? "{$prefix}[{$key}]" : $key;
			if (is_array($value)) {
			// @todo: handle name collision here if needed
			$output += $this->build_query($value, $final_key);
			}
			else {
			$output[$final_key] = $value;
			}
		}
		return $output;
	}
}