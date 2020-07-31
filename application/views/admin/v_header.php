<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Aplikasi Rental Mobil</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable/datatables.css'); ?>">
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/datatable/jquery.dataTables.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/datatable/datatables.js'); ?>"></script>
</head>
<body>

	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo base_url('admin'); ?>">Rental Mobil</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo base_url('admin'); ?>"><span class="glyphicon glyphiconhome"></span> Dashboard <span class="sronly">(current)</span></a></li>
					<li><a href="<?php echo base_url('admin/mobil'); ?>"><span class="glyphicon glyphiconfolder-open"></span> Data Mobil</a></li>
					<li><a href="<?php echo base_url('admin/kostumer'); ?>"><span class="glyphicon glyphiconuser"></span> Data Kostumer</a></li>
					<li><a href="<?php echo base_url('admin/transaksi'); ?>"><span class="glyphicon glyphicon-sort"></span> Transaksi Rental</a></li>
					<li><a href="<?php echo base_url('admin/laporan'); ?>"><span class="glyphicon glyphiconlist-alt"></span> Laporan</a></li>
				</ul>
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php echo base_url('admin/logout'); ?>"><span class="glyphicon glyphicon-logout"></span> Logout</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo "Halo, <b>".$this->session->userdata('nama'); ?></b> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<a href="<?php echo base_url('admin/ganti_password'); ?>"><i class="glyphicon glyphicon-lock" style="padding: 10px;"></i> Ganti Password </a> 
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>

<div class="container">