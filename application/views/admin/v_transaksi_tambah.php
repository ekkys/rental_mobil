<div class="page-header">
	<h3>Transaksi Baru</h3>
</div>

<form action="<?php echo base_url('admin/transaksi_tambah_aksi') ?>" method="post">
	<div class="form-group">
		<label>Kostumer</label>
		<select name="kostumer" class="form-control">
			<option value="">-Pilih Customer-</option>
			<?php foreach ($kostumer as $k) {?>
				<option value="<?php echo $k->kostumer_id; ?>"><?php echo $k->kostumer_nama; ?></option>
			<?php } ?>
		</select>
		<?php echo form_error('kostumer'); ?>
	</div>
	<div class="form-group">
		<label>Mobil</label>
		<select name="mobil" class="form-control">
			<option value="">-Pilih Mobil-</option>
			<?php foreach ($mobil as $m) {?>
				<option value="<?php echo $m->mobil_id ?>"><?php echo $m->mobil_merk;  ?></option>
			<?php } ?>
		</select>
		<?php echo form_error('mobil') ?>
	</div>

	<div class="form-group">
		<label>Tanggal Pinjam</label>
		<input type="date" name="tgl_pinjam" class="form-control">
		<?php echo form_error('tgl_pinjam'); ?>
	</div>

	<div class="form-group">
		<label>Tanggal Kembali</label>
		<input type="date" name="tgl_kembali" class="form-control">
		<?php echo form_error('tgl_kembali'); ?>
	</div>
	
	<div class="form-group">
		<label>Harga</label>
		<input type="number" name="harga" class="form-control">
		<?php echo form_error('harga'); ?>
	</div>
	<div class="form-group">
		<label>Harga Denda / Hari</label>
		<input type="text" name="denda" class="form-control">
		<?php echo form_error('denda'); ?>
	</div>
	<div class="form-group">
		<input type="submit" value="Simpan" class="btn btn-primary btn-sm">
	</div>
</form>