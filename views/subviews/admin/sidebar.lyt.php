<div class="sidebar pe-4 pb-3">
			<nav class="navbar bg-light navbar-light">
				<a href="<* if (auth()->type < 3): (auth()->type == 1)? $url = '/admin': $url = '/teacher'; echo $url. '-'; endif;  *>dashboard" class="navbar-brand mx-4 mb-3">
					<h3 class="text-success"><i class="fa fa-home me-2"></i>DVSchool</h3>
				</a>
				<div class="d-flex align-items-center ms-4 mb-4">
					<div class="position-relative">
						<img class="rounded-circle" src="<* echo  (isset($auth->picture))? $auth->picture : '' *>" alt="" style="width: 40px; height: 40px;">
						<div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
					</div>
					<div class="ms-3">
						<h6 class="mb-0">
							<* echo (isset($auth->fullname))? ucwords($auth->pre. '. '. $auth->fullname): '' *>
						</h6>
						<i><* (auth()->type == 1)? $type = 'Admin': $type = 'Teacher'; echo $type *></i>
					</div>
				</div>
				<div class="navbar-nav w-100">
					<* if (auth()->type < 3): *>
					<a href="<* echo $url *>-dashboard#" class="nav-item nav-link active"><i class="fa fa-home me-2"></i>Dashboard</a>
					<a href="<* echo $url *>/add-student" class="nav-item nav-link"><i class="fa fa-user-plus me-2"></i>Add Student</a>
					<a href="<* echo $url *>/profile" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Profile</a>
					<* if (auth()->type == 1) echo '<a href="/admin/notification" class="nav-item nav-link"><i class="fa fa-bell me-2"></i>Notification</a>' *>
					<* if (auth()->type == 1) echo '<a href="/admin/payments" class="nav-item nav-link"><i class="fa fa-comment-dollar me-2"></i>Payments</a>' *>
					<a href="<* echo $url *>/students" class="nav-item nav-link"><i class="fa fa-user-graduate me-2"></i>Students</a>
					<* if (auth()->type == 1) echo '<a href="/admin/teachers" class="nav-item nav-link"><i class="fa fa-chalkboard-teacher me-2"></i>Teachers</a>' *>
					<* else: ?>
					<a href="/student/fees" class="nav-item nav-link"><i class="fa fa-credit-card me-2"></i>Pay Fees</a>
					<* endif; *>
					<a href="/logout" class="nav-item nav-link"><i class="fa fa-sign-out-alt fa-rotate-180 me-2"></i>Logout</a>
				</div>
			</nav>
		</div>
