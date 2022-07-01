<?php
namespace App\Controllers;

use Devtee\Tlyt\Components\BaseController;
use Devtee\Tlyt\Components\Authentication as Auth;
use Devtee\Tlyt\Components\Session;
use Devtee\Tlyt\Components\Db;
use Devtee\Tlyt\Components\Xender;

class IndexHandler extends BaseController {
  public function index () {
    return $this->render('index');
  }

	public function gallery () {
		return $this->render('gallery');
	}

  public function login () {
    return $this->render('/login');
  }

  public function loginHandler () {
    $login = (new Auth())->login(remember: (isset($this->remember))? false : true);
    if ($login->code == 1) {
			if (auth()->type == 1) $red = '/admin-dashboard'; elseif(auth()->type == 2) $red = '/teacher-dashboard'; else $red = '/dashboard';
      $login->redirect = $red;
			$code = 200;
    } else $code = 412;
    return $this->jsonResponse($login, $code);
  }

  public function logout () {
    Session::del();
    Session::delCookie('authId');
    redirect('/login');
  }

  public function register () {
    return $this->render('teacher/register');
  }

	public function addTeacher () {
		$this->validate([
			'email' => ['required' => true, 'email' => true],
			'password' => ['required' => true, 'min' => 8]
		]);

		if (!$this->pass()) return $this->jsonResponse(['code' => 0, 'msg' => $this->error()]);

		$a = (new Auth())->reg(append: [['type'], [2]]);
		if ($a['code'] == 0) $a['msg'] = 'Email is already registered!';
		else {
		  $x = new Xender();
		  $x->subject('Welcome to DiamondVille')->template('mail/teacher', ['body' => req()])->sendTo($this->email)->send('DiamondVille');

			(new Db('teacher'))->add(['a_id'], [authId()])->res();
			$a['redirect'] = '/teacher/profile';
		}

		return $this->jsonResponse($a);
	}

	public function studentProfile() {
header('Cache-Control: no-store');
	  if (!session('who')) redirect('/dashboard');
	  $d = new Db('student');
	  $student = $d->get()->where($this->id)->res(1);
	  $data = $d->table('score')->get()->where(['a_id', $student->a_id])->sort('class, subject', 'asc')->res();

	  $this->render('studentProfile', [
	    'data' => $data,
	    'auth' => session('who'),
	    'student' => $student
	  ]);
	}

	public function fileUploader () {
	  $type = $this->type;
	  $pic = $this->uploader('imageFile')
	  ->uploadTo('assets/img/' . $type . '/');

	  session($type, $pic);
	  return $this->jsonResponse(['code' => 1, 'img' => $pic]);
	}
}
