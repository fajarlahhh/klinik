<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title">Data Tindakan</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li class="active">Data Tindakan</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="form-inline">
                            <?php if($this->session->userdata('lvlPengguna') < 3){?>
                            <a href="<?php echo base_url('datatindakan/tambah')?>" class="btn btn-sm btn-primary" ><span class="glyphicon glyphicon-plus"></span> Tambah</a>
                            <?php }?>
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
                                    <th>Nama</th>
                                    <th>Bagian Klinik</th>
                                    <th>Bagian Dokter/Petugas</th>
                                    <th>Biaya</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php 
                                    foreach ($data as $row) {
                                        echo "<tr>";
                                        echo "<td>".$row->namaTindakan."</td>";
                                        echo "<td class='text-center'>".$row->bagianKlinik." %</td>";
                                        echo "<td class='text-center'>".$row->bagianPetugas." %</td>";
                                        echo "<td class='text-right'>".number_format($row->biayaTindakan,2)."</td>";
                                        echo "<td align='right'>";
                                        echo "<a href='".base_url('datatindakan/edit?id='.$row->idTindakan)."' class='btn btn-default btn-xs'><i class='fa fa-pencil'></i></a>";
                                        if($this->session->userdata('lvlPengguna') == 0){
                                            echo "&nbsp;<a href='#' id='btn-del' class='btn btn-danger btn-xs' data-toggle='modal' data-no='".$row->idTindakan."' data-target='#modal-hapus'><i class='fa fa-trash'></i></a>";
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
        window.location = base_url + 'datatindakan/index.html?q=' + $("#filter-cari").val();
    }
</script>