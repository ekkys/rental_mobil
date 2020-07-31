<div class="page-header">
	<h3>Laporan</h3>
</div>
<form method="post" action="<?php echo base_url('admin/laporan');
?>">
<div class="form-group">
	<label>Dari Tanggal</label>
	<input type="date" name="dari" class="form-control">
	<?php echo form_error('dari'); ?>
</div>
<div class="form-group">
	<label>Sampai Tanggal</label>
	<input type="date" name="sampai" class="form-control">
	<?php echo form_error('sampai'); ?>
</div>
<div class="form-group">
	<input type="submit" value="CARI" name="cari" class="btn
	btn-sm btn-primary">
</div>
</form>