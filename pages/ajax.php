<?php
$a = new Auth();
$d = Db::instance();
$u = new Utils();
$v = new Validate();

function attendance ($id) {
	$d = new Db();
	// $d->errorSafe();
	$sub = $d->table('subject')
	->get('subject')->where(['dept', req('dept')])->res(1);

	if (!is_array($id)) {
		foreach (explode(', ', $sub->subject) as $s) {
			$d->table('attendance')
			->add(['subject', 'a_id', 'session'], [$s, $id, session('session')])->res();
		}
	} else {
		foreach ($id as $value) {
			foreach (explode(', ', $sub->subject) as $s) {
				$d->table('attendance')
				->add(['subject', 'a_id', 'session'], [$s, $value, session('session')])->res();
			}
		}
	}
}

if (req('verify')) {
	res($a->chpwd(['password', 'verify'], AUTHID));
}

// adding teachers and students from admin view;
if (req('create')) {
	// auto validate all request and return error!
	if (req('create') == 'teacher') {
		$type = 2;
		$password = 'default000';
	} else {
		$password = substr(Validate::_hash($u->gen(STR)),  0, 8);
		$type = 3;
		
		switch (req('class')) {
			case 'Jss 1':
				$fee = 10000;
				break;
			case 'Jss 2':
				$fee = 15000;
				break;
			case 'Jss 3':
				$fee = 18000;
				break;
			case 'Sss 1':
				$fee = 20000;
				break;
			case 'Sss 2':
				$fee = 21000;
				break;
			case 'Sss 3':
				$fee = 25000;
				break;
		}
	}
	// $d->errorSafe();
	$d->table('auth');
	$id = $d->add(
		['email', 'password', 'type'], 
		[req('email'), Validate::hash($password), $type]
	)->res();
	
	if ($d->error()) {
		res('There is an account with the provided email address');
	} else {
		$c = new Crud(req('create'));
		$c->create()
		->remove(['email', 'create'])
		->append(['age', 'a_id'], [$u->age(req('dob')), $id]);

		if (req('create') == 'student') {
			$c->append(['pin'], [$password]);
		} else {
			$c->remove(['subject', 'class'])
			->append(
				['subject', 'class'], 
				[$u->arr2str(req('subject')), $u->arr2str(req('class'))]
			);
		}
		$c->exec();
		if ($c->error()) {
			res($c->error());
		} else {
			if (req('create') == 'student') {
				attendance($id);
				$d->table('fees')
				->add(['a_id', 'fees', 'session', 'status'], [$id, $fee, session('session'), 'false'])->res();
			}
			res(['msg' => 'Account created!', 'redirect' => '/admin', 'code' => 1]);
		}
	}
}

if (req('type') == 'add-subject') {
	$c = new Crud('subject');
	$c->create()->with('remove', ['type'])
	->exec();

	if ($c->error()) res('Subject has already been created for this class');
	else res(['code' => 1,'msg' => 'Done!']);
}
	
//setting exam 
if (req('type') == 'exam') {
	$c = new Crud('exam');
	$un = $d->table('exam')->get()
	->where(['subject',  req('subject')], ['class',  req('class')])->res(1);

	if (!$un) {
		// insert
		$opt = [
			$u->arr2str(req('question'), '***EXAM***'),
			$u->arr2str(req('answer'), '***EXAM***'),
			$u->arr2str(req('opt_a'), '***EXAM***'),
			$u->arr2str(req('opt_b'), '***EXAM***'),
			$u->arr2str(req('opt_c'), '***EXAM***'),
			$u->arr2str(req('opt_d'), '***EXAM***')
		];
		$c->create()
		->with('remove', ['type', 'question', 'answer', 'opt_a', 'opt_b', 'opt_c', 'opt_d'])
		->with('append', ['question', 'answer', 'opt_a', 'opt_b', 'opt_c', 'opt_d'], $opt);
	} else {
		// update
		$opt = [
			$un->question . '***EXAM***' . implode('***EXAM***',  req('question')),
			$un->answer . '***EXAM***' . implode('***EXAM***',  req('answer')),
			$un->opt_a . '***EXAM***' . implode('***EXAM***',  req('opt_a')),
			$un->opt_b . '***EXAM***' . implode('***EXAM***',  req('opt_b')),
			$un->opt_c . '***EXAM***' . implode('***EXAM***',  req('opt_c')),
			$un->opt_d . '***EXAM***' . implode('***EXAM***',  req('opt_d'))
		];
		$c->update()
		->with('remove', ['type', 'question', 'answer', 'opt_a', 'opt_b', 'opt_c', 'opt_d'])
		->with('append', ['question', 'answer', 'opt_a', 'opt_b', 'opt_c', 'opt_d'], $opt);
	}
	$c->exec();
	session::del('questionSet');
	if($c->error()) res(['code' => 0, 'msg' => $c->error()]);
	else res(['code' => 1, 'msg' => 'Done']);
}

	// submitting exam
if (req('type') == 'exam-submit') {
	// getting all needed sessions
	$u = session('student');
	$cls = $u->class;
	$sub = session('subject');
	$ses = session('session');
	$user = AUTHID;
	
	// getting answer from exam table
	$d->table('exam');
	$ans = $d->get('answer')
	->where(['class', $cls], ['subject', $sub])
	->res(1);

	$ans = explode('***EXAM***', $ans->answer);
	$exam = req('exam-ans');
	
	if ($exam) $sc = count($ans) - count(array_diff_assoc($ans, $exam));
	else $sc = 0;

	// check against the supplied answer
	$sc .= ' / ' . count($ans);
	//getting student data from score table
	$d->table('score');
	$sq = $d->get('data')
	->where(
		['a_id', $user],
		['session', $ses],
		['class', $cls]
	)
	->res(1);

	$data = ['subject' => $sub, 'score' => $sc];

	if ($d->count()) {
		// this means update
		$score = Utils::djson($sq->data, ARR);
		$score[] = $data;
		$data = Utils::json($score);
		$d->set(['data'], [$data])
		->where(
			['a_id', $user],
			['session', $ses],
			['class', $cls]
		)->res();
	} else {
		// this means creating a new data;
		$data = Utils::json([$data]);
		$d->add(['data', 'a_id', 'session', 'class'], [$data, $user, $ses, $cls])->res();
	}
	
	// marking attendance for d subject done 
	$d->table('attendance')
	->set(['sit'], [1])
	->where(
		['a_id', $user], ['subject', $sub]
	)->res();
	
	res(['code' => 1, 'msg' => 'Submitted']);
}
	
	// gett8ng profile
if (req('profile')) {
	$r = $d->table(req('acc'))
	->get('fullname as name', 'email', 'dob', 'age', 'hadd', 'picture', 'pre')
	->join('auth', ['a_id', 'auth.id'], 'left')
	->where(['a_id', req('profile')])
	->res(1);

	if (!$d->count()) res(['code' => 0, 'msg' => 'Account not found']);

	$dob = explode(' ', $r->dob)[0];
	$res = <<<__here
	<div class='fetch'>
		<header>
			<div class='profile-img'>
				<img src='$r->picture' alt='$r->name' class='img-thumbnail'>
			</div>
			<h4>$r->pre. $r->name</h4>
		</header>
		<div class='profile-details'>
			<b>Email</b>
			<p class='icon'>
					$r->email <a href='mailto:$r->email'><img src='assets/img/email.png' width='1rem'></a>
			</p>
			<b>Date Of Birth</b>
			<p>$dob ($r->age)</p>
			<b>Address</b>
			<p>$r->hadd</p>
		</div>
	</div>
__here;

	res(['code' => 1, 'payload' => $res]);
}

// other side

if (req('type') == 'session' || req('type') == 'exams' || req('type') == 'result') {
	$c = new Crud('event');
	$unique = $c->unique('type');
	
	if (!$unique) $c->create()->exec();
	else $c->update()->remove(['type'])->where(['type', req('type')])->exec();

	if ($c->error()) res(['code' => 0, 'msg' => $c->error()]);

	if (req('type') == 'session') session('session', req('content'));

	// updating session for attendance
	if (req('type') == 'session') $d->table('attendance')->set(['session', 'sit'], [req('content'), 0])->res();
	res(['code' => 1, 'msg' => 'Done!', 'redirect' => '/admin']);
}

if (req('type') == 'delete-event') {
	$c = new Crud('event');
	$c->delete()->remove(['type'])->exec();
	if ($c->count()) res(['code' => 1, 'msg' => 'Done!', 'redirect' => '/admin']);
	else res($c->error());
}

if (req('type') == 'score') {

	$c = new Crud('student');
	$ss = $c->fetch(
		'fullname as name', 'a_id'
	)
	->remove(['type'])
	->sort('name')
	->exec();

	if (!$c->count()) res(['code' => 0, 'msg' => 'No result found for '. req('class')]);
	// do something for the found result

	$rep = '';
	foreach ($ss as $s) {
		// get student name
		$name = $s->name;

		// get score 
		$sc = $d->table('score')->get('data', 'session')
		->where(['a_id', $s->a_id])
		->res();

		// initiallizing variables needed in the loop
		$th = $td = $tr = $thh = '';
		if (!$d->count()) {
			$rep = '<div class="h3 my-3"><a href="student/' .$s->a_id .'">'.$name.'</a></div><table><tr><td colspan="5">There is no report found for '.$s->name.' in this class!</td></tr></table>';
		} else {
			// looping through the score data!;
			foreach ($sc as $key) {
				$data = Utils::djson($key->data);
				for ($i = 0, $count = count($data); $i < $count; $i++) {
					$session = $key->session;
					$th .= "<th>{$data[$i]->subject}</th>";
					$td .= "<td>{$data[$i]->score}</td>";
				}

				$thh = "<thead><th>Session</th> {$th}</thead>";
				$th = '';
				
				$tr .= "<tr><td> {$session} </td> {$td} </tr>";
				$td = '';
			}
			$rep .= <<<__here
			<div class='h3 my-3'><a href='student/$s->a_id'>$name</a></div>
			<table class='table table-stripe'>
				<thead>
					$thh
				<tbody>
					$tr
				</tbody>
			</table>
__here;
		}
	}
	res(['code' => 1, 'data' => $rep]);
}

if (req('action')) {
	$req = req('action');
	$c = new Crud('student');
	if ($req == 'Promote') {
		// promotion
		$c->update()->remove(['a_id', 'action'])->with('append', ['active'], [0])->whereIn('a_id', req('a_id'))->exec();
		
		if (!$c->count()) res(['code' => 0, 'msg' => 'Unknown error occurred, try again!']);
			// delete old attendance!
		$d->table('attendance')->rm()->whereIn('a_id', req('a_id'))->res();
		//set new 
		attendance(req('a_id'));
		res(['code' => 1, 'msg' => 'Done!', 'redirect' => '/admin']);
	} elseif ($req == 'Remove') {
		// delete all attendance since it wont be needed in both cases of promote and remove!
		$d->table('attendance')->rm()->whereIn('a_id', req('a_id'))->res();
		
		// removing 
		$c->update()->remove()->append(['active'], [1])->whereIn('a_id', req('a_id'))->exec();
		if (!$c->count()) res(['code' => 0, 'msg' => 'Unknown error occurred, try again!']);
		else res(['code' => 1, 'msg' => 'Done!', 'redirect' => '/admin']);
	}
}

// sending notification
if (req('selected')) {
	switch (req('selected')) {
		case 'All':
			$d->table('student')->get('phone')->union('teacher', 'phone');
			break;
		case 'Students':
			$d->table('student')->get('phone');
			break;
		case 'Teachers':
			$d->table('teacher')->get('phone', 'id');
			break;
		default:
			$d->table('student')->get(['phone'])->where(['class', req('selected')]);
			break;
	}
	// execute the query
	$phone = $d->res();
	if (!$d->count()) res(['code' => 0, 'msg' => 'No matches found for your query!']);
	
	$col = Utils::collection($phone, 'phone');
	$to = implode(',', $col);
	$api = new APIRequest();
	$res = $api->url('https://www.bulksmsnigeria.com/api/v1/sms/create')->method('post')->body(['api_token', 'to', 'from', 'body'], ['Z8qGCYch7hkqCisKHnqcqvBnhpOtjXthVZCVB5Z5NLG9oHLTgHZ48s9Taxgt', $to, 'DVS MOWE', req('notty')])->send();
	res(['code' => '1', 'msg' => 'Done!', 'redirect' => '/admin']);
}

// fees 
/* 
if (req('sid')) {
	$id = authId();

	// get the email associated to the acc
	$mail = $d->table('auth')
	->get('email')
	->where(['id', $id])->res(1);

	if (!$d->count()) res(['code' => 0, 'msg' => 'Student ID provided is not valid!']);

	$email = $mail->email;
	
	$f = $d->table('student')
	->get()
	->where(['pin', $a->req('sid')])
	->res(1);
	
	if (!$d->count()) {
			res('The provided Student Id is invalid');
	} else {
		if ($id !== $f->a_id) {
				res('The student id provided does not fall under your guardianship.');
		} else {
			// another query to get fees to pay!
			$fee = $d->table('fees')
			->get()
			->where(['status', 'false'], ['a_id', $id])
			->res();
			
			if (!count($fee)) {
					res('All fees has been cleared, thank you!');
			} else {
				foreach ($fee as $e) {
					//do something 
					//echo $e;
				}
			}
		}
	}
} */

if ($_FILES) {
	if (req('student')) $tab = 'student';
	else $tab = 'teacher';

	$img = $v->uploader('img')->complete_upload('assets/img/'. $tab . '/');
	
	$d->table($tab)
	->set(['picture'], [$img])
	->where(['a_id', req($tab)])
	->res();

	if ($e->count()) res(['code' => '1', 'msg' => 'Account updated!', 'redirect' => '/admin']);
	else res($c->error());
}