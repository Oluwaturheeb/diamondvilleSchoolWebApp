<?php
authCheck('/login');

if (!session('level'))
	if (auth())
		session('level', auth()->type);
	
//user level
$level = session('level');
if ($level > 2 || empty($level))
	redirect('/student');

// calling our classes
$d = Db::instance();

// fetching subjects
$sub = $d->table('subject')
->get(['subject'])
->where(['subject', '!=', ''])->res();
$sub = explode(', ', Utils::collection($sub, 'subject')[0]);


// getting the current session
if (!session('session')) {
	$events = $d->table('event')
	->get()
	->where(['type', '!=', ''])->res();
	
	//get events in session to avoid  going to the db everytime
	session('events', $events);
	foreach ($events as $key) {
		if ($key->type == 'session') {
			$c_ses = $key->content;
		}
	}
	
	if (!isset($c_ses)) {
		$c_ses = 'Current session unknown!';
	} else {
		session('session', $c_ses);
	}
} else {
	$c_ses = session('session');
}

// get user info from session 
if (!session('user'))  {
	$p = $d->table('teacher')->get()->where(['a_id', AUTHID])->res(1);
	$p = session('user', $p);
}

$p = session('user');

// getting current user data from auth
$u = auth();

// attend to req
if (req()) {
	if (req(['class', 'dept'])) {
        $c = new Crud('student');

        $c->fetch('fullname', 'a_id', 'class', 'picture', 'pin');

        // checking if the class value hold removed student
        if (req('class') == 'Removed')
            $c->with('remove')->append(['active'], [1]);
        else
            $c->append(['active'], [0]);
            
        $sd = $c->sort('fullname', 'asc')
        ->pages(10, 'more')->exec();
	}
} else $sd = null;

callfile('inc/header', 'Admin panel');
?>
<div class='hidden'>
    <div class='col-12 col-sm-10 profile'>
        <span class='close'>&times;</span>
    </div>
</div>

<div class='col-12 mt-5'>
    <div class='header'>
        <img src="<?php echo $p->picture ?>" style="border-radius: 100%">
        <div>
            <b><?php echo $p->pre, '. ', $p->fullname ?></b>
            <i><?php echo $p->subject ?></i>
            <small><i><?php echo $p->class ?></i></small>
        </div>
    </div>
    <div class='mt-4 p-3 col-11 mx-auto'>
        <div class="d-flex">
            <i class="icofont-info-circle"></i>
            <div id="admin-info">
                <i><?php echo Utils::datetime(), ' <br/> ', $c_ses; ?></i>
            </div>
        </div>
    </div>
</div>

<div class='col-11 col-sm-9 <?php if ($level == 2): ?> col-md-10 <?php else: ?> col-md-8 col-lg-6 <?php endif ?> mx-auto mt-3 px-5 py-3'>
    <div class='action'>
        <!-- entry point -->
        <?php if ($level == 1): ?>
        <div class="entry">
            <?php
				$d->table('teacher')->get('id')->where(['a_id', '!=', authId()])->res();
				$aT = $d->count();
				$d->table('student')->get('id')->where(['a_id', '!=', authId()])->res();
				$aS = $d->count();
			?>
            <div class="mb-5">
                <h2>Admin Panel</h2>
            </div>
            <!-- <div class="container"> -->
                <div class="row">
                    <div class="col-10 col-sm-5 mx-auto entries">
                        <div class="text-center">
                            <h3>Teachers</h3>
                            <span><?= $aT ?></span>
                        </div>
                        <i class="icofont-users-alt-3"></i>
                    </div>
                    <div class="col-10 col-sm-5 mx-auto entries">
                        <div class="text-center">
                            <h3>Students</h3>
                            <span><?= $aS ?></span>
                        </div>
                        <i class="icofont-users-alt-2"></i>
                    </div>
                    <div class="col-10 col-sm-5 mx-auto entries">
                        <div class="text-center">
                            <h3>Revenue</h3>
                            <span>#500,000</span>
                        </div>
                        <i class="icofont-money"></i>
                    </div>
                </div>
            <!-- </div> -->
        </div>
        <div class='teachers'>
            <h2>Teachers</h2>
            <?php
						$td = $d->table('teacher')->get('fullname', 'class', 'subject', 'picture', 'a_id','@concat(pre, ". ", fullname) as name')->where(['a_id', '!=', authId()])->sort('name', 'asc')->pages(15, 'teachers')->res();
						foreach ($td as $t): ?>
            <div class='header'>
                <div class='image'>
                    <img src="<?php echo $t->picture ?>" width="2.2rem" height="2.2rem" style="border-radius: 100%">
                    <form method='post' enctype='multipart/form-data' id='change-pic'>
                        <input type='file' name='img[]' class='uploader' id='file' accept='image/*;capture=camera'>
                        <input type='hidden' name='teacher' value='<?php echo $t->a_id; ?>'>
                        <span><i class="icofont-pen"></i></span>
                        <?php csrf() ?>
                    </form>
                </div>
                <div>
                    <a href='teacher/<?php echo $t->a_id ?>' class='details'><b><?php echo $t->name ?></b></a>
                    <i><?php echo $t->subject ?></i>
                    <small><i><?php echo $t->class ?></i></small>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Add subject -->

        <div class='add-subject'>
            <h2>Subjects</h2>
            <form method='post'>
                <div class='form-group'>
                    <label for='class'>Class</label>
                    <select id='class' name='class' class='form-control input-line classes'>
                        <option value=''>Select class</option>
                        <option>Jss</option>
                        <option>Sss</option>
                    </select>
                </div>
                <div class='form-group' style='display: none;'>
                    <label for='dept'>Department</label>
                    <select class='form-control input-line' name='dept' id='dept'>
                        <option value='Junior'>Select department</option>
                        <option>Art</option>
                        <option>Commercial</option>
                        <option>Science</option>
                    </select>
                </div>
                <div class='form-group'>
                    <label for='subject'>Subject</label>
                    <input type='text' name='subject' id='subject' class='form-control input-line'>
                    <small>Use comma to separate subjects.</small>
                </div>
                <div class='form-group'>
                    <input type='hidden' name='type' value='add-subject'>
                    <div class='info'></div>
                    <button class="btn btn-success">Submit</button>
                </div>
                <?php csrf() ?>
            </form>
        </div>

        <!-- students -->

        <div class='students'>
            <h2>Student</h2>
            <form method='get' class='ignore'>
                <div class='form-group'>
                    <label for='class'>Class</label>
                    <select class='form-control input-line classes' name='class' id='class'>
                        <option value=''>Select class</option>
                        <option>Jss 1</option>
                        <option>Jss 2</option>
                        <option>Jss 3</option>
                        <option>Sss 1</option>
                        <option>Sss 2</option>
                        <option>Sss 3</option>
                        <option>Removed</option>
                    </select>
                </div>
                <div class='form-group' style='display: none;'>
                    <label for='dept'>Department</label>
                    <select class='form-control input-line' name='dept' id='dept'>
                        <option value='Junior'>Junior</option>
                        <option>Art</option>
                        <option>commercial</option>
                        <option>Science</option>
                    </select>
                </div>
                <div class='form-group'>
                    <div class='info'></div>
                    <button class="btn btn-success">Submit</button>
                </div>
            </form>
            <?php 
				if (req('class')): 
                echo '<h2 class="mt-5">', $_GET['class'], '(<small>'. $_GET['dept'] .'</small>)</h2>';
				if (empty($sd)):
                echo '<p>No result found for the selected class!</p>';
                else:
				foreach ($sd as $s): 
			?>
            <form method='post' class=''>
                <div class='list'>
                    <div>
                        <input class="validate-ignore" type='checkbox' name='a_id[]' value='<?php echo $s->a_id; ?>'>
                    </div>
                    <div class='list-info-admin'>
                        <div>
                            <img src="<?php echo $s->picture ?>" width="2.2rem" height="2.2rem"
                                style="border-radius: 100%">
                        </div>
                        <div>
                            <a href='student/<?php echo $s->a_id; ?>'><b><?php echo $s->fullname ?></b></a><br />
                            <i><?php echo $s->pin ?></i>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class='form-group mt-4'>
                    <label for='student-action'>Action</label>
                    <select name='action' id='student-action' class='form-control input-line classes'>
                        <option value=''>Select action</option>
                        <option>Promote</option>
                        <option>Remove</option>
                    </select>
                </div>
                <div class='form-group'>
                    <label for='class'>Class</label>
                    <select class='form-control input-line classes' name='class' id='class'>
                        <option value=''>Select class</option>
                        <option>Jss 1</option>
                        <option>Jss 2</option>
                        <option>Jss 3</option>
                        <option>Sss 1</option>
                        <option>Sss 2</option>
                        <option>Sss 3</option>
                    </select>
                </div>
                <div class='form-group' style='display: none;'>
                    <label for='dept'>Department</label>
                    <select class='form-control input-line' name='dept' id='dept'>
                        <option value='Junior'>Junior</option>
                        <option>Art</option>
                        <option>commercial</option>
                        <option>Science</option>
                    </select>
                </div>
                <div class='form-group'>
                    <div class='info'></div>
                    <button class="btn btn-success">Submit</button>
                </div>
                <?php csrf() ?>
            </form>
            <?php 
				endif;
				endif;
			?>
        </div>

        <!-- Add teacher -->

        <div class='add-teacher'>
            <form method='post' id='create-teacher' class='' autocomplete=''>
                <h2>Add teacher</h2>
                <div class='form-group'>
                    <label for='pre'>Prefix</label>
                    <select name='pre' id='pre' class='form-control input-line'>
                        <option value=''>Prefix</option>
                        <option>Miss</option>
                        <option>Mr</option>
                        <option>Mrs</option>
                    </select>
                </div>
                <div class='form-group'>
                    <label for='fullname'>Fullname</label>
                    <input name='fullname' type='text' id='fullname' placeholder='Enter Fullname...'
                        class='form-control input-line'>
                </div>
                <div class="row">
                    <div class='form-group col-sm-6'>
                        <label for='email'>Email</label>
                        <input name='email' type='email' id='email' placeholder='Enter email address'
                            class='form-control input-line'>
                    </div>
                    <div class='form-group col-sm-6'>
                        <label for='tel'>Phone number</label>
                        <input name='phone' type='tel' id='tel' placeholder='Enter phone number'
                            class='form-control input-line'>
                    </div>
                </div>
                <div class='form-group'>
                    <label for='dob'>Date of birth</label>
                    <input name='dob' type='date' id='dob' class='form-control input-line'>
                </div>
                <div class='form-group'>
                    <label for='hadd'>Address</label>
                    <input name='hadd' type='text' id='hadd' placeholder='Enter address...'
                        class='form-control input-line'>
                </div>
                <div class="row">
                    <div class='form-group col-sm-6'>
                        <label for='class'>Class</label>
                        <select class='form-control input-line classes' name='class[]' id='class' multiple>
                            <option value=''>Select class</option>
                            <option>Jss 1</option>
                            <option>Jss 2</option>
                            <option>Jss 3</option>
                            <option>Sss 1</option>
                            <option>Sss 2</option>
                            <option>Sss 3</option>
                        </select>
                    </div>
                    <!-- <div style='display: none;'></div> -->
                    <div class='form-group col-sm-6'>
                        <label for='subject'>Subject</label>
                        <select class='form-control input-line subject' name='subject[]' id='class' row='2' multiple>
                            <option value=''>Select subject</option>
                            <?php foreach($sub as $s):?>
                            <option><?php echo $s; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class='form-group'>
                    <input type='hidden' name='create' value='teacher'>
                    <div class='info'></div>
                    <button class="btn btn-success">Submit</button>
                </div>
                <?php csrf() ?>
            </form>
        </div>

        <!-- Add student -->

        <div class='add-student mt-4'>
            <form method='post' id='create-student' class='' autocomplete=''>
                <h2 class='my-3'>Add student</h2>
                <div class='form-group'>
                    <label for='first'>Fullname</label>
                    <input name='fullname' type='text' id='first' placeholder='Enter Fullname...'
                        class='form-control input-line'>
                </div>
                <div class="row">
                    <div class='form-group col-sm-6'>
                        <label for='gender'>Gender</label>
                        <select name='gender' id='gender' class='form-control input-line'>
                            <option value=''>Gender</option>
                            <option>Female</option>
                            <option>Male</option>
                        </select>
                    </div>
                    <div class='form-group col-sm-6'>
                        <label for='dob'>Date of birth</label>
                        <input name='dob' type='date' id='dob' class='form-control input-line' min='1990-01-01'
                            max='2015-01-01'>
                    </div>
                </div>
                <div class='form-group'>
                    <label for='hadd'>Address</label>
                    <input name='hadd' type='text' id='hadd' placeholder='Enter address...'
                        class='form-control input-line'>
                </div>
                <div class='form-group'>
                    <label for='class'>Class</label>
                    <select class='form-control input-line classes' name='class' id='class'>
                        <option value=''>Select class</option>
                        <option>Jss 1</option>
                        <option>Jss 2</option>
                        <option>Jss 3</option>
                        <option>Sss 1</option>
                        <option>Sss 2</option>
                        <option>Sss 3</option>
                    </select>
                </div>
                <div class='form-group' style='display: none;'>
                    <label for='dept'>Department</label>
                    <select class='form-control input-line' name='dept' id='dept'>
                        <option value='Junior'>Junior</option>
                        <option>Art</option>
                        <option>commercial</option>
                        <option>Science</option>
                    </select>
                </div>
                <div class='form-group'>
                    <div class='h3 my-3'>Parent's section</div>
                    <label for='pre'>Prefix</label>
                    <select name='pre' id='pre' class='form-control input-line'>
                        <option value=''>Prefix</option>
                        <option>Mr</option>
                        <option>Mrs</option>
                    </select>
                </div>
                <div class='form-group'>
                    <label for='p-first'>Fullname</label>
                    <input name='p_name' type='text' id='p-first' placeholder='Enter fullname...'
                        class='form-control input-line'>
                </div>
                <div class="row">
                    <div class='form-group col-sm-6'>
                        <label for='email'>Email</label>
                        <input name='email' type='email' id='email' placeholder='Enter email address'
                            class='form-control input-line'>
                    </div>
                    <div class='form-group col-sm-6'>
                        <label for='phone'>Phone</label>
                        <input name='phone' type='tel' id='phone' placeholder='Enter phone number...'
                            class='form-control input-line'>
                    </div>
                </div>
                <div class='form-group'>
                    <input type='hidden' name='create' value='student'>
                    <div class='info'></div>
                    <button class="btn btn-success">Add!</button>
                </div>
                <?php csrf() ?>
            </form>
        </div>

        <!-- Notication -->

        <div class='notty'>
            <h2>Send notification</h2>
            <form method='post' action='ajax'>
                <div class='form-group'>
                    <label for='class'>Class</label>
                    <select class='form-control input-line' name='selected' id='class'>
                        <option value=''>Select class</option>
                        <option>Jss 1</option>
                        <option>Jss 2</option>
                        <option>Jss 3</option>
                        <option>Sss 1</option>
                        <option>Sss 2</option>
                        <option>Sss 3</option>
                        <option>Students</option>
                        <option>Teachers</option>
                        <option>All</option>
                    </select>
                </div>
                <div class='form-group'>
                    <label>Message</label>
                    <textarea name='notty' class='input-line form-control' placeholder='Enter text' rows='7'></textarea>
                </div>
                <div class='form-group'>
                    <div class='info'></div>
                    <button class="btn btn-success">Send</button>
                </div>
                <?php csrf() ?>
            </form>
        </div>

        <?php endif; ?>

        <!-- report -->

        <?php if ($level <= 2): ?>

        <div class='report'>
            <h2>Report</h2>
            <form method='post' action='ajax'>
                <div class='form-group'>
                    <label>Class</label>
                    <select name='class' id='class' class='form-control input-line classes'>
                        <option value=''>Select class</option>
                        <option>Jss 1</option>
                        <option>Jss 2</option>
                        <option>Jss 3</option>
                        <option>Sss 1</option>
                        <option>Sss 2</option>
                        <option>Sss 3</option>
                    </select>
                </div>
                <div class='form-group' style='display: none;'>
                    <label for='dept'>Department</label>
                    <select class='form-control input-line' name='dept' id='dept'>
                        <option value='Junior'>Junior</option>
                        <option>Art</option>
                        <option>commercial</option>
                        <option>Science</option>
                    </select>
                </div>
                <div class='form-group' style='display: none;'>
                    <input type='hidden' name='type' value='score'>
                </div>
                <div class='info'></div>
                <?php csrf() ?>
            </form>
            <div class='result'></div>
        </div>
        <?php endif; ?>

        <!-- info -->

        <div class='account'>
            <div class='auth' style='display: block;'>
                <h2>Change Password</h2>
                <div id='chpwd'>
                    <div class='days'></div>
                    <form method='post' action=''>
                        <div class='form-group'>
                            <label>New password</label>
                            <input type='password' name='verify' placeholder='New password'
                                class='form-control input-line' id="new-password">
                        </div>
                        <div class='form-group'>
                            <label>Verify password</label>
                            <input type='password' name='password' placeholder='Verify password'
                                class='form-control input-line' id="verify-password">
                        </div>
                        <input type='hidden' name='type' value='chpwd'>
                        <?php csrf(); ?>
                        <div>
                            <div class='info'></div>
                            <button class="btn btn-success">Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php if ($level == 2):?>

        <!-- exam -->
        <div class='exam'>
            
            <h2>Exam</h2>
            <p class='note text-left mb-3'>
                <small>Note: If there is already a question saved, any question set will be an update to the
                    subject!</small>
            </p>
            <form method='post' id='exam-form' class='mt-4'>
				<div class="row">
					<div class="col-6">
						<div class='form-group select'>
							<label>Class</label>
							<select name='class' class='form-control input-line' id='exam-sub'>
								<option value=''>Select class</option>
								<?php foreach(explode(', ', $p->class) as $c): ?>
								<option><?php echo $c; ?></option>
								<?php endforeach; ?>
							</select>
							<div class='subject-info'></div>
						</div>
					</div>
					<div class="col-6">
						<div class='form-group select'>
							<label>Subject</label>
							<select name='subject' class='form-control input-line' id='exam-sub'>
								<option value=''>Select subject</option>
								<?php foreach(explode(', ', $p->subject) as $s): ?>
								<option><?php echo $s; ?></option>
								<?php endforeach; ?>
							</select>
							<div class='subject-info'></div>
						</div>
					</div>
				</div>
                <div class='form-group set'>
                    <label>Time allowed</label>
                    <input type='number' id='time-allowed' class='form-control input-line' placeholder='Enter number...'>
                </div>
                <div class='form-group set'>
                    <label>Total question</label>
                    <input type='number' id='set' class='form-control input-line' placeholder='Enter number...'>
                </div>
                <div>
                    <input type='hidden' name='type' value='exam'>
                </div>
                <div class='form-question form-group'></div>
                <div class='form-group'>
                    <div class='info'></div>
                </div>
                <?php csrf() ?>
            </form>
        </div>
        <?php endif; ?>

    </div>
</div>

<!-- Other side  -->

<?php if ($level == 1): ?>
<div class='col-12 col-sm-3 mx-auto mt-3 p-3 bl mx-auto'>
    <div>
        <h3>Active events</h3>
        <?php foreach (session('events') as $key): ?>
        <div class='active'>
            <b><?php echo ucfirst($key->type); ?></b>
            <br>
            <small><?php echo ucfirst($key->content); ?></small>
            <div class='close delete-event' id='<?php echo $key->id; ?>'>&times;</div>
            <hr>
        </div>
        <?php endforeach; ?>
    </div>

    <form method='post' action='ajax' class="others">
        <h3>Acadamic session</h3>
        <div class='form-group events'>
            <input type='radio' class="custom-control-radio" name='content' value='First term'>
            First term
        </div>
        <div class='form-group events'>
            <input type='radio' class="custom-control-radio" name='content' value='Second term'>
            Second term
        </div>
        <div class='form-group events'>
            <input type='radio' class="custom-control-radio" name='content' value='Third term'>
            Third term
        </div>
        <div>
            <div class='info'></div>
            <input type='hidden' name='type' value='session'>
        </div>
        <?php csrf() ?>
    </form>
    <hr>
    <form method='post' action='ajax' class="others">
        <h3>Exam</h3>
        <div class='input-cover position-relative'>
            <input type='date' name='content'>
            <span>Exam begins</span>
        </div>
        <div>
            <div class='info'></div>
            <input type='hidden' name='type' value='exams'>
        </div>
        <?php csrf() ?>
    </form>
    <hr>
    <form method='post' action='ajax' class="others">
        <h3>Results</h3>
        <div class='input-cover position-relative'>
            <input type='date' name='content'>
            <span>Release results</span>
        </div>
        <div>
            <div class='info'></div>
            <input type='hidden' name='type' value='result'>
        </div>
        <?php csrf() ?>
    </form>
</div>
<?php endif; ?>

<?php
require_once 'inc/footer.php';