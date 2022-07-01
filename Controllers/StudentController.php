<?php
namespace App\Controllers;

use Devtee\Tlyt\Components\BaseController;
use Devtee\Tlyt\Components\Authentication as Auth;
use Devtee\Tlyt\Components\Db;
use Devtee\Tlyt\Components\Crud;
use Devtee\Tlyt\Components\User;
use Devtee\Tlyt\Components\Utils;
use Devtee\Tlyt\Components\Xender;

class StudentController extends BaseController{
	public function __construct () {
	  authCheck('/login');
	  if (auth()->type == 3) 
	    if (!session('who')) session('who', User::fromDb(['a_id', authId()], 'student'));
	}
	
	public function index () {
	  $d = new Db();
    $ward = $d->table('student')->get()
    ->where(['a_id', authId()])->res();
    $events = $d->table('event')->get()->res();
    $count = $d->customQuery("
      select 
      (select count('id') from teacher where id != ?) as tcount,
      (select count('id') from student) as scount
    ", [1])->res(1);
    
    return $this->render('student/index', [
      'tcount' => $count->tcount,
      'scount' => $count->scount,
      'students' => $ward,
      'events' => $events,
      'auth' => session('who')
    ]);
    return $this->render('student/index', [
      'students' => $teachers,
      'events' => $events,
      'auth' => session('who')
    ]);
	}
	
  public function addStudent () {
    return $this->render('admin/add-student', ['auth' => session('who')]);
  }
	
	public function addStudentPost () {
    $this->validate([
      'pre' => ['required' => true, 'name' => 'Prefix'],
      'fullname' => ['required' => true, 'wordcount' => 2],
      'dob' => ['required' => true],
      'hadd' => ['required' => true, 'name' => 'Address'],
      'gender' => ['required' => true],
      'class' => ['required' => true],
      'email' => ['required' => true, 'email' => true],
      'p_name' => ['required' => true, 'name' => 'Parent name'],
      'phone' => ['required' => true]
    ]);

    // handle errors
    if (!$this->pass()) return $this->jsonResponse(['code' => 0, 'msg' => $this->error()]);
    if (!session('student')) return $this->jsonResponse(['code' => 0, 'msg' => 'For identification purposes, kindly take a picture of the student!']);

    // proceed
    $pwd = $this->_hash(req()->email, 8);
    $d = new Db('auth');

    $res = $d->add(
      ['email', 'password', 'type'],
      [req()->email, $this->hash($pwd), 3],
			true
    )->res();
    if ($res != 0) {
      $x = new Xender();
		  $x->subject('Welcome to DiamondVille')->template('mail/student', ['body' => req(), 'password' => $pwd])->sendTo($this->email)->send('DiamondVille');
  	} else $res = $d->table('auth')->get('id')
    ->where(['email', $this->email])->res(1)->id;

    $c = new Crud('student');
    $c->remove(['email', '__csrf', 'file'])
    ->append(
      ['a_id', 'age', 'picture'],
      [$res, Utils::age($this->dob), session('student')]
    )
    ->create()->exec();

    if ($c->error()) return $this->jsonResponse(['code' => 0, 'msg' => $c->error()]);
    else return $this->jsonResponse(['code' => 1, 'msg' => 'Student added!']);
  }
}
