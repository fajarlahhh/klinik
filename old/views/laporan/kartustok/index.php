<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title">Kartu Stok</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Laporan</a></li>
            <li class="active">Kartu Stok</li>
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
                                <select class="form-control select2" id="filter-barang" onchange="filter()" style="min-width: 300px">
                                    <?php
                                        foreach ($barang as $br) { 
                                            echo "<option value='".$br->idBarang."' ";
                                            if ($br->idBarang == $brg) {
                                                echo " selected ";
                                            }
                                            echo ">".$br->namaBarang."</option>";
                                        }
                                    ?>
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
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <?php $this->load->view('laporan/kartustok/tabel', array('data' => $data))?>
                    </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
    $(".select2").select2();
    function filter(){
        window.location = base_url + 'kartustok/index.html?bln=' + $("#filter-bulan").val() + '&thn=' + $("#filter-tahun").val() + '&brg=' + $("#filter-barang").val() ;
    }
    function cetak(){
		window.open(base_url + 'kartustok/cetak.html?bln=' + $("#filter-bulan").val() + '&thn=' + $("#filter-tahun").val() + '&brg=' + $("#filter-barang").val() + '&nm=' + $("#filter-barang option:selected").text(), '_blank');
	}
</script>