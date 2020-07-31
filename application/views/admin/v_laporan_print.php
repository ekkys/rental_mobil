<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<style type="text/css">.table-data{
		width: 100%;
		border-collapse: collapse;
	}
	.table-data tr th,
	.table-data tr td{
		border:1px solid black;
		font-size: 10pt;
	}
</style>
<h3>Laporan Transaksi Rental Mobil</h3>


<table>
	<tr>
		<td>Dari Tgl</td>
		<td>:</td>
		<td><?php echo date('d/m/Y',strtotime($_GET['dari'])); ?></td>
	</tr>
	<tr>
		<td>Sampai Tgl</td>
		<td>:</td>
		<td><?php echo date('d/m/Y',strtotime($_GET['sampai'])); ?></td>
	</tr>
</table>


<br/>
<table class="table-data">
	<thead>
		<tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>Kostumer</th>
			<th>Mobil</th>
			<th>Tgl. <RP></RP>ental</th>
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
				<td><?php echo $l->transaksi_haritelat." hari"; ?></td>
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
<script type="text/javascript">
	window.print();
</script>
</body>
</html>