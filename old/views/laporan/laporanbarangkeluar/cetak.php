<!DOCTYPE html>

<html>

    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>LAPORAN BARANG KELUAR TANGGAL <?php echo date('d M Y', strtotime($tgl1))." s/d ".date('d M Y', strtotime($tgl2))?></title>
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
            <img src="<?php echo base_url('img/favicon.png')?>" style="margin-botom: 10px" height=70><br>LAPORAN BARANG KELUAR TANGGAL <?php echo date('d M Y', strtotime($tgl1))." s/d ".date('d M Y', strtotime($tgl2))?>
        </h5>
        
        <br>
		<?php
							if($tp == 1)
								$this->load->view('laporan/laporanbarangkeluar/rinci');
							else
								$this->load->view('laporan/laporanbarangkeluar/rekap');
								
						?>
	</body>
</html>