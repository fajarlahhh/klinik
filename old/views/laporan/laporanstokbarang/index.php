<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title">Laporan Stok Barang</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Laporan</a></li>
            <li class="active">Laporan Stok Barang</li>
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
                                <select class="form-control" id="filter-tipe" onchange="filter()">
                                    <option value="1" <?php if($tp == 1) echo "selected";?>>Rekap</option>
                                </select>
                            </div>
                            <div class="form-group input-group-sm">
                                <select class="form-control" id="filter-bulan" onchange="filter()">
                                    <?php
                                        for ($b=1; $b < 13; $b++) { 
                                            echo "<option value='".$b."' ";
                                            if ($b == $bln) {
                                                echo " selected ";
                                            }
                                            echo ">".date("F", strtotime("2016-".$b."-1"))."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group input-group-sm">
                                <select class="form-control" id="filter-tahun" onchange="filter()">
                                    <?php
                                        for ($t=2018; $t < date("Y") + 1; $t++) { 
                                            echo "<option value='".$t."'";
                                            if ($t == $thn) {
                                                echo " selected ";
                                            }
                                            echo ">".$t."</option>";
                                        }
                                    ?>
                                </select>
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
                        <?php $this->load->view('laporan/laporanstokbarang/tabel', array('tp' => $tp))?>
                    </div>
                    <div class="box-footer clearfix">
                        <label>Jumlah Data : <?php if ($data) echo $total;?></label>
                        <?php if($page)echo $page; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
    function filter(){
        window.location = base_url + 'laporanstokbarang/index.html?bln=' + $("#filter-bulan").val() + '&thn=' + $("#filter-tahun").val() + '&tp=' + $("#filter-tipe").val() + '&q=' + $("#filter-cari").val();
    }
    function cetak(){
        if($("#filter-tipe").val() == 1)
            window.open(base_url + 'laporanstokbarang/rekap.html?bln=' + $("#filter-bulan").val() + '&thn=' + $("#filter-tahun").val() + '&q=' + $("#filter-cari").val(), '_blank');
        else
            window.open(base_url + 'laporanstokbarang/rinci.html?bln=' + $("#filter-bulan").val() + '&thn=' + $("#filter-tahun").val() + '&q=' + $("#filter-cari").val(), '_blank');
    }
</script>