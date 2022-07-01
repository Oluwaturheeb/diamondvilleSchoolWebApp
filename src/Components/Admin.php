<?php
namespace Devtee\Tlyt\Components;

if (APP === req('admin') || getCookie('admin')):
    Xender::processTemplate($_SERVER['SCRIPT_FILENAME']);
endif;