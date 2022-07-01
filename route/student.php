<?php
namespace App;

use Devtee\Tlyt\Components\Route as route;
use App\Controllers\StudentController as Admin;

route::get('/dashboard', [Admin::class, 'index']);
route::post('/student/add-student/post', [Admin::class, 'addStudentPost']);
