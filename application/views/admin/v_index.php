<div class="page-header">
	<h3>Dashboard</h3>
</div>
<div class="row">
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="glyphicon glyphiconfolder-open"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
							<?php echo $this->m_rental->get_data('mobil')->num_rows(); ?>
						</div>
						<div>Jumlah Mobil</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url('admin/mobil'); ?>">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="glyphicon glyphiconuser"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
							<?php echo $this->m_rental->get_data('kostumer')->num_rows(); ?>
						</div>
						<div>Jumlah Kostumer</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url('admin/kostumer'); ?>">
				<div class="panel-footer">
					<span class="pull-left">View
					Details</span>
					<span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="glyphicon glyphiconsort"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
							<?php echo $this->m_rental->get_data('transaksi')->num_rows(); ?>
						</div>
						<div>Jumlah Transaksi</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url('admin/transaksi');?>">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="glyphicon glyphiconok"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
							<?php echo $this->m_rental->edit_data(array('transaksi_status'=>1),'transaksi')->num_rows(); ?>
						</div>
						<div>Rental Selesai</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url('admin/transaksi')?>">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="glyphicon
					glyphicon-random arrow-right"></i> Mobil</h3>
				</div>
				<div class="panel-body">
					<div class="list-group">
						<?php foreach($mobil as $m){ ?>
							<a href="#" class="list-group-item">
								<span class="badge"><?php if($m->mobil_status == 1){echo "Tersedia";}else{echo "Dirental";}?></span>
								<i class="glyphicon glyphiconuser"></i> <?php echo $m->mobil_merk; ?>
							</a>
						<?php } ?>
					</div>
					<div class="text-right">
						<a href="<?php echo base_url('admin/mobil'); ?>">Lihat Semua Mobil <i class="glyphicon glyphicon-arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon
						glyphicon-user o"></i> Kostumer Terbaru</h3>
					</div>
					<div class="panel-body">
						<div class="list-group">
							<?php foreach($kostumer as $k){ ?>
								<a href="#" class="list-group-item">
									<span class="badge"><?php echo $k->kostumer_jk ?></span>
									<i class="glyphicon glyphiconuser"></i> <?php echo $k->kostumer_nama; ?>
								</a>
							<?php } ?>
						</div>
						<div class="text-right">
							<a href="<?php echo base_url('admin/kostumer'); ?>">Lihat Semua Kostumer <i class="glyphicon glyphicon-arrow-right"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="glyphicon glyphicon-sort"></i> Peminjaman Terakhir</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered tablehover table-striped">
								<thead>
									<tr>
										<th>Tgl. Transaksi</th>
										<th>Tgl. Pinjam</th>
										<th>Tgl. Kembali</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach($transaksi as $t){
										?>
										<tr>
											<td><?php echo date('d/m/Y',strtotime($t->transaksi_tgl)); ?></td>
											<td><?php echo date('d/m/Y',strtotime($t->transaksi_tgl_pinjam)); ?></td>
											<td><?php echo date('d/m/Y',strtotime($t->transaksi_tgl_kembali)); ?></td>
											<td><?php echo "Rp.".number_format($t->transaksi_harga)." ,-"; ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="text-right">
							<a href="<?php echo base_url('admin/transaksi');?>">Lihat Semua Transaksi 
								<i class="glyphicon glyphicon-arrow-right"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
<!-- /.row -->