<div class="page-header">
	<h3>Laporan</h3>
</div>
<form method="post" action="<?php echo base_url().'admin/laporan'?>">
	<div class="form-group">
		<label>Dari Tanggal</label>
		<input type="date" name="dari" value="<?php echo set_value('dari');?>" class="form-control">
		<?php echo form_error('dari'); ?>
	</div>

	<div class="form-group">
		<label>Sampai Tanggal</label>
		<input type="date" name="sampai" value="<?php echo set_value('sampai'); ?>" class="form-control">
		<?php echo form_error('sampai'); ?>
	</div>

	<div class="form-group">
		<input type="submit" value="CARI" name="cari" class="btn
		btn-sm btn-primary">
	</div>

</form>



<div class="btn-group">
	<a class="btn btn-warning btn-sm" href="<?php echo base_url('admin/laporan_pdf/?dari=').set_value('dari').'&sampai='.set_value('sampai') ?>"><span class="glyphicon glyphiconprint"></span> Cetak PDF</a>
	<a class="btn btn-default btn-sm" href="<?php echo base_url('admin/laporan_print/?dari=').set_value('dari').'&sampai='.set_value('sampai') ?>"><span class="glyphicon glyphicon-print"></span> Print</a>
</div>
<br/>
<br/>

<!-- Tabel Laporan -->
<div class="table-responsive">
	<table border="1" class="table table-striped table-hover tablebordered" id="table-datatable">
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Kostumer</th>
				<th>Mobil</th>
				<th>Tgl. Pinjam</th>
				<th>Tgl. Kembali</th>
				<th>Tgl. Dikembalikan</th>
				<th>Harga</th>
				<th>Denda / Hari</th>
				<th>J. Hari Telat</th>
				<th>Total Denda</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			foreach($laporan as $l){ 
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo date('d/m/Y',strtotime($l->transaksi_tgl)); ?></td>
					<td><?php echo $l->kostumer_nama; ?></td>
					<td><?php echo $l->mobil_merk; ?></td>
					<td><?php echo date('d/m/Y',strtotime($l->transaksi_tgl_pinjam)); ?></td>
					<td><?php echo date('d/m/Y',strtotime($l->transaksi_tgl_kembali)); ?></td>
					<td>
						<?php
						if($l->transaksi_tgldikembalikan =="0000-
							00-00"){
							echo "-";
						}else{
							echo date('d/m/Y',strtotime($l->transaksi_tgldikembalikan));
						}
						?>
					</td>
					<td><?php echo "Rp. ".number_format($l->transaksi_harga); ?></td>
					<td><?php echo "Rp. ".number_format($l->transaksi_denda); ?></td>
					<td><?php echo $l->transaksi_haritelat."  Hari"; ?></td>
					
					<td><?php echo "Rp. ". number_format($l->transaksi_totaldenda)." ,-"; ?></td>
					<td>
						<?php
						if($l->transaksi_status == "1"){
							echo "Selesai";
						}else{
							echo "-";
						}
						?>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>
