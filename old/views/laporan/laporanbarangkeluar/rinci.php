<table class="table table-hover">
	<thead>
		<tr>
			<th>No.</th>
			<th>Tgl. Keluar</th>
			<th>Barang</th>
			<?php if($this->session->userdata('lvlPengguna') == 0) {?>
			<th>Harga Beli</th>
			<?php }?>
			<th>Harga Jual</th>
			<th>Qty</th>
			<?php if($this->session->userdata('lvlPengguna') == 0) {?>
			<th>Total Harga Beli</th>
			<?php }?>
			<th>Total Harga Jual</th>
		</tr>                                
	</thead>
	<tbody>
		 <?php 
				$sumHargaBeli = 0;
				$sumHargaJual = 0;
				$sumQty = 0;
			if($data){
				$no = 1;
				foreach ($data as $row) {
					$harga = $row->hargaJual - ($row->hargaJual * $row->diskonBarang/100);
					echo "<tr>";
					echo "<td>".$no."</td>";
					echo "<td>".date('d M Y', strtotime($row->tglKeluar))."</td>";
					echo "<td>".$row->namaBarang."</td>";
					echo "<td align='right'>".number_format($row->hargaBeli, 2)."</td>";
					if($this->session->userdata('lvlPengguna') == 0) {
						echo "<td align='right'>".number_format($harga, 2)."</td>";
					}
					echo "<td align='center'>".$row->qtyBarang."</td>";
					if($this->session->userdata('lvlPengguna') == 0) {
						echo "<td align='right'>".number_format($row->hargaBeli * $row->qtyBarang, 2)."</td>";
					}
					echo "<td align='right'>".number_format($harga * $row->qtyBarang, 2)."</td>";
					echo "</tr>";
					$sumHargaBeli += $row->hargaBeli * $row->qtyBarang;
					$sumHargaJual += $harga * $row->qtyBarang;
					$sumQty += $row->qtyBarang;
					$no++;
				}
			}
		?>
	</tbody>
	<tr>
		<th colspan=5 style='text-align: right'>GRAND TOTAL (Rp.)</th>
		<th style='text-align: center'><?php echo number_format($sumQty, 2)?></th>
		<?php if($this->session->userdata('lvlPengguna') == 0) {?>
		<th style='text-align: right'><?php echo number_format($sumHargaBeli, 2)?></th>
			<?php }?>
		<th style='text-align: right'><?php echo number_format($sumHargaJual, 2)?></th>
	</tr>
		<?php if($this->session->userdata('lvlPengguna') == 0) {?>
	<tr>
		<th colspan=6 style='text-align: right'>SELISIH (Rp.)</th>
		<th colspan=2 style='text-align: right'><?php echo number_format($sumHargaJual - $sumHargaBeli, 2)?></th>
	</tr>
			<?php }?>
</table>