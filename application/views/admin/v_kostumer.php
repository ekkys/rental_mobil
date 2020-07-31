<div class="page-header">
	<h3>Data Kustomer</h3>
</div>

<a href="<?php echo base_url('admin/kostumer_tambah'); ?>" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus"></span>Kostumer Baru</a>
<br>
<br>

<div class="table-responsive">
	<table class="table table-bordered table-hover table-striped" id="table-datatable">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Jenis Kelamin</th>
				<th>Alamat</th>
				<th>HP</th>
				<th>No.KTP</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			foreach ($kostumer as $k) {
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $k->kostumer_nama; ?></td>
					<td><?php echo $k->kostumer_jk; ?></td>
					<td><?php echo $k->kostumer_alamat; ?></td>
					<td><?php echo $k->kostumer_hp; ?></td>
					<td><?php echo $k->kostumer_ktp; ?></td>
					<td>
						<a href="<?php echo base_url('admin/kostumer_edit/').$k->kostumer_id; ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit"></span>  Edit</a>
						<a href="<?php echo base_url('admin/kostumer_hapus/').$k->kostumer_id; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash">  Hapus</span></a>
					</td>
					<?php	
				}
				?>
			</tr>
		</tbody>
	</table>
	
</div>