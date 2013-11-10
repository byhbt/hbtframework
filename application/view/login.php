<div class="container">
	<div class="row">
		<div class="col-sm-3"></div>
        <div class="col-sm-6">
        	<?php
				$session = new Session();
				echo $session->displayMessage();
			?>
			<form role="form" method="POST" action="<?php echo BASE_URL ?>/auth/login/" class="vertical" autocomplete="on">
				<div class="form-group">
					<label for="username">Username</label>
					<input class="form-control input-sm" id="username" name="username" type="text" required="" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" />
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control input-sm" id="password" name="password" type="password" required="" />
				</div>
				<button name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-log-in"></i> Sign in</button>
			</form>
        </div>
	</div>
</div>