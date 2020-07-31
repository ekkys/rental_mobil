<div class="page-header">
	<h3>Data Transaksi</h3>	
</div>

<a href="<?php echo base_url('admin/transaksi_tambah'); ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span>Transaksi Baru</a><br><br>

<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover" id="table-datatable">
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Kostumer</th>
				<th>Mobil</th>
				<th>Tgl. Pinjam</th>
				<th>Tgl. Kembali</th>
				<th>Harga</th>
				<th>Denda Per hari</th>
				<th>Tgl. Dikembalikan</th>
				<th>J. Hari telat</th>
				<th>Total Denda</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>		
		<tbody>
			<?php 
			$no = 1;
			foreach ($transaksi as $t) {
				?>

				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo date('d/m/Y',strtotime($t->transaksi_tgl)); ?></td>
					<td><?php echo $t->kostumer_nama; ?></td>
					<td><?php echo $t->mobil_merk; ?></td>
					<td><?php echo date('d/m/Y',strtotime($t->transaksi_tgl_pinjam)); ?></td>
					<td><?php echo date('d/m/Y',strtotime($t->transaksi_tgl_kembali)); ?></td>
					<td><?php echo "Rp ".number_format($t->transaksi_harga); ?></td>
					<td><?php echo "Rp ".number_format($t->transaksi_denda); ?></td>
					<td><?php
					if ($t->transaksi_tgldikembalikan == "0000-00-00") {
						echo "-";
					}else{
						echo date('d/m/Y', strtotime($t->transaksi_tgldikembalikan));
					}
					?></td>
					<td><?php  echo $t->transaksi_haritelat."  Hari"; ?></td>
					<td><?php echo "Rp ".number_format($t->transaksi_totaldenda).",-"; ?></td>
					<td>
						<?php 	
						if($t->transaksi_status == "1"){
							echo "Selesai";
						}else{
							echo "-";
						}				
						?>					
					</td>

					<td>
						<?php
						if ($t->transaksi_status == "1") {
							echo "-";
						}else{
							?>
							<a href="<?php echo base_url('admin/transaksi_selesai/').$t->transaksi_id; ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span>           Transaksi Selesai</a>
							<br>
							<a href="<?php echo base_url('admin/transaksi_hapus/').$t->transaksi_id; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Batalkan Transaksi</a>

							<?php
						}
						?>
					</td>
				</tr>
			<?php }?>
		</tbody>
	</table>
</div>