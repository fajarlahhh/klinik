<table class="table table-hover">
	<thead>
		<tr>
			<th>No.</th>
			<th>Barang</th>
			<th>Qty</th>
		</tr>                                
	</thead>
	<tbody>
		 <?php 
				$sumHargaBeli = 0;
				$sumHargaJual = 0;
			if($data){
				$no = 1;
				foreach ($data as $row) {
					echo "<tr>";
					echo "<td>".$no."</td>";
					echo "<td>".$row->namaBarang."</td>";
					echo "<td>".$row->qtyBarang."</td>";
					$no++;
				}
			}
		?>
	</tbody>
</table>