<?php
namespace Devtee\Tlyt\Components;
$scheme = (isset($_SERVER['REQUEST_SCHEME'])) ? $_SERVER['REQUEST_SCHEME'] : 'http';
define('GET', 'get');
define('POST', 'post');
define('PUT', 'put');
define('HOST', $scheme .'://'. $_SERVER['HTTP_HOST']);
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