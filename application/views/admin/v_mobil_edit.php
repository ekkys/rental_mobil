<div class="page-header">
	<h3>Edit Mobil</h3>
</div>
<?php foreach($mobil as $m){ ?>
	<form action="<?php echo base_url('admin/mobil_update'); ?>" method="post">
		<div class="form-group">
			<label>Merk Mobil</label>
			<input type="hidden" name="id" value="<?php echo $m->mobil_id; ?>">
			<input class="form-control" type="text" name="merk" value="<?php echo $m->mobil_merk; ?>">
			<?php echo form_error('merk'); ?></div>
			<div class="form-group">
				<label>No. Plat Kendaraan</label>
				<input class="form-control" type="text" name="plat"value="<?php echo $m->mobil_plat; ?>">
			</div>
			<div class="form-group">
				<label>Warna</label>
				<input class="form-control" type="text" name="warna" value="<?php echo $m->mobil_warna; ?>">
			</div>
			<div class="form-group">
				<label>Tahun Kendaraan</label>
				<input class="form-control" type="text" name="tahun" value="<?php echo $m->mobil_tahun; ?>">
			</div>
			<div class="form-group">
				<label>Status Mobil</label>
				<select name="status" class="form-control">
					<option 
					<?php if($m->mobil_status == "1"){
						echo"selected='selected'";
					} 
					echo $m->mobil_tahun; ?> value="1">
					Tersedia
				</option>
				<option 
				<?php if($m->mobil_status == "2")
				{
					echo"selected='selected'";
				} echo $m->mobil_tahun; ?> value="2">Sedang Di
			Rental</option>
		</select>
		<?php echo form_error('status'); ?>
	</div>
	<div class="form-group">
		<input type="submit" value="Simpan" class="btn btnprimary">
	</div>
</form>
<?php } ?>