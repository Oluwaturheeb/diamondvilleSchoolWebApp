<?php
namespace App;

use Devtee\Tlyt\Components\Route as route;
use App\Controllers\AdminController as Admin;

$admin = new Admin();
route::get('/admin-dashboard', [$admin::class, 'index']);
route::get('/admin/session/__session', [$admin::class, 'setSession']);
route::get('/admin/notification', [$admin::class, 'notty']);
route::get('/admin/add-student', [$admin::class, 'addStudent']);
route::get('/admin/rm-teacher/__id', [$admin::class, 'rmTeacher']);
route::get('/admin/students/_?class/_?dept', [$admin::class, 'students']);
route::get('/admin/teachers/_?more', [$admin::class, 'teachers']);
route::get('/admin/payments', function () {
	return '<hi>Coming soon!</h1>';
});
route::post('/admin/send-notification', [$admin::class, 'sendNotty']);
route::post('/admin/student/action', [$admin::class, 'studentAction']);
