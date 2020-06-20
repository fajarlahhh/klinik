<?php if($tp == 1) {?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tgl. Masuk</th>
                <th>Detail</th>
            </tr>                                
        </thead>
        <tbody>
                <?php 
                if($data){
                    $no = 1;
                    foreach ($data as $row) {
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".date('d M Y', strtotime($row->tglBarangMasuk))."</td>";
                        echo "<td>";
                        echo "<table width=100% border=1 style='border: 2px solid #eee; font-size: 12px;'>";
                        echo "<tr style='background: #eee; color: gray;'>
                                    <th><strong>Nama Barang</strong></th>
                                    <th><strong>Qty</strong></th>
                                </tr>";
                        echo $row->barang;
                        echo "</table>";
                        echo "</td>";
                        echo "</tr>";
                        $no++;
                    }
                }
            ?>
        </tbody>
    </table>
<?php } else {?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Keterangan</th>
                <th>Tgl. Masuk</th>
                <th>Operator</th>
                <th>Detail</th>
            </tr>                                
        </thead>
        <tbody>
                <?php 
                $sumHargaBeliBarangMasuk = 0;
                if($data){
                    foreach ($data as $row) {
                        echo "<tr>";
                        echo "<td>".$row->idBarangMasuk."</td>";
                        echo "<td>".$row->ketBarangMasuk."</td>";
                        echo "<td>".date('d M Y', strtotime($row->tglBarangMasuk))."</td>";
                        echo "<td>".$row->operator."</td>";
                        echo "<td>";
                        echo "<table width=100% border=1 style='border: 2px solid #eee; font-size: 12px;'>";
                        echo "<tr style='background: #eee; color: gray;'>
                                    <th><strong>Nama Barang</strong></th>
                                    <th><strong>Harga</strong></th>
                                    <th><strong>Qty</strong></th>
                                    <th><strong>Total Harga</strong></th>
                                    <th><strong>Tgl. Kadaluarsa</strong></th>
                                    <th><strong>Supplier</strong></th>
                                    <th><strong>Konsinyasi</strong></th>
                                </tr>";
                        echo $row->barang;
                        echo "</table>";
                        echo "</td>";
                        echo "</tr>";
                        $sumHargaBeliBarangMasuk += $row->sumHargaBeliBarangMasuk;
                    }
                }
            ?>
            <tr>
                <th colspan=4 style='text-align: right'>GRAND TOTAL HARGA OBAT MASUK (Rp.)</th>
                <th style='text-align: right'><?php echo number_format($sumHargaBeliBarangMasuk, 2)?></th>
            </tr>
        </tbody>
    </table>
<?php }?>