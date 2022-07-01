<?php
namespace App\Controllers;

use Devtee\Tlyt\Components\BaseController;
use Devtee\Tlyt\Components\Db;
use Devtee\Tlyt\Components\Crud;
use Devtee\Tlyt\Components\Utils;
use Devtee\Tlyt\Components\Request;
use Devtee\Tlyt\Components\Xender;
use Devtee\Tlyt\Components\User;

class AdminController extends BaseController{
  public function __construct () {
    authCheck('/login');
    if (isset(auth()->type)) {
  	  if (auth()->type == 1) {
  	    if (!session('who')) session('who', User::fromDb(['a_id', authId()], 'teacher'));
  	  } elseif (auth()->type > 1 && inUri('/admin')) goBack();
	  }
  }

  public function index () {
    $d = new Db();
    $auth = session('who');
    $count = $d->customQuery("
      select
      (select count('id') from teacher where id != ?) as tcount,
      (select count('id') from student) as scount
    ", [$auth->id])->res(1);
    $teachers = $d->table('teacher')->get(['id', 'class', 'fullname', 'pre', 'picture'])
    ->where(['id', '!=', $auth->id])
    ->sort('id')->pages(10)->res();
    $events = $d->table('event')->get()->res();

    return $this->render('admin/index', [
      'tcount' => $count->tcount,
      'scount' => $count->scount,
      'teachers' => $teachers,
      'events' => $events,
      'auth' => session('who')
    ]);
  }
  
  public function setSession () {
    $c = (new Db('event'))->set(['content'], [$this->filter($this->session)])->where(['type', 'Session'])
    ->res();
    return $this->jsonResponse(['code' => 1, 'msg' => 'Session has been updated successfully!']);
  }

	public function rmTeacher () {
    if (!is_numeric($this->id)) return;

		$del = (new Db())->customQuery('delete from teacher, auth using auth inner join teacher on a_id = auth.id where teacher.id = ?', [$this->id])->res();
		if ($del) $this->jsonResponse(['code' => 1, 'msg' => 'Account has been removed successfully!']);
		else $this->jsonResponse(['code' => 0, 'msg' => 'Unknown error, try again!']);
	}

  public function addStudent () {
    return $this->render('admin/add-student', ['auth' => session('who')]);
  }

  public function teachers () {
    $d = new Db('teacher');
    $teachers = $d->get(['id', 'class', 'fullname', 'pre', 'picture'])
    ->where(['id', '!=', session('who')->id])
    ->pages(20, (isset($this->more))? $this->more : 1)->res();

    return $this->render('admin/teachers', ['teachers' => $teachers, 'auth' => session('who'), 'next' => $d->next]);
  }

  public function students () {
    if (!req()->class) return $this->render('admin/students', ['auth' => session('who')]);
    $d = new Crud('student');
    $students = $d->fetch()->exec();
    return $this->render('admin/students', ['students' => $students, 'auth' => session('who')]);
  }

  public function notty () {
    return $this->render('/admin/notty', [
      'auth' => session('who')
    ]);
  }

	public function studentAction () {
		$this->validate([
			'action' => ['required' => true],
			'class' => ['required' => true],
			'student' => ['required' => true, 'multiple' => true]
		]);

		if (!$this->pass()) error($this->error(), status: 412);

    $d = new Db('student');

		switch ($this->action) {
			case 'Promote':
				$d->set(['class', 'dept'], [$this->class, $this->dept]);
			break;
			case 'Suspend':
				$d->set(['active'], [0]);
				break;
			case 'Unsuspend':
				$d->set(['active'], [1]);
				break;
		}

		$d->whereIn('id', $this->validated->student)->res();

		if ($d->count()) $this->jsonResponse(['code' => 1, 'msg' => 'Action has been set successfully!']);
		else $this->jsonResponse(['code' => 0, 'msg' => 'Unknown error occured, try again!']);
	}

  public function sendNotty () {
    $d = new Db();

    // $this->channel 1 => all, 2 => email, 3 => sms
  	if ($this->channel == 1) $col = ['phone', 'email'];
	  elseif ($this->channel == 2)  $col = 'email';
  	else $col = 'phone';

  	switch ($this->class) {
  		case 'All':
  		  if ($this->channel == 1) $col = ['email', 'teacher.phone as tphone', 'student.phone as sphone'];
  		  elseif ($this->channel == 3) $col = ['teacher.phone as tphone', 'student.phone as sphone'];
  		  $d->table('auth')->get($col)
  		  ->join('teacher', ['teacher.a_id', 'auth.id'], 'left')
  		  ->join('student', ['student.a_id', 'auth.id'], 'left');
  			break;
  		case 'Students':
  		  if ($this->channel == 1) $col = ['phone', 'email'];
  			$d->table('student')->get($col)
  			->join('auth', ['a_id', 'auth.id'], 'left');
  			break;
  		case 'Teachers':
  			$d->table('teacher')->get($col)
  			->join('auth', ['a_id', 'auth.id'], 'left');
  			break;
  		default:
  			$d->table('student')->get($col)->join('auth', ['a_id', 'auth.id'], 'left')->where(['class', $this->class]);
  			break;
  	}

  	// execute the query
  	$phone = $d->res();
  	if (!$d->count()) res(['code' => 0, 'msg' => 'No matches found!']);
  	$tel = Utils::collection($phone, ['phone', 'tphone', 'sphone'], 'email');
  	$email = $tel['email'];
  	$tel = $tel['phone'];

  	$api = new Request('https://www.bulksmsnigeria.com/api/v1/sms/create');
  	$x = new Xender();
  	$res = $api->method('post')
  	->body(
  	  ['api_token', 'to', 'from', 'body'],
  	  ['Z8qGCYch7hkqCisKHnqcqvBnhpOtjXthVZCVB5Z5NLG9oHLTgHZ48s9Taxgt', implode(',', $tel), 'DVS MOWE', $this->notty]
  	);
  	$x->subject($this->subject .' - DiamondVille')->template('mail/mail', ['body' => req()])
  	->sendTo($email);

  	switch ($this->channel) {
  	  case 1:
  	    $res->send();
  	    $x->send();
  	    break;
  	  case 2:
  	    $x->send();
  	    break;
  	  case 3:
  	    $res->send();
  	}

  	return $this->jsonResponse(['code' => '1', 'msg' => 'Done!', 'redirect' => '/admin-dashboard']);
  }
}
