<?php
/** 
 ************************************************************
 * Load Composer class autoloader                           *
 ************************************************************
 */
 
require_once __DIR__. './../vendor/autoload.php';

/** 
 ************************************************************
 * Require tlyt bootstrap file here!                        *
 * pass the document root here!                             *
 ************************************************************
 */

use Devtee\Tlyt\Components\Bootstrap as boot;
boot::applicationBootstrap(dirname(__dir__));