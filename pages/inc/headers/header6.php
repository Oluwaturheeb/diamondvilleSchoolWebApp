	<nav class="">
		<div class="logo">
			<div class="dp-menu">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<div class="dp-link">
				<?php if (Session::check("level")):
				$l = Session::get("level");
				if($l <= 2 && !empty($l)) {
					$acc = "Admin panel";
					$loc = "admin";
				} else {
					$acc = "Dashboard";
					$loc = "student";
				}
				?>
				<a href="<?php echo $loc ?>"><?php echo $acc ?></a>
				<?php if ($l == 1): ?>
				<!-- admin links -->
				<a href="/account" class="edit">Change password</a>
				<a href="/teachers" class="edit">Teachers</a>
				<a href="/add-teacher" class="edit">Add teacher</a>
				<a href="/add-student" class="edit">Add student</a>
				<a href="/add-subject" class="edit">Add subject</a>
				<a href="/notty" class="edit">Notification</a>
				<a href="/report" class="edit">Report</a>
				<a href="/students" class="edit">Students</a>
				<?php elseif ($l == 2): ?>
				<!-- teacher link -->
				<a href="/account" class="edit">Change password</a>
				<a href="/exam" class="edit">Exam</a>
				<a href="/report" class="edit">Report</a>
				<?php elseif ($l == 3): ?>
				<!-- student link -->
				<a href="/report" class="edit">Report</a>
				<a href="/exam">Exam</a>
				<?php endif; ?>
				<a href="/logout">Logout</a>
				<?php else: ?>
				<a href="/login">Login</a>
				<?php endif; ?>
			</div>
			<a href="/" class="logo">
				DiamondVille
			</a>
		</div>
		<div class="links">
			<a href="/">Home</a>
			<a href="/about">About</a>
			<a href="/contact">Contact</a>
			<a href="search" class="search">Search</a>
		</div>
		<div id="search">
			<form method="post">
				<div class="input-group">
					<span>
						<input type="search" name="keyword" class="form-control">
						<button>Search</button>
					</span>
				</div>
			</form>
			<span class="close">&times;</span>
		</div>
	</nav>