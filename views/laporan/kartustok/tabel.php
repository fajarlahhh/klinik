<table class="table table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>No. Transaksi</th>
                <th>Keterangan</th>
                <th>Stok Awal</th>
                <th>Stok Masuk</th>
                <th>Stok Keluar</th>
                <th>Stok Akhir</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                if($stokawal){
                    $no = 1;
                    $stok = $stokawal->jmlBarang;
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td>Saldo Awal</td>";
                    echo "<td class='text-center'>".$stok."</td>";
                    echo "<td class='text-center'>0</td>";
                    echo "<td class='text-center'>0</td>";
                    echo "<td class='text-center'>".$stok."</td>";
                    echo "</tr>";
                    foreach ($data as $row) {
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".date('d M Y', strtotime($row->tglTransaksi))."</td>";
                        echo "<td>".$row->noTransaksi."</td>";
                        echo "<td>".$row->ketTransaksi."</td>";
                        echo "<td class='text-center'>".$stok."</td>";
                        echo "<td class='text-center'>";
                        if($row->tipeTransaksi == 1)
                            echo $row->jmlTransaksi;
                        else
                            echo 0;
                        echo "</td>";
                        echo "<td class='text-center'>";
                        if($row->tipeTransaksi == 0)
                            echo $row->jmlTransaksi;
                        else
                            echo 0;
                        echo "</td class='text-center'>";
                        if($row->tipeTransaksi == 1){
                            $stok += $row->jmlTransaksi;
                        }else{
                            $stok -= $row->jmlTransaksi;
                        }
                        echo "<td class='text-center'>".$stok."</td>";
                        echo "</tr>";
                        $no++;
                    }
                }
            ?>
        </tbody>
    </table>