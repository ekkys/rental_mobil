<!DOCTYPE html>
<html>
<head>
	<title>Login - Rentcar Apps</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
</head>
<body>
	<div class="col-md-4 col-md-offset-4" style="margin-top: 50px; ">
		<center>
			<h2>APLIKASI RENTAL MOBIL</h2>
			<h3>LOGIN</h3>
		</center>
		<br>
		<?php 
		if (isset($_GET['pesan'])) {
			if ($_GET['pesan'] == "gagal") {
				echo "<div class='alert alert-danger' > Login Gagal Username dan Password tidak sesuai</div>";
			}else if($_GET['pesan'] == "logout"){
				echo "<div class='alert alert-success'>Anda telah logout</div>";
			}else if($_GET['pesan'] == "belumlogin") {
				echo "<div class='alert alert-info'>Silahkan Login dulu.</div>";
			}
		}
		?>
		<br>
		<div class="panel panel-default">
			<div class="panel-body">
				<br><br>
				<form method="post" action="<?php echo base_url('login/login_aksi') ?>">
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Masukkan Username">
						<?php echo form_error('username');?>
					</div>					
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Masukkan Password">
						<?php echo form_error('password'); ?>
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>