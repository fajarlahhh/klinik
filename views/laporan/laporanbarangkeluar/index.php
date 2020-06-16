<link rel="stylesheet" href="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'bootstrap-daterangepicker/daterangepicker.css')?>">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title">Laporan Barang Keluar</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Laporan</a></li>
            <li class="active">Laporan Barang Keluar</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="form-inline">
							<div class="form-group input-group-sm">
								<select class="form-control" id="filter-kriteria" onchange="filter()">
									<option value="0" <?php echo ($kriteria == 0? "selected": "")?>>Barang Biasa</option>
									<option value="1" <?php echo ($kriteria == 1? "selected": "")?>>Barang Khusus</option>
								</select>
							</div>
							<div class="form-group input-group-sm">
								<select class="form-control" id="filter-tipe" onchange="filter()">
									<option value="1" <?php echo ($tp == 1? "selected": "")?>>Rinci</option>
									<option value="2" <?php echo ($tp == 2? "selected": "")?>>Rekap</option>
								</select>
							</div>
                            <div class="form-group input-group input-group-sm"  style="min-width: 200px">
                                <input type="text" id="filter-tgl" class="form-control" readonly>
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                            </div>
                            <a class="btn btn-warning btn-sm" onclick="cetak()">Cetak</a>
                        </div>
                    
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 200px; margin-top: 5px">
                                <input type="text" id="filter-cari" value="<?php echo $q?>" class="form-control pull-right" placeholder="Cari" aria-describedby="basic-addon2" onchange="filter()">
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <?php
							if($tp == 1)
								$this->load->view('laporan/laporanbarangkeluar/rinci');
							else
								$this->load->view('laporan/laporanbarangkeluar/rekap');
								
						?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
    $(function () {
        $('#filter-tgl').daterangepicker({
            startDate: moment('<?php echo $tgl1?>'),
            endDate: moment('<?php echo $tgl2?>'),
            dateLimit: { days: 60 },
            showWeekNumbers: true,
            timePicker: false,
            ranges: {
                'Hari Ini': [moment(), moment()],
                'Bulan Ini': [moment().startOf('month'), moment().endOf('month')]
            },
            buttonClasses: ['btn'],
            applyClass: 'btn-sm btn-success',
            cancelClass: 'btn-sm btn-default',
            separator: ' s/d ',
            locale: {
                format: 'DD MMM YYYY',
                fromLabel: 'From',
                toLabel: 's/d',
                customRangeLabel: 'Manual',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        },function(){
            filter();
        });
    })

    function filter(){
        window.location = base_url + 'laporanbarangkeluar/index.html?tgl1='+ $('#filter-tgl').data('daterangepicker').startDate.format('YYYY-MM-DD') + '&tgl2=' + $('#filter-tgl').data('daterangepicker').endDate.format('YYYY-MM-DD') + '&tp=' + $("#filter-tipe").val() + '&q=' + $("#filter-cari").val() + '&kriteria=' + $("#filter-kriteria").val();
    }
    function cetak(){
        window.open(base_url + 'laporanbarangkeluar/cetak.html?tgl1='+ $('#filter-tgl').data('daterangepicker').startDate.format('YYYY-MM-DD') + '&tgl2=' + $('#filter-tgl').data('daterangepicker').endDate.format('YYYY-MM-DD') + '&tp=' + $("#filter-tipe").val() + '&q=' + $("#filter-cari").val() + '&kriteria=' + $("#filter-kriteria").val(), '_blank');
    }
</script>