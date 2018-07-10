<html>
<head>
	<title>Marshal</title>
	<link rel="icon" href="<?php echo base_url('asset/image/trophy.png'); ?>" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo base_url('asset/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/css/auth.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/font/css/font-awesome.min.css'); ?>">
	<script src="<?php echo base_url('asset/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('asset/js/validator.min.js'); ?>"></script>
</head>
<body>
	<div class="login">
		<div class="title-login">
			<h1><?php echo $title; ?></h1>
		</div>
		<div class="form-login">
			<form data-toggle="validator" role="form" method="post"
				action="<?php echo base_url('auth/login'); ?>">
				<div class="form-group form-group-lg">
					<label for="inputUsername" class="control-label">Username</label>
					<input type="text" class="form-control" id="inputUsername" name="username" required>
				</div>
				<div class="form-group form-group-lg">
					<label for="inputPassword" class="control-label">Password</label>
					<input type="password" class="form-control" id="inputPassword" name="password" required>
				</div>
		  		<button type="submit" class="btn btn-lg btn-hijau">Login</button>
			</form>
		</div>
		<?php
		if ($this->session->flashdata('failed_login')) {
			?>
			<div class="failed-login">
				<?php echo $this->session->flashdata('failed_login'); ?>
			</div>
			<?php
		} else {
			?>
			<div class="footer-login">
				Crafted with <i class="fa fa-heart fa-fw" aria-hidden="true" style="color:#e91e63"></i> in Kuningan
			</div>
			<?php
		}
		?>
	</div>
</body>
</html>