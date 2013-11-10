    <div class="container">
		<div class="row">
			<div class="col-sm-3"></div>
	        <div class="col-sm-6">
				<?php
					$session = new Session();
					echo $session->displayMessage();
				?>
				<form role="form" method="POST" action="<?php echo BASE_URL ?>/auth/register/" class="vertical" autocomplete="on">
					<h4>Sign Up</h4>
					<hr />
					<div class="form-group">
						<label for="username">Username</label>
						<input class="form-control input-sm" id="username" name="username" type="text" required="" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" />
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input class="form-control input-sm" id="password" name="password" type="password" required="" />
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input class="form-control input-sm" id="email" name="email" type="email" required=""  value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" />
					</div>
					<div class="form-group">
						<label for="fullname">Fullname</label>
						<input class="form-control input-sm" id="fullname" name="fullname" type="text" required="" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : ''; ?>" />
					</div>
					<div class="form-group">
						<label for="text4">Birthday</label>
						<div class="row">
							<div class="col-sm-4">
								<select class="form-control" id="cmbMonth" name="cmbMonth" required="" >
									<option value="">-- Month --</option>
									<?php echo displayMonthCmb($_POST['cmbMonth']); ?>
								</select>
							</div>
							<div class="col-sm-4">
								<select class="form-control" id="cmbDay" name="cmbDay" required="">
									<option value="">-- Day --</option>
									<?php echo displayDateCmb($_POST['cmbDay']); ?>
								</select>
							</div>
							<div class="col-sm-4">
								<select class="form-control" id="cmbYear" name="cmbYear" required="">
									<option value="">-- Year --</option>
									<?php
										$allow_year = (int) date('Y') - 13;
										echo displayYearCmb(1930, $allow_year, $_POST['cmbYear']); ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="male">Gender</label>
						<div class="row">
							<div class="col-sm-4">
								<input type="radio" name="gender" id="male" required checked value="m" class="radio-inline">
								<label for="male" class="inline">Male</label>
							</div>
							<div class="col-sm-4">
								<input type="radio" name="gender" id="female" value="f" class="radio-inline">
								<label for="female" class="inline">Female</label>
							</div>
						</div>
					</div>
					<button name="submit" class="btn btn-primary">Register!</button>
				</form>
			</div>
	     </div>
	</div>