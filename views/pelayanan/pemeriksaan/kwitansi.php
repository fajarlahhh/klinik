<!DOCTYPE html>

<html>

    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title><?php echo $data->noPembayaran;?></title>
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
        <?php echo $data->noPembayaran?>
        </div>
        <table>
            <tr>
                <td width='120'>No. RM</td>
                <td> : <?php echo $data->rmPasien?></td>
            </tr>
            <tr>
                <td>Nama Pasien</td>
                <td> : <?php echo $data->namaPasien?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td> : <?php echo $data->alamatPasien?></td>
            </tr>
            <tr>
                <td>No. Telp.</td>
                <td> : <?php echo $data->telpPasien?></td>
            </tr>
        </table>
        <br>
        DAFTAR TINDAKAN
        <table class="table">
            <tr>
                <th>No.</th>
                <th width='600'>Tindakan</th>
                <th>Harga</th>
                <th width='100'>Qty</th>
                <th>Total Harga</th>
            </tr>
            <?php
                $no = 1;
                $i = 0;
                $sumTindakan=0;
                foreach ($tindakan as $tdk) {
					$biaya = $tdk->biayaTindakan - ($tdk->diskonTindakan / 100 * $tdk->biayaTindakan);
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$tdk->namaTindakan."</td>";
                    echo "<td align='right'>".number_format($biaya, 2)."</td>";
                    echo "<td>".$tdk->qtyTindakan."</td>";
                    echo "<td align='right'>".number_format($tdk->qtyTindakan * $biaya, 2)."</td>";
                    echo "</tr>";
                    $no++;
                    $sumTindakan += $biaya;
                }
            ?>
            <tr>
                <td colspan="4" align="right"><b>TOTAL BIAYA TINDAKAN (Rp.)</b></td>
                <td align="right"><b><?php echo number_format($sumTindakan, 2)?></b></td>
            </tr>
        </table>
        DAFTAR ALAT/BAHAN
        <table class="table">
            <tr>
                <th>No.</th>
                <th width='600'>Alat/Bahan</th>
                <th>Harga</th>
                <th width='100'>Qty</th>
                <th>Total Harga</th>
            </tr>
            <?php
                $no = 1;
                $sumBarang=0;
                foreach ($barang as $brg) {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$brg->namaBarang."</td>";
                    echo "<td align='right'>".number_format($brg->hargaJualBarang, 2)."</td>";
                    echo "<td>".$brg->qtyBarang."</td>";
                    echo "<td align='right'>".number_format($brg->qtyBarang * $brg->hargaJualBarang, 2)."</td>";
                    echo "</tr>";
                    $no++;
                    $sumBarang += $brg->qtyBarang * $brg->hargaJualBarang;
                }
            ?>
            <tr>
                <td colspan="4" align="right"><b>TOTAL BIAYA ALAT/BAHAN (Rp.)</b></td>
                <td align="right"><b><?php echo number_format($sumBarang, 2)?></b></td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <th>TOTAL BIAYA TINDAKAN&nbsp;</th><td> </td><td width="110" align="right">Rp. <?php echo number_format($sumTindakan, 2)?></td><td></td>
            </tr>
            <tr>
                <th>TOTAL BIAYA ALAT/BAHAN&nbsp;</th><td> </td><td width="110" align="right">Rp. <?php echo number_format($sumBarang, 2)?></td><td></td>
            </tr>
            <tr>
                <th>BIAYA ADMINISTRASI&nbsp;</th><td> </td><td width="110" align="right">Rp. <?php echo number_format($data->adminPembayaran + $data->listrikPembayaran, 2)?></td><td></td>
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
            <?php echo date("d M Y", strtotime($data->tglPembayaran))?><br><br>
            ( <?php echo $data->operator?> )
        </div>
        <hr><br><br>
        <h4 class="text-center">TERIMA KASIH</h4>
    </div>
    </body>
</html>