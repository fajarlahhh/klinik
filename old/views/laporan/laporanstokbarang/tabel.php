<?php if($tp == 1) {?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Barang</th>
                <th>Stok Awal</th>
                <th>Stok Masuk</th>
                <th>Stok Keluar</th>
                <th>Stok Akhir</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                $no = 1;
                foreach ($data as $row) {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$row->namaBarang."</td>";
                    echo "<td align='center'>".$row->stokAwal." ".$row->satuanBarang."</td>";
                    echo "<td align='center'>".$row->stokMasuk." ".$row->satuanBarang."</td>";
                    echo "<td align='center'>".$row->stokKeluar." ".$row->satuanBarang."</td>";
                    echo "<td align='center'>".($row->stokAwal + $row->stokMasuk - $row->stokKeluar)." ".$row->satuanBarang."</td>";
                    echo "</td></tr>";
                    $no++;
                }
            ?>
        </tbody>
    </table>
<?php } else {?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Barang</th>
                <th>Stok</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                if($data){
                    foreach ($data as $row) {
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$row->namaBarang."</td>";
                        echo "<td align='center'>".$row->sumStok." ".$row->satuanBarang."</td>";
                        echo "<td>";
                        echo "<table width=100% border=1 style='border: 2px solid #eee; font-size: 12px;'>";
                        echo "<tr style='background: #eee; color: gray;'>
                                    <th><strong>Tgl. Kadaluarsa</strong></th>
                                    <th><strong>Jumlah</strong></th>
                                </tr>";
                        echo $row->stok;
                        echo "</table>";
                        echo "</td>";
                        echo "</tr>";
                        $no++;
                    }
                }
            ?>
        </tbody>
    </table>
<?php }?>