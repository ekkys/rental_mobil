<div class="page-header">
	<h3>Kostumer Baru</h3>
</div>
<?php foreach($kostumer as $k) {?>
<form action="<?php echo base_url('admin/kostumer_update'); ?>" method="post">
	<div class="form-group">
		<label>Nama Kostumer</label>
		<input type="hidden" name="id" value="<?php echo $k->kostumer_id; ?>">
		<input type="text" name="nama" class="form-control" value="<?php echo $k->kostumer_nama; ?>">
		<?php echo ('nama'); ?>
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<input type="text" name="alamat" class="form-control" value="<?php echo $k->kostumer_alamat; ?>">
		<?php echo ('alamat') ?>
	</div>
	<div class="form-group">
		<label>Jenis Kelamin</label>
		<select name="jk" class="form-control">
			<option value="<?php echo $k->kostumer_jk; ?>"><?php echo $k->kostumer_jk; ?></option>
			<option value="L">Laki-laki</option>
			<option value="P">Perempuan</option>
		</select>
	</div>
	<div class="form-group">
		<label>HP</label>
		<input type="number" name="hp" class="form-control" value="<?php echo $k->kostumer_hp; ?>">
	</div>
	<div class="form-group">
		<label>No.KTP</label>
		<input type="text" name="ktp" class="form-control" value="<?php echo $k->kostumer_ktp; ?>">
	</div>
	<div class="form-group">
		<input type="submit" value="Simpan" class="btn btn-primary">
	</div>
</form>
	<?php } ?>