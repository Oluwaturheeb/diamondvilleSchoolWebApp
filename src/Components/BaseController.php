<?php
namespace Devtee\Tlyt\Components;

class BaseController extends Validate {
  public function render($path, array $variable = []) {
		if ($variable) {
		  $GLOBALS['view'] = $variable;
	  	for ($i = 0; $i < count($variable); $i++) {
  			$var = array_keys($variable)[$i];
  			$$var = array_values($variable)[$i];
  		}
		}

		$__toRender = ROOT . 'views/' . $path . '.lyt.php';
		if (!file_exists($__toRender)) error('Cannot find view '. $path);
    $__toRender = file_get_contents($__toRender);
    $__toRender = str_replace(['<*', '*>'], ['<?php', '?>'], $__toRender);
    echo eval("?>$__toRender<?php");
	}

	public function jsonResponse ($data, int $status = 200) {
	  return Http::jsonResponse($data);
	}

	public function __get ($name = null) {
	  return ($name) ? Route::request()->$name : Route::request();
	}

	public function __toString () {
	  return Utils::json([
	    'class' => [
	      'name' => 'BaseController',
	      'requestString' => Route::request()
	    ]
	  ]);
	}

	public function validate (array $rules, bool $fail = true) {
	  $this->validator($rules, $fail);
	  return $this;
	}

	public function data () {
	  return Route::request();
	}
}
