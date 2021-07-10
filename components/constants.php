<?php
// require_once 'social.php';

define('GET', 'get');
define('POST', 'post');
define('PUT', 'put');
define('HOST', $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST']);
// define('FBURL', $fURL);
// define('FPROFILE', $fProfile);
// define('GURL', $gURL);
// define('GPROFILE', $gProfile);
define('NUM', 1);
define('STR', 2);
define('ARR', 3);
define('OBJ', 4);
define('AUTHID', authId());

$pn = config('project/name');
define('APP', $pn);