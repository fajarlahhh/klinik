<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title">Data Penjualan Khusus</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Apotek</a></li>
            <li class="active">Data Penjualan Khusus</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="form-inline">
                            <a href="<?php echo base_url('penjualankhusus')?>" class="btn btn-sm btn-primary" ><span class="glyphicon glyphicon-plus"></span> Tambah</a>
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
                        </div>
                    
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 200px; margin-top: 5px">
                                <input type="text" id="filter-cari" value="<?php echo $q?>" class="form-control pull-right" placeholder="Cari" aria-describedby="basic-addon2" onchange="filter()">
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No. Penjualan</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Keterangan</th>
                                    <th>By. Resep</th>
                                    <th>By. Listrik</th>
                                    <th>By. Admin</th>
                                    <th>Operator</th>
                                    <th>Tgl. Penjualan</th>
                                    <th width=80></th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php 
                                    foreach ($data as $row) {
                                        echo "<tr>";
                                        echo "<td>".$row->idBarangKeluar."</td>";
                                        echo "<td>".$row->pelangganBarangKeluar."</td>";
                                        echo "<td>".$row->ketBarangKeluar."</td>";
                                        echo "<td class='text-right'>".number_format($row->resepBarangKeluar, 2)."</td>";
                                        echo "<td class='text-right'>".number_format($row->listrikBarangKeluar, 2)."</td>";
                                        echo "<td class='text-right'>".number_format($row->adminBarangKeluar, 2)."</td>";
                                        echo "<td>".$row->operator."</td>";
                                        echo "<td>".date("d M Y", strtotime($row->tglBarangKeluar))."</td>";
                                        echo "<td align='right'>";
                                        echo "&nbsp;<a href='".base_url('penjualankhusus/cetak?no='.urlencode($row->idBarangKeluar))."' class='btn bg-aqua btn-xs' data-toggle='modal' target='_blank'><i class='fa fa-print '></i></a>";
                                        echo "&nbsp;<a href='".base_url('penjualankhusus/cetakdetail?no='.urlencode($row->idBarangKeluar))."' class='btn bg-success btn-xs' data-toggle='modal' target='_blank'><i class='fa fa-print '></i></a>";
                                        if($this->session->userdata('lvlPengguna') < 2){
                                            echo "&nbsp;<a href='#' id='btn-del' class='btn btn-danger btn-xs' data-toggle='modal' data-no='".$row->idBarangKeluar."' data-target='#modal-hapus'><i class='fa fa-trash'></i></a>";
                                        }
                                        echo "</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
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
        window.location = base_url + 'penjualankhusus/data?bln=' + $("#filter-bulan").val() + '&thn=' + $("#filter-tahun").val() + '&q=' + $("#filter-cari").val();
    }
</script>
