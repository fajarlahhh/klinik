<link rel="stylesheet" href="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'bootstrap-daterangepicker/daterangepicker.css')?>">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title">Laporan Penerimaan</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Laporan</a></li>
            <li class="active">Laporan Penerimaan</li>
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
                                <select class="form-control" id="filter-tipe" onchange="tipe()">
                                    <option value="1" <?php echo ($tp == 1? "selected": "")?>>Rekap</option>
                                    <option value="2" <?php echo ($tp == 2? "selected": "")?>>Tindakan</option>
                                    <option value="3" <?php echo ($tp == 3? "selected": "")?>>Penjualan Barang</option>
                                    <option value="4" <?php echo ($tp == 4? "selected": "")?>>Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group input-group input-group-sm"  style="min-width: 200px">
                                <input type="text" id="filter-tgl" class="form-control" readonly>
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                            </div>
                            <div class="form-group input-group-sm">
                                <select class="form-control" id="filter-kasir">
                                    <option value="" <?php echo ($ks == ""? "selected": "")?> id="opt-kasir">Semua Kasir</option>
                                    <?php 
                                        foreach ($kasir as $row) {
                                            echo "<option value='".$row->operator."'";
                                            if($row->operator == $ks)
                                                echo "selected";
                                            echo ">".$row->operator."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <a class="btn btn-primary btn-sm" onclick="filter()">Refresh</a>
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
                        <?php $this->load->view('laporan/laporanpenerimaan/tabel', array('tp' => $tp, 'total' => 0))?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
    $(function(){
        tipe();
    });

    $(function () {
        tipe();
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
        });
    })

    function tipe(){
        switch ($("#filter-tipe").val()) {
            case '1':
                $("#filter-kasir").show();
                $("#opt-kasir").text("Semua Kasir");
                break;
            case '2':
                $("#filter-kasir").show();
                $("#opt-kasir").text("Semua Dokter");
                break;
            case '3':
                $("#filter-kasir").show();
                $("#opt-kasir").text("Semua Dokter");
                break;
            case '4':
                $("#filter-kasir").hide();
                break;
        }
    }

    function filter(){
        window.location = base_url + 'laporanpenerimaan/index.html?tgl1='+ $('#filter-tgl').data('daterangepicker').startDate.format('YYYY-MM-DD') + '&tgl2=' + $('#filter-tgl').data('daterangepicker').endDate.format('YYYY-MM-DD') + '&ks=' + $("#filter-kasir").val() + '&tp=' + $("#filter-tipe").val() + '&q=' + $("#filter-cari").val();
    }
    function cetak(){
        var hal;
        switch ($("#filter-tipe").val()) {
            case '1':
                hal = 'rekap';
                break;
        
            case '2':
                hal = 'tindakan';
                break;
            
            case '3':
                hal = 'barang';
                break;
            case '4':
                hal = 'lainnya';
                break;
        }
        window.open(base_url + 'laporanpenerimaan/' + hal + '.html?tgl1='+ $('#filter-tgl').data('daterangepicker').startDate.format('YYYY-MM-DD') + '&tgl2=' + $('#filter-tgl').data('daterangepicker').endDate.format('YYYY-MM-DD') + '&ks=' + $("#filter-kasir").val() + '&tp=' + $("#filter-tipe").val() + '&q=' + $("#filter-cari").val(), '_blank');
    }
</script>