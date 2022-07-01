<?php
namespace App\Controllers;

use Devtee\Tlyt\Components\BaseController;
use Devtee\Tlyt\Components\User;
use Devtee\Tlyt\Components\Db;
use Devtee\Tlyt\Components\Crud;
use Devtee\Tlyt\Components\Utils;
use Devtee\Tlyt\Components\Xender;

class TeachersController extends BaseController {
  public function __construct () {
	  authCheck('/login');
	  if (isset(auth()->type)) {
  	  if (auth()->type == 2) {
  	    if (!session('who')) session('who', User::fromDb(['a_id', authId()], 'teacher'));
  	  } elseif (auth()->type != 2 && inUri('/teacher/') || inUri('/teacher-dashboard')) goBack();
	  }
	}

  public function index () {
    $count = (new Db())->customQuery("
      select
      (select count('id') from teacher where id != ?) as tcount,
      (select count('id') from student) as scount
    ", [1])->res(1);
    return $this->render('teacher/index', [
      'auth' => session('who'),
      'tcount' => $count->tcount,
      'scount' => $count->scount,
      'events' => (new Db('event'))->get()->res()
    ]);
  }

  public function students () {
    if (!req()->class) return $this->render('admin/students', ['auth' => session('who')]);
    $d = new Crud('student');
    $students = $d->fetch()->exec();
    return $this->render('admin/students', ['students' => $students, 'auth' => session('who')]);
  }

  public function result () {
    $req = req(1);
		$classId = [$this->class,$this->student_id];
		$new = Utils::multiToAssoc($req);

		$columns = array_merge(array_slice($new['keys'], 0, 4), ['class', 'a_id']);
    $values = array_map(function ($arr) use($classId) {
			return array_merge($arr, $classId);
		} , $new['value']);
		
		if (count($values) == 1) $values = $values[0];
		$res = (new Db('score'))->add($columns, array_values($values))->res();
		if ($res) $res = ['code' => 1, 'msg' => 'Result has been set successfully!'];
		else $res = ['code' => 0, 'msg' => 'Unknown error, try again!'];
    return $this->jsonResponse($res);
	}

	public function profile () {
		return $this->render('teacher/profile', [ 'auth' => session('who'),]);
	}

	public function profileUpdate () {
    $this->validate([
      'pre' => ['required' => true, 'name' => 'Prefix'],
      'fullname' => ['required' => true, 'wordcount' => 2],
      'dob' => ['required' => true],
      'hadd' => ['required' => true, 'name' => 'Address'],
      'class' => ['required' => true, 'multiple' => true],
      'email' => ['required' => true, 'email' => true],
      'subject' => ['required' => true, 'name' => 'subject'],
      'phone' => ['required' => true],
    ]);

    // handle errors
		if (!$this->pass()) return $this->jsonResponse(['code' => 0, 'msg' => $this->error()]);
    if (!session('teacher')) return $this->jsonResponse(['code' => 0, 'msg' => 'For identification purposes, kindly take a picture of yourself!']);

    // proceed
		$c = new Crud('teacher');
    $c->remove(['email', 'class', '__csrf'])->append(['class', 'picture'], [implode(',', $this->class), session('teacher')])
    ->update(['a_id', authId()]);
		$c->exec();
		
		if ($c->error()) return $this->jsonResponse(['code' => 0, 'msg' => $c->error()]);
		else {
			session('who', User::fromDb(['a_id', authId()] ,'teacher'));
			$this->jsonResponse(['code' => 1, 'msg' => 'Profile updated!']);
		}
	}
}
