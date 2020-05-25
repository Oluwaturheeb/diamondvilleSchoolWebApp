<div class="auth">
	<div class="auth-content">
		<div id="login">
			<h2>Login</h2>
			<form method="post" action="">
				<div>
					<label>Email</label>
					<input type="email" name="email" placeholder="Email" class="input-line">
				</div>
				<div>
					<small><a href="lpwd" class="lpwd">Forgot password?</a></small><label>Password</label>
					<input type="password" name="password" placeholder="Password" class="input-line">
				</div>
				<div id="captcha"></div>
				<?php echo Validate::csrf(); ?>
				<input type="hidden" name="type" value="login">
				<div>
					<div class="info"></div>
					<button class="button">Login</button>
				</div>
			</form>
		</div>
		<div id="lpwd">
			<h2>Lost password</h2>
			<form method="post" action="">
				<div>
					<label>Email</label>
					<input type="email" name="email" placeholder="Email" class="input-line">
				</div>
				<div id="captcha"></div>
				<?php echo Validate::csrf(); ?>
				<input type="hidden" name="type" value="lpwd">
				<div>
					<div class="info"></div>
					<button class="button-block">Reset</button>
				</div>
				<div class="opt"><a href="login" class="login">Login</a></div>
			</form>
		</div>
		<div id="chpwd">
			<h2>Change password</h2>
			<div class="days"></div>
			<form method="post" action="">
				<div>
					<label>New password</label>
					<input type="password" name="verify" placeholder="New password" class="input-line">
				</div>
				<div>
					<label>Verify password</label>
					<input type="password" name="password" placeholder="Verify password" class="input-line">
				</div>
				<div id="captcha"></div>
				<?php echo Validate::csrf(); ?>
				<input type="hidden" name="type" value="chpwd">
				<div>
					<div class="info"></div>
					<button class="button-block">Reset</button>
				</div>
				<div class="opt">
					<a href="skip" class="skip">Skip</a>
				</div>
			</form>
		</div>
	</div>
</div>