<?php
use Devtee\Tlyt\Components\Validate;
use Devtee\Tlyt\Components\Config;
use Devtee\Tlyt\Components\Logger;
use Devtee\Tlyt\Components\Db;
use Devtee\Tlyt\Components\Authentication;
use Devtee\Tlyt\Components\Route;
use Devtee\Tlyt\Components\Session;
use Devtee\Tlyt\Components\Http;
use Devtee\Tlyt\Components\Xender;

function csrf ($c = false) {
  echo Validate::csrf($c);
}

function verbose (...$var) {
  if (func_num_args()) {
    $main = false;
    foreach (func_get_args() as $c => $data) {
      $type = function ($data) {
        if (is_bool($data)) $v = ($data) ? '(Boolean) true' : '(Boolean) false';
        elseif (is_array($data)) $v = '(Array) <br> ';
        elseif (is_object($data)) $v = '(Object) ';
        elseif (is_numeric($data)) $v = '(Number) ';
        elseif (is_string($data)) $v = '(String) ';
        elseif (is_null($data)) $v = '(Null) ';
        return $v;
      };

      $v = $type($data);

      if (is_countable($data)) {
        foreach ($data as $key => $value) {
          if (is_countable($value)) {
            if (!$main) $main = true;
            verbose($value);
          } else $v .= '&raquo; &nbsp;&nbsp;'. $type($value) . $key .' => '. $value .' <br/>';
          if (func_num_args() === $c + 1 && $main) exit();
        }
      } else $v .= $data;
      echo "<div style='margin-bottom: 5px;color: #fff;background: #111;padding: 5px; width: 100vw'>{$v}</div>";
    }
    if (func_num_args() === $c + 1) exit();
  } else exit("<div style='color: #fff;background: #111;padding: 5px; width: 100vw'>Null</div>");
}

function authId () {
  return Authentication::authId();
}

function auth ($data = null) {
  return Authentication::auth($data);
}

function authCheck ($loc = '') {
  if (!authId()) {
    if (!$loc) goBack();
    else redirect($loc);
  }
}

function res ($data = '', $status = 200) {
  return Http::jsonResponse($data, $status);
}

function currentUrl () {
  return Route::url();
}

function req (bool $toArray = false) {
  return Route::request($toArray);
}

function redirect ($to = '/') {
  if (!headers_sent()) {
    header('location: '. $to);
    die();
  }
}

function goBack() {
  if (isset($_SERVER['HTTP_REFERER'])) redirect($_SERVER['HTTP_REFERER']);
  else redirect();
}

function config ($data) {
  return Config::get($data);
}

function session ($data = '', $set = '', $c = false) {
  if (!$data) {
    return Session::get();
  } else {
    if (!$set) {
      return Session::get($data);
    } else {
      if (!$c) {
        Session::set($data, $set);
      } else {
        Session::set($data, $set, $c);
      }
    }
  }
}

function redirectLogin () {
  if (!empty(authId()))
    if (stripos($_SERVER['SCRIPT_NAME'], 'login'))
    goBack();
}

function error($msg = '', $info = 'Internal server error!', $status = 500) {
  if (ob_get_contents()) ob_end_clean();

  // set the status code header!
  Http::responseStatus($status);

  // if its ajax request return json format of the error
  if (Http::is_ajax()) return res(['code' => 0, 'msg' => $msg], $status);

  // else return gui
  $e = (object) ['code' => $status,
    'info' => $info,
    'msg' => $msg];
  if (config('error/page') === 'default') require_once 'template/error/error.php';
  else require_once config('error/page');
  die();
}

function getCookie ($name = '') {
  return Session::getCookie($name);
}

function setCookies ($name, $val, $c = true) {
  Session::setCookie($name, $val, $c);
}

function includeView ($path) {
  if (isset($GLOBALS['view'])) {
    $variable = $GLOBALS['view'];
    for ($i = 0; $i < count($variable); $i++) {
      $var = array_keys($variable)[$i];
      $$var = array_values($variable)[$i];
    }
  }
  $__toRender = ROOT . 'views/subviews/' . $path . '.lyt.php';
  if (!file_exists($__toRender)) error('Cannot find subview '. $path);
  $__toRender = file_get_contents($__toRender);
  $__toRender = str_replace(['<*', '*>'], ['<?php', '?>'], $__toRender);
  echo eval("?> $__toRender <?php");
}

function logtext ($logText, $type = 'info') {
  Logger::log($logText, $type);
}

function isAjax () {
  return Http::is_ajax();
}

function addViews ($table, $view, $to, $col = 'views') {
  $d = new Db();
  $d->table($table)->set([$col], [$view + 1])->where($to)->res();
}

function inUri($str) {
  if (stripos($_SERVER['REQUEST_URI'], $str) !== false) return true; else return false;
}

function uuid($l = 20) {
  if (!is_numeric($l)) error('The uuid function requires an integer parameter');
  return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-', $l)), 1, $l);
}

function sendMail ($subject, $to, $template, $from = '') {
  if (!isset($subject, $to, $template)) error('Missing parameter!', 'sendMail error!', 500);
  $m = (new Xender())->sub($subject)->sendTo($to)->template($template)->send($from);

  if ($m) return true; else return false;
}
