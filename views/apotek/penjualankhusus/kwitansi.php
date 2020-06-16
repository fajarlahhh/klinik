<!DOCTYPE html>

<html>

    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title><?php echo $data->idBarangKeluar;?></title>
        <link rel="icon" href="<?php echo base_url('img/favicon.png')?>" type="image/gif">
        <link rel="stylesheet" href="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'bootstrap/dist/css/bootstrap.min.css')?>">
        <script src="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'jquery/dist/jquery.min.js')?>"></script>
    </head>
    <script>
        $( document ).ready(function() {
            window.print();
        });
    </script>
    <body style="font-size:10px; font-family: Tahoma, Geneva, sans-serif">
    <div class="container">
        <h4>
            <img src="<?php echo base_url('img/favicon.png')?>" style="margin-botom: 0px" height=70>
            <div class="pull-right" style="margin-top: 50px">NOTA PEMBAYARAN</div>
        </h4>
        <hr style="margin-top: -5px">
        <div class="pull-right">
        <?php echo $data->idBarangKeluar?>
        </div>
        <table>
            <tr>
                <td>Nama Pelanggan</td>
                <td> : <?php echo $data->pelangganBarangKeluar?></td>
            </tr>
        </table>
        <br>
        DAFTAR OBAT
        <table class="table">
            <tr>
                <th>No.</th>
                <th>Resep</th>
                <th width='600'>Obat/Bahan</th>
                <th>Harga</th>
                <th width='100'>Qty</th>
                <th>Total Harga</th>
            </tr>
            <?php
                $no = 1;
                $sumObat=0;
                $res = 0;				
                foreach ($resep as $det) {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".($res != $det->resep? $det->resep: '')."</td>";
                    echo "<td>".$det->namaResep."</td>";
                    echo "<td align='right'>".number_format($det->harga, 2)."</td>";
                    echo "<td align='center'>1</td>";
                    echo "<td align='right'>".number_format($det->harga, 2)."</td>";
                    echo "</tr>";
                    $no++;
                    $sumObat += $det->harga;
                    $res=$det->resep;
                }
                foreach ($detail as $det) {
					$harga = $det->hargaJualBarang - ($det->hargaJualBarang * $det->diskonBarang/100);
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".($res != $det->resep? $det->resep: '')."</td>";
                    echo "<td>".$det->namaBarang."</td>";
                    echo "<td align='right'>".number_format($harga, 2)."</td>";
                    echo "<td align='center'>".$det->qtyBarang."</td>";
                    echo "<td align='right'>".number_format($det->qtyBarang * $harga, 2)."</td>";
                    echo "</tr>";
                    $no++;
                    $sumObat += $harga * $det->qtyBarang;
                    $res=$det->resep;
                }
            ?>
        </table>  
        <table width='100%'>
            <tr>
                <th>GRAND TOTAL HARGA OBAT/BAHAN&nbsp;</th><td> </td><td width="110" align="right">Rp. <?php echo number_format($sumObat, 2)?></td><td></td>
            </tr>
            <tr>
                <th>BIAYA RESEP&nbsp;</th><td> </td><td width="110" align="right">Rp. <?php echo number_format($data->resepBarangKeluar, 2)?></td><td></td>
            </tr>
            <tr>
                <th>BIAYA ADMINISTRASI&nbsp;</th><td> </td><td width="110" align="right">Rp. <?php echo number_format($data->adminBarangKeluar + $data->listrikBarangKeluar, 2)?></td><td></td>
            </tr>
        </table>
		<br>
        <table width='100%'>
            <tr>
                <th>TAGIHAN&nbsp;</th><td> </td><td width="110" align="right">Rp. <?php echo number_format($data->jmlTagihan, 2)?></td><td></td>
            </tr>
            <tr>
                <th>PEMBAYARAN&nbsp;</th><td> </td><td width="110" align="right">Rp. <?php echo number_format($data->jmlPembayaran, 2)?></td><td></td>
            </tr>
            <tr>
                <th>UANG KEMBALI&nbsp;</th><td> </td><td width="110" align="right">Rp. <?php echo number_format(($data->jmlPembayaran - $data->jmlTagihan > 0? $data->jmlPembayaran - $data->jmlTagihan: 0), 2)?></td><td></td>
            </tr>
            <tr>
                <th>KEKURANGAN&nbsp;</th><td> </td><td width="110" align="right">Rp. <?php echo number_format(($data->jmlTagihan - $data->jmlPembayaran > 0? $data->jmlTagihan - $data->jmlPembayaran : 0), 2)?></td><td></td>
            </tr>
        </table>
        <hr>
        <div class="pull-right" align="center">
            <?php echo date("d M Y", strtotime($data->tglBarangKeluar))?><br><br>
            ( <?php echo $data->operator?> )
        </div>
        <hr>
        <h4 class="text-center">TERIMA KASIH</h4>
    </div>
    </body>
</html>