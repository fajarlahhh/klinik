<?php 
    switch ($tp) {
        case 1:
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th rowspan=3 style="vertical-align: middle">No.</th>
            <th rowspan=3 style="vertical-align: middle">No. Nota</th>
            <th rowspan=3 style="vertical-align: middle">Pelanggan</th>
            <th rowspan=3 style="vertical-align: middle">Tgl. Penerimaan</th>
            <th style='text-align:center' colspan=5>Asal Penerimaan</th>
            <th rowspan=3 style="vertical-align: middle">Total Penerimaan</th>
        </tr>
        <tr>
            <th colspan=3 style='text-align:center'>Tindakan</th>
            <th rowspan=2 style="vertical-align: middle">Barang</th>
            <th rowspan=2 style="vertical-align: middle">Lainnya</th>
        </tr>
        <tr>
            <th>Bag. Dokter/Petugas</th>
            <th>Bag. Klinik</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
            <?php 
            $no = 1;
            $sumBagianPetugas = 0;
            $sumBagianKlinik = 0;
            $sumJmlTindakan = 0;
            $sumJmlBarang = 0;
            $sumJmlLainnya = 0;
            $sumPenerimaan = 0;
            if($data){
                foreach ($data as $row) {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$row->noPenerimaan."</td>";
                    echo "<td>".$row->pelanggan."</td>";
                    echo "<td>".date('d M Y', strtotime($row->tglPenerimaan))."</td>";
                    echo "<td align='right'>".number_format($row->bagianPetugas , 2)."</td>";
                    echo "<td align='right'>".number_format($row->bagianKlinik, 2)."</td>";
                    echo "<td align='right'>".number_format($row->jmlTindakan, 2)."</td>";
                    echo "<td align='right'>".number_format($row->jmlBarang, 2)."</td>";
                    echo "<td align='right'>".number_format($row->jmlLain1 + $row->jmlLain2 + $row->jmlLain3, 2)."</td>";
                    echo "<td align='right'>".number_format($row->jmlTindakan + $row->jmlBarang + $row->jmlLain1 + $row->jmlLain2 + $row->jmlLain3, 2)."</td>";
                    echo "</tr>";
                    $sumBagianPetugas += $row->bagianPetugas;
                    $sumBagianKlinik += $row->bagianKlinik;
                    $sumJmlTindakan += $row->jmlTindakan;
                    $sumJmlBarang += $row->jmlBarang;
                    $sumJmlLainnya +=  $row->jmlLain1 + $row->jmlLain2 + $row->jmlLain3;
                    $sumPenerimaan += $row->jmlTindakan + $row->jmlBarang + $row->jmlLain1 + $row->jmlLain2 + $row->jmlLain3;
                    $no++;
                }
            }
        ?>
    </tbody>
	<tr>
		<th colspan=4 style='text-align: right'>GRAND TOTAL PENERIMAAN (Rp.)</th>
		<th style='text-align: right'><?php echo number_format($sumBagianPetugas, 2)?></th>
		<th style='text-align: right'><?php echo number_format($sumBagianKlinik, 2)?></th>
		<th style='text-align: right'><?php echo number_format($sumJmlTindakan, 2)?></th>
		<th style='text-align: right'><?php echo number_format($sumJmlBarang, 2)?></th>
		<th style='text-align: right'><?php echo number_format($sumJmlLainnya, 2)?></th>
		<th style='text-align: right'><?php echo number_format($sumPenerimaan, 2)?></th>
	</tr>
</table>
<?php
            break;
        case 2:
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th style="vertical-align: middle">No.</th>
            <th style="vertical-align: middle">No. Nota</th>
            <th style="vertical-align: middle">Nama Pasien</th>
            <th style="vertical-align: middle">Tgl. Penerimaan</th>
            <th style="vertical-align: middle">Nama Tindakan</th>
            <th style="vertical-align: middle">Biaya Tindakan</th>
            <th style="vertical-align: middle">Qty</th>
            <th style="vertical-align: middle">Total Biaya</th>
        </tr>
    </thead>
    <tbody>
            <?php 
            $no = 1;
            $sumPenerimaan = 0;
            if($data){
                foreach ($data as $row) {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$row->noPembayaran."</td>";
                    echo "<td>".$row->namaPasien."</td>";
                    echo "<td>".date('d M Y', strtotime($row->tglPembayaran))."</td>";
                    echo "<td>".$row->namaTindakan."</td>";
                    echo "<td align='right'>".number_format($row->bagianPetugas, 2)."</td>";
                    echo "<td align='center'>".$row->qtyTindakan."</td>";
                    echo "<td align='right'>".number_format($row->bagianPetugas * $row->qtyTindakan, 2)."</td>";
                    echo "</tr>";
                    $sumPenerimaan += $row->bagianPetugas * $row->qtyTindakan;
                    $no++;
                }
            }
        ?>
    </tbody>
	<tr>
		<th colspan=7 style='text-align: right'>GRAND TOTAL PENERIMAAN (Rp.)</th>
		<th style='text-align: right'><?php echo number_format($sumPenerimaan, 2)?></th>
	</tr>
</table>
<?php
            break;
        case 3:
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th style="vertical-align: middle">No.</th>
            <th style="vertical-align: middle">No. Nota</th>
            <th style="vertical-align: middle">Keterangan</th>
            <th style="vertical-align: middle">Tgl. Penerimaan</th>
            <th style="vertical-align: middle">Nama Barang</th>
            <th style="vertical-align: middle">Qty</th>
            <?php if($this->session->userdata('lvlPengguna') == 0){?>
			<th style="vertical-align: middle">Harga Beli x Qty</th>
			<?php }?>
            <th style="vertical-align: middle">Harga Jual x Qty</th>
            <?php if($this->session->userdata('lvlPengguna') == 0){?>
            <th style="vertical-align: middle">Selisih</th>
			<?php }?>
        </tr>
    </thead>
    <tbody>
            <?php 
            $no = 1;
            $sumHargaBeli = 0;
            $sumHargaJual = 0;
            $sumPenerimaan = 0;
            if($data){
                foreach ($data as $row) {					
					$harga = $row->hargaJualBarang - ($row->hargaJualBarang * $row->diskonBarang/100);
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$row->idBarangKeluar."</td>";
                    echo "<td>".$row->ketBarangKeluar."</td>";
                    echo "<td>".date('d M Y', strtotime($row->tglBarangKeluar))."</td>";
                    echo "<td>".$row->namaBarang."</td>";
                    echo "<td>".$row->qtyBarang."</td>";
					if($this->session->userdata('lvlPengguna') == 0){
						echo "<td align='right'>".number_format($row->hargaBeliBarang * $row->qtyBarang, 2)."</td>";
					}
                    echo "<td align='right'>".number_format($harga * $row->qtyBarang, 2)."</td>";
					if($this->session->userdata('lvlPengguna') == 0){
						echo "<td align='right'>".number_format(($harga - $row->hargaBeliBarang) * $row->qtyBarang, 2)."</td>";
                    }
                    echo "</tr>";
                    $sumHargaBeli += $row->hargaBeliBarang * $row->qtyBarang;
                    $sumHargaJual += $harga * $row->qtyBarang;
                    $sumPenerimaan += ($harga- $row->hargaBeliBarang) * $row->qtyBarang;
                    $no++;
                }
            }
        ?>
    </tbody>
        <tr>
            <th colspan=6 style='text-align: right'>GRAND TOTAL (Rp.)</th>
            <?php if($this->session->userdata('lvlPengguna') == 0){?>
            <th style='text-align: right'><?php echo number_format($sumHargaBeli, 2)?></th>
			<?php }?>
            <th style='text-align: right'><?php echo number_format($sumHargaJual, 2)?></th>
            <?php if($this->session->userdata('lvlPengguna') == 0){?>
            <th style='text-align: right'><?php echo number_format($sumPenerimaan, 2)?></th>
			<?php }?>
            <th></th>
            <th></th>
        </tr>
</table>
<?php
            break;
        case 4:
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th style="vertical-align: middle">No.</th>
            <th style="vertical-align: middle">No. Nota</th>
            <th style="vertical-align: middle">Tgl. Penerimaan</th>
            <th style="vertical-align: middle">Biaya Resep</th>
            <th style="vertical-align: middle">Biaya Listrik</th>
            <th style="vertical-align: middle">Biaya Administrasi</th>
            <th style="vertical-align: middle">Total Biaya</th>
        </tr>
    </thead>
    <tbody>
            <?php 
            $no = 1;
            $sumResep = 0;
            $sumListrik = 0;
            $sumAdmin = 0;
            $sumTotal = 0;
            if($data){
                foreach ($data as $row) {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$row->noPenerimaan."</td>";
                    echo "<td>".date('d M Y', strtotime($row->tglPenerimaan))."</td>";
                    echo "<td align='right'>".number_format($row->resepPenerimaan, 2)."</td>";
                    echo "<td align='right'>".number_format($row->listrikPenerimaan, 2)."</td>";
                    echo "<td align='right'>".number_format($row->adminPenerimaan, 2)."</td>";
                    echo "<td align='right'>".number_format($row->resepPenerimaan + $row->listrikPenerimaan + $row->adminPenerimaan, 2)."</td>";
                    echo "</tr>";
                    $sumResep += $row->resepPenerimaan;
                    $sumListrik += $row->listrikPenerimaan;
                    $sumAdmin += $row->adminPenerimaan;
                    $sumTotal += $row->resepPenerimaan + $row->listrikPenerimaan + $row->adminPenerimaan;
                    $no++;
                }
            }
        ?>
    </tbody>
	<tr>
		<th colspan=3 style='text-align: right'>GRAND TOTAL (Rp.)</th>
		<th style='text-align: right'><?php echo number_format($sumResep, 2)?></th>
		<th style='text-align: right'><?php echo number_format($sumListrik, 2)?></th>
		<th style='text-align: right'><?php echo number_format($sumAdmin, 2)?></th>
		<th style='text-align: right'><?php echo number_format($sumTotal, 2)?></th>
	</tr>
</table>
<?php
            break;
    }
?>