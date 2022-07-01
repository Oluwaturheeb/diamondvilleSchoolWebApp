<?php
namespace App;

use Devtee\Tlyt\Components\Route as route;
use App\Controllers\IndexHandler;
use App\Controllers\NewController;

$index = new IndexHandler();
route::get('/mail', function () {
  $body = 'Hello wprld';
  $GLOBALS['view'] = ['body' => $body];
  includeView('mail/mail');
});
route::get('/', [$index::class, 'index']);
route::get('/gallery', [$index::class, 'gallery']);
route::get('/login', [$index::class, 'login']);
route::post('/login', [$index::class, 'loginHandler']);
route::get('/logout', [$index::class, 'logout']);
route::get('/student/__id', [$index::class, 'studentProfile']);
route::get('/teacher/register',  [$index::class, 'register']);
route::post('/uploader', [$index::class, 'fileUploader']);
route::post('/teacher/add-teacher', [$index::class, 'addTeacher']);

// admin routes
require 'admin.php';

// teachers routes
require 'teachers.php';

//student routes
require 'student.php';
route::fallBack();
