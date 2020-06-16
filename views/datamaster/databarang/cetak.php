<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Klinik </title>
    <link rel="icon" href="<?php echo base_url('img/favicon.png')?>" type="image/gif">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'bootstrap/dist/css/bootstrap.css')?>">

    <script src="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'jquery/dist/jquery.min.js')?>"></script>
    <script>
        $( document ).ready(function() {
            window.print();
        });
    </script>
</head>
<body>
	<center><h3>DATA BARANG</h3></center>
	<hr>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Nama</th>
				<th>Satuan</th>
				<th>Stok Min</th>
				<th>Harga Beli + PPN</th>
				<th>Harga Jual</th>
				<th>Tipe</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			 <?php 
				foreach ($data as $row) {
					echo "<tr>";
					echo "<td>".$row->namaBarang."</td>";
					echo "<td>".$row->satuanBarang."</td>";
					echo "<td>".$row->stokMinBarang."</td>";
					echo "<td class='text-right'>Rp. ".number_format($row->hargaBeliBarang, 2)."</td>";
					echo "<td class='text-right'>Rp. ".number_format($row->hargaJualBarang, 2)."</td>";
					//echo "<td class='text-center'>".$row->keuntunganBarang." %</td>";
					echo "<td>".($row->tipeBarang == 'o'? "Obat": "Alat/Bahan")."</td>";
					echo "<td>".$row->ketBarang."</td></tr>";
				}
			?>
		</tbody>
	</table>
</body>
</html>