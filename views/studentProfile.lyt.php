<?php
$report = function () use($data, $student) {
  $tableHeader = (function () use ($student) {
    $app = config('project/host');
    return <<<__header
    <header class="header">
      <div class="d-flex">
        <h1 style="display: inline-block;">DiamondVille Comprehensive School</h1>
      </div>
      <h3>Student Report</h3>
      <div class="">
        <img src="$app/$student->picture" width="200px" height="150px">
        <div>
          <h3>$student->fullname</h3>
        </div>
      </div>
    </header>
__header;
  })();

  $table = function ($tbody, $class, $fold = false) use($tableHeader) {
    $table = <<<__tab
    <h6 class="my-3 text-left">Print result&nbsp;&nbsp;&nbsp;<i class="fa fa-print"></i></h6>
    <div class="to-print">
    $tableHeader
    <h3 class='toprintresult'>$class Report</h3>
    <table class="table text-start align-middle table-bordered table-hover mb-0">
      <thead>
        <tr class="text-dark">
          <th scope="col">Subject</th>
          <th scope="col">First Term</th>
          <th scope="col">Second Term</th>
          <th scope="col">Third Term</th>
        </tr>
      </thead>
      <tbody>
        $tbody
      </tbody>
    </table>
    </div>
__tab;

  if ($fold)
    $table = <<<__tab
    <details class="my-3">
      <summary><h6 class="d-inline">Report from $class</h6></summary>
      $table
    </details>
__tab;

    return $table;
  };
  // classes
  $j1 = $j2 = $j3 = $s1 = $s2 = $cc = '';
  $session = '';
  $class = '';

  foreach ($data as $d) {
    if($class != $d->class) $session = '';
    if ($student->class == $d->class) {
      $class = $d->class;
      $sub = "<td>$d->subject</td>";
      if ($d->session == 'First Term') {
        // generate tr for all subject in a session
        $session .= "<tr>$sub <td> $d->score</td></tr>";
      } elseif ($d->session == 'Second Term') {
        $session = substr($session, 0, -5);
        $session .= "<td>{$d->score}</td></tr>";
      } elseif ($d->session == 'Third Term') {
        $session = substr($session, 0, -5);
        $session .= "<td>{$d->score}</td></tr>";
      }
      $cc = $table($session, $class);
    } else {
      if ($d->class == 'Jss 1') {
        $class = $d->class;
        $sub = "<td>$d->subject</td>";
        if ($d->session == 'First Term') {
          // generate tr for all subject in a session
          $session .= "<tr>$sub <td> $d->score</td></tr>";
        } elseif ($d->session == 'Second Term') {
          $session = substr($session, 0, -5);
          $session .= "<td>{$d->score}</td></tr>";
        } elseif ($d->session == 'Third Term') {
          $session = substr($session, 0, -5);
          $session .= "<td>{$d->score}</td></tr>";
        }
        $j1 = $table($session, $class, true);
      } elseif ($d->class == 'Jss 2') {
        $class = $d->class;
        $sub = "<td>$d->subject</td>";
        if ($d->session == 'First Term') {
          // generate tr for all subject in a session
          $session .= "<tr>$sub <td> $d->score</td></tr>";
        } elseif ($d->session == 'Second Term') {
          $session = substr($session, 0, -5);
          $session .= "<td>{$d->score}</td></tr>";
        } elseif ($d->session == 'Third Term') {
          $session = substr($session, 0, -5);
          $session .= "<td>{$d->score}</td></tr>";
        }
        $j2= $table($session, $class, true);
      } elseif ($d->class == 'Jss 3') {
        $class = $d->class;
        $sub = "<td>$d->subject</td>";
        if ($d->session == 'First Term') {
          // generate tr for all subject in a session
          $session .= "<tr>$sub <td> $d->score</td></tr>";
        } elseif ($d->session == 'Second Term') {
          $session = substr($session, 0, -5);
          $session .= "<td>{$d->score}</td></tr>";
        } elseif ($d->session == 'Third Term') {
          $session = substr($session, 0, -5);
          $session .= "<td>{$d->score}</td></tr>";
        }
        $j3 = $table($session, $class, true);
      } elseif ($d->class == 'Sss 1') {
        $class = $d->class;
        $sub = "<td>$d->subject</td>";
        if ($d->session == 'First Term') {
          // generate tr for all subject in a session
          $session .= "<tr>$sub <td> $d->score</td></tr>";
        } elseif ($d->session == 'Second Term') {
          $session = substr($session, 0, -5);
          $session .= "<td>{$d->score}</td></tr>";
        } elseif ($d->session == 'Third Term') {
          $session = substr($session, 0, -5);
          $session .= "<td>{$d->score}</td></tr>";
        }
        $s1 = $table($session, $class, true);
      } elseif ($d->class == 'Sss 2') {
        $class = $d->class;
        $sub = "<td>$d->subject</td>";
        if ($d->session == 'First Term') {
          // generate tr for all subject in a session
          $session .= "<tr>$sub <td> $d->score</td></tr>";
        } elseif ($d->session == 'Second Term') {
          $session = substr($session, 0, -5);
          $session .= "<td>{$d->score}</td></tr>";
        } elseif ($d->session == 'Third Term') {
          $session = substr($session, 0, -5);
          $session .= "<td>{$d->score}</td></tr>";
        }
        $s2 = $table($session, $class, true);
      }
    }
  }
  return $cc .$j1 .$j2 .$j3 .$s1 .$s2;
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <* includeView('admin/header') *>
</head>

  <body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
      <!-- Spinner Start -->
      <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
					<div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
							<span class="sr-only">Loading...</span>
					</div>
			</div> -->
      <!-- Spinner End -->

      <* includeView('admin/sidebar') *>

        <!-- Content Start -->
        <div class="content">
          <!-- Navbar Start -->
          <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
              <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
              <i class="fa fa-bars"></i>
            </a>
            <form class="d-none d-md-flex ms-4">
              <input class="form-control border-0" type="search" placeholder="Search">
            </form>
            <div class="navbar-nav align-items-center ms-auto">
              <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                  <img class="rounded-circle me-lg-2" src="<* echo $auth->picture *>" alt="" style="width: 40px; height: 40px;">
                  <span class="d-none d-lg-inline-flex">
                    <* echo ucwords($auth->pre. '. '. $auth->fullname) *>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="#" class="dropdown-item">My Profile</a>
                    <a href="/logout" class="dropdown-item">Log Out</a>
                  </div>
                </div>
              </div>
            </nav>
          <!-- Navbar End -->

          <!-- Students -->
          <!-- Students Profile -->
					<div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded p-4">
              <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0"><* echo $student->fullname *>'s Profile</h6>
              </div>
							<div class="student-profile">
								<div class="d-flex">
									<img class="" src="<* echo $student->picture *>">
									<div class="ml-5">
										<strong><* echo ucwords($student->fullname) *></strong><br>
										<i><* echo $student->class .'('. $student->dept . ')' *></i><br>
										<a href="tel: <* echo $student->phone *>"><i class="fa fa-phone fa-rotate-90"></i> Call</a>
									</div>
								</div>
								<div class="mt-4">
									<div class="mb-3">
										<h6 class="m-0">Parent/Guardian Name</h6><* echo $student->pre .'.'. ucwords($student->p_name) *>
									</div>
									<div class="mb-3">
										<h6 class="m-0">Date of Birth</h6><* echo $student->dob . ' ('. $student->age . ')' *>
									</div>
									<div class="mb-3">
										<h6 class="m-0">Gender</h6><* echo ucwords($student->gender) *>
									</div>
									<div class="mb-3">
										<h6 class="m-0">Address</h6><* echo ucwords($student->hadd) *>
									</div>
								</div>
							</div>
            </div>
          </div>

          <!-- Students Report -->
          <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded p-4">
              <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0"><* echo $student->fullname *>'s Report</h6>
              </div>
              <div class="table-responsive">
                <* if (isset($data[0]->session)): *>
                <* echo $report() *>
                <* else: *>
                <p>No report on <* echo $student->fullname *></p>
                <* endif *>
              </div>
            </div>
          </div>
          <!-- Sale & Revenue End -->
          <style>
            .to-print header{
              display: none !important;
            }
          </style>
     <* includeView('admin/footer') *>
  </body>
</html>