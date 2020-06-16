<!DOCTYPE html>

<html>

    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>LAPORAN BARANG MASUK <?php echo date('d M Y', strtotime($tgl1))." s/d ".date('d M Y', strtotime($tgl2))?></title>
        <link rel="icon" href="<?php echo base_url('img/favicon.png')?>" type="image/gif">
        <link rel="stylesheet" href="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'bootstrap/dist/css/bootstrap.css')?>">
        <script src="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'jquery/dist/jquery.min.js')?>"></script>
    </head>
    <script>
        $( document ).ready(function() {
            window.print();
        });
    </script>
    <body style="font-size:12px; font-family: Tahoma, Geneva, sans-serif">
        
        <h5 class="text-center">
            <img src="<?php echo base_url('img/favicon.png')?>" style="margin-botom: 10px" height=70><br>LAPORAN BARANG MASUK <br>
			<?php echo ($kat == 1? "Tgl. Masuk": "Tgl. Jatuh Tempo")?> <?php echo date('d M Y', strtotime($tgl1))." s/d ".date('d M Y', strtotime($tgl2))?>
        </h5>
        
        <br>
		<table class="table table-hover">
			<thead>
				<tr>
				<th>ID Transaksi</th>
					<th>Tgl. Masuk</th>
					<th>Keterangan</th>
					<th>Barang</th>
					<th>Jumlah</th>
					<th>Tgl. Kadaluarsa</th>
					<th>Tgl. Jatuh Tempo Pembayaran</th>
					<th>Supplier</th>
					<th>Konsinyasi</th>
					<th>Operator</th>
				</tr>
			</thead>
			<tbody>
				 <?php 
					foreach ($data as $row) {
						echo "<tr>";
						echo "<td>".$row->idBarangMasuk."</td>";
						echo "<td>".date("d M Y", strtotime($row->tglBarangMasuk))."</td>";
						echo "<td>".$row->ketBarangMasuk."</td>";
						echo "<td>".$row->namaBarang."</td>";
						echo "<td>".$row->jmlBarang." ".$row->satuanBarang."</td>";
						echo "<td>".date("d M Y", strtotime($row->tglKadaluarsaBarang))."</td>";
						echo "<td>".date("d M Y", strtotime($row->tglJatuhTempo))."</td>";
						echo "<td>".$row->namaSupplier."</td>";
						echo "<td>".$row->konsinyasiSupplier."</td>";
						echo "<td>".$row->operator."</td></tr>";
					}
				?>
			</tbody>
		</table>
	</body>
</html>