<!DOCTYPE html>

<html>

    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>RINCIAN STOK OBAT BULAN <?php echo $bln." TAHUN ".$thn?></title>
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
            <img src="<?php echo base_url('img/favicon.png')?>" style="margin-botom: 10px" height=70><br>RINCIAN STOK OBAT BULAN <?php echo $bln." TAHUN ".$thn?>
            <br>
            <small>KATA KUNCI : <?php echo $q?></small>
        </h5>
        
        <br>
        <?php $this->load->view('laporan/laporanstokobat/tabel', array('tp' => 2))?>
    </body>
</html>