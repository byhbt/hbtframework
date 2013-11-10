    <div class="container">
		<div class="row">
			<div class="col-sm-7">
				<h4>Welcome!!!</h4>
				<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
				<p><img src="<?php echo BASE_URL; ?>/public_html/img/banner.png" alt="" /></p>
	        </div>
	        <div class="col-sm-5">
				<?php $session = new Session(); ?>
				<form role="form" method="POST" action="<?php echo BASE_URL ?>/auth/register/" class="vertical" autocomplete="on">
					<h4 class="free-title">It's free! Sign up now.</h4>
					<?php if(isset($errors)) displayError($errors); ?>
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
						<input class="form-control input-sm" id="email" name="email" type="email" required="" />
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
					<input type="hidden" name="submitted" value=1 />
					<input class="btn btn-primary" type="submit" name="submit" value="Register" />
				</form>
			</div>
	     </div>
	</div>