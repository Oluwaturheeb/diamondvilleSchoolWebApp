<?php
namespace App;

use Devtee\Tlyt\Components\Route as route;
use App\Controllers\TeachersController as Tee;
use App\Controllers\studentController;

$t = new Tee();
route::get('/teacher-dashboard',  [Tee::class, 'index']);
route::get('/teacher/add-student',  [studentController::class, 'addStudent']);
route::get('/teacher/students/_?class/_?dept',  [Tee::class, 'students']);
route::post('/teacher/student/result',  [Tee::class, 'result']);
route::get('/teacher/profile',  [Tee::class, 'profile']);
route::post('/teacher/profile/update',  [Tee::class, 'profileUpdate']);
