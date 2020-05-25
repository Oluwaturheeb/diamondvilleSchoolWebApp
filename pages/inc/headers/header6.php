	<nav class="">
		<div class="logo">
			<div class="dp-menu">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<div class="dp-link">
				<?php if(Session::check()):
				$l = Session::get("level");
				if($l <= 2) {
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
				<a href="/add-student">Add student</a>
				<a href="/add-teacher">Add teacher</a>
				<a href="/set-session">Set session</a>
				<?php elseif ($l == 2): ?>
				<!-- teacher link -->
				<a href="/info">Account</a>
				<a href="/add-student">Add student</a>
				<a href="/report">Report</a>
				<a href="/exams">Exam</a>
				<?php else: ?>
				<!-- student link -->
				<a href="/report">Report</a>
				<a href="/exams">Exam</a>
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