<?php
namespace Devtee\Tlyt\Components;

class Validate {
	protected $_pass = true, $_file = [], $_errors = [];
	public $validated;
	/**
	 * @param $fields Accepts a mult-dimensional array input feild and rule.
	 * rules are [email, match, max, min, number, unique, wordcount, multiple, cap, capword, error,optional, name, required, ip, url]
	 * @param $failOnFirst Determines either to fail on first error or continue
	 */

	public function validator (array $fields = [], bool $failOnFirst = true) {
		// get the data from the request
		if (!count($src = req(true))) return;

		if ($this->error()) return $this;
	  else {
			// validations may now follow!
			// ini errors
			$dError = [];
			$def = '';
			foreach ($fields as $field => $options) {
				// if the request field is an array or not we need to remove ending and starting spaces
				if (!isset($src[$field])) {
					$def .= $field .' not found in the request';
				} else {
					if (!is_array($src[$field])) {
						$input = trim($src[$field]);
					} else {
						$input = array_map('trim', $src[$field]);
					}
				}

				foreach ($options as $rule => $value) {
					// if there is error break the loop and return the error
					if ($failOnFirst && $dError)
						break;

					// checking if the rule comes with error field
					if (empty($options['error'])) $error = '';
					else $error = ucfirst($options['error']);

					// if the field is optional

					if (!isset($options['optional'])) {
						// check for field name
						if (isset($options['name'])) $field_name = $options['name'];
						else $field_name = $field;

						//execute other rules
						if ($rule == 'required' && empty($input)) {
							if (!$error)
								$def .= $field_name. ' cannot be empty!';
						} else {
							switch ($rule) {
								case 'email':
									if(!filter_var($input, FILTER_VALIDATE_EMAIL))
										$def .= 'Invalid email address!';
									break;
								case 'match':
									if($input !== $src[$value])
										$def .= 'Password do not match!';
									break;
								case 'max':
									if (!is_numeric($input))
										if(strlen($input) > $value){
											$def .= 'Maximum characters exceeded for ' .$field_name. ' field!';
										}
									else
										if ($input > $value) {
											$def .= $field_name.' is greater than '.$value;
										}
									break;
								case 'min':
									if(!is_numeric($input)) {
										if(strlen($input) < $value)
											$def .= $field_name.' should be at least minimum of '. $value .' characters!';
									} else {
										if ($input < $value)
											$def .= $field_name.' value is less than '.$value;
									}
									break;
								case 'number':
									if(!is_numeric($input))
										$def .= $field_name.' should have a numeric value!';
									break;
								case 'unique':
									$d = (new Crud($value))->unique($field);
									if($d) $def .= $field_name . ' exists, try another!';
									break;
								case 'wordcount':
									$cal = $value - str_word_count($input, 0, '@._');
									if(str_word_count($input, 0, '@._') < $value)
										$def .= $field_name.' should have at least '.$value.' words! Remain '.$cal;
									break;
								case 'multiple':
									if(!count(array_filter($src[$field])))
										$def .= $field_name.' is required!';
									break;
								case 'cap':
									$input = ucfirst($input);
								break;
								case 'capword':
									$input = ucwords($input);
								break;
								case 'ip':
								  if (!filter_var($input, FILTER_VALIDATE_IP))
								    $def .= $field_name . ' not a valid ip address';
								  break;
								case 'url':
								  if (!filter_var($input, FILTER_VALIDATE_URL))
								    $def .= $field_name . ' not a valid url!';
							    break;
							}
						}
					}
					//subbing errors
					if ($def) {
						if ($error) $dError[] = $error;
						else $dError[] = $def;
					}
					$def = null;
					$key[] = $field_name;
					$val[] = $input;
				}
			}
		}
		// formatting error output
		if($dError) {
			$this->_pass = false;
			$this->_errors = $dError;
		} else {
			$this->validated = (object) array_combine($this->filter($key), $this->filter($val));
		}
		return $this;
	}

	public static function formSpoofing (array $newName) {
		$count = count($newName);
		if ($count > count(req()))
			error('Value passed is less than the form value');
		elseif ($count > count(req()))
			error('Value passed is greater than the form value');

		return (object) array_combine($newName, array_values(req(true)));
	}

	private function img_comp ($file, $dest) {
		$mm = getimagesize($file)['mime'];

		if ($mm == 'image/jpeg') $img = imagecreatefromjpeg($file);
		elseif ($mm == 'image/bmp') $img = imagecreatefromwbmp($file);
		elseif ($mm == 'image/gif') $img = imagecreatefromgif($file);
		elseif ($mm == 'image/png') $img = imagecreatefrompng($file);

		if (imagejpeg($img, $dest, 30)) return $dest;
		else return false;
	}

	public function uploader(string $data = null){
	  if (!$_FILES) return $this->_errors[] = 'No file in the current request!';
	  if (!$data) return $this->_errors[] = 'File input field not provided!';

		$src = $_FILES;
		$folder = 'assets/tmp/';
		if (!is_dir($folder)) mkdir($folder);

		$file = $src[$data];
		$tmp = (array) $file['tmp_name'];
		$name = (array) $file['name'];
		$count = count($name);

		if (empty($name[0])) $this->addError('Kindly select a file!');
		else {
			if ($count > config::get('file-upload/max-file-upload')) $count = config::get('file-upload/max-file-upload');

			for ($i = 0; $i < $count; $i++) {
				if (!empty($name[$i])) {
					if (!Utils::getMediaType($tmp[$i], true)) {
						$this->addError($name[$i].' type not supported!');
					} else {
						// file rename config
						$c = config('file-upload/rename-file');

						// the config mime
						$mime = explode(', ', substr(config('file-upload/mime'), 1, -1));

						if (Utils::getMediaType($tmp[$i]) == 'image') {
							// image compresson
							if ($c) $name = config('project/name') . '_' . Utils::gen() . '_' . time().'.png';
							else $name = $name[$i];
							$img = $this->img_comp($tmp[$i], $folder.$name);
						} elseif (Utils::getMediaType($tmp[$i]) == 'video') {
							if ($c) $name = config('project/name') . '_' . Utils::gen() . '_' . time().'.mp4';
							else $name = $name[$i];

							move_uploaded_file($tmp[$i], $folder.$name);
							$img = $folder.$name;
						} elseif (Utils::getMediaType($tmp[$i]) == 'audio') {
							if ($c) $name = config('project/name') . '_' . Utils::gen() . '_' . time().'.mp3';
							else $name = $name[$i];
							move_uploaded_file($tmp[$i], $folder.$name);
							$img = $folder.$name;
						} elseif (in_array((Utils::getMediaType($tmp[$i], 1)), $mime)) {
							if ($c) $name = config('project/name') . '_' . Utils::gen() . '_' . time(). '_'. $file['name'][$i];
							else $name = $name[$i];
							// since we dont know the file type been uploaded we need to append the file name at the end of the gen name
							move_uploaded_file($tmp[$i], $folder.$name);
							$img = $folder.$name;
						} else {
							$this->addError($name[$i].' type not supported!');
						}

						if ($count == 1) $this->_file[] = [$img, $name];
						else $this->_file[] = [$img, $name];
					}
				}
			}
		}
		return $this;
	}

	public function preview () {
	  if ($this->error()) error($this->error());
		return $this->_file[0];
	}

	public function uploadTo($dest = 'assets/img/'){
		if ($this->_errors) error($this->error());
		if (!is_dir($dest)) mkdir(ROOT . $dest);
		$files = $this->_file;
		$this->_file = [];
		if (count($files) == 1) {
			if (rename($files[0][0], $dest.$files[0][1])) return $dest.$files[0][1];
		} else {
			$file = [];
			for ($i = 0, $count = count($files); $i < $count; $i++) {
				if (rename($files[$i][0], $dest.$files[$i][1]) == true)
					$file[] = $dest.$files[$i][1];
			}
			return (object) $file;
		}
	}

	public static function hash ($hash) {
		return password_hash($hash, PASSWORD_BCRYPT);
	}

	public static function _hash ($hash, $len = 0) {
		$hash = hash_hmac('haval160,4', $hash, 'tlyt is lit');

		if ($len)
			return substr($hash, 0, $len);

		return $hash;
	}

	public function addError($error = ''){
		$this->_errors[] = $error;
	}

	public function error() {
		return end($this->_errors);
	}

	public function pass(){
		return $this->_pass;
	}

	public static function filter($str){
		if (!$str) return false;

		if (is_array($str))
			return array_map([Validate::class, 'filter'], $str);

		return htmlentities(trim(self::filter_str($str)), ENT_QUOTES, 'utf-8', false);
	}

	private static function filter_str ($str) {
		$si = [
		  '/*' => '', '*/' => '', '==' => '',
		  'select * from' => '', 'drop table' => '', 'drop database' => '',
		  'delete from' => '', 'display:none' => '', 'display: none' => '',
		  '--' => '- -', ' --' => '', '-- '=> ''
		];
		$str = strtr($str, $si);
		return $str;
	}

	public static function csrf($c = false) {
		// if there aint an active csrf

		if (!Session::check('__token')) {
			$ses = uuid(100);
			Session::set('__token', $ses);
			if (config('session/tokenExp'))  Session::set('expires', time() + config('session/tokenExp'));
		} else {
			// if there is
			$ses = Session::get('__token');
		}

		if (!$c) {
			$html = <<<__here
			<div><label style="display: none !important">csrf</label><input type="hidden" name="__csrf" value="$ses" id="__csrf"/></div>
__here;
		} else {
			$html = $ses;
		}

		return $html;
	}

	public static function validateCsrf ($str) {
		if (!$str) error('CSRF not found in form!', 'CSRF error!', 419);
		// check if the csrf token has timed out

		if (config('session/tokenExp')) {
			if (time() > Session::get('expires')) {
				Session::del('expires');
				Session::del('__token');
				error('Page has expired, refresh the page!', 'Page expired', 419);
			}
		}

		if ($str === Session::get('__token')) return true;
		else error('Csrf token error, refresh the page!', 'Page expired', 419);
		return false;
	}
}
