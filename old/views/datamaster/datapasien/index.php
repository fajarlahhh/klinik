<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title">Data Pasien</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li class="active">Data Pasien</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="form-inline">
                            <?php if($this->session->userdata('lvlPengguna') < 2){?>
                            <a href="<?php echo base_url('datapasien/tambah')?>" class="btn btn-sm btn-primary" ><span class="glyphicon glyphicon-plus"></span> Tambah</a>
                            <?php }else { echo "&nbsp;";}?>
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
                                    <th>No. RM</th>
                                    <th>No. KTP</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>TTL</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No. Telp.</th>
                                    <th>Pekerjaan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php 
                                    foreach ($data as $row) {
                                        echo "<tr>";
                                        echo "<td>".$row->rmPasien."</td>";
                                        echo "<td>".$row->ktpPasien."</td>";
                                        echo "<td>".$row->namaPasien."</td>";
                                        echo "<td>".$row->alamatPasien."</td>";
                                        echo "<td>".$row->tempatLahirPasien.", ".date("d M Y", strtotime($row->tglLahirPasien))."</td>";
                                        echo "<td>".($row->kelaminPasien == 'L'? 'Laki-laki' : 'Perempuan')."</td>";
                                        echo "<td>".$row->telpPasien."</td>";
                                        echo "<td>".$row->pekerjaanPasien."</td>";
                                        echo "<td align='right'>";
                                        echo "<a href='".base_url('datapasien/edit?id='.$row->rmPasien)."' class='btn btn-default btn-xs'><i class='fa fa-pencil'></i></a>";
                                        if($this->session->userdata('lvlPengguna') < 3){
                                            echo "&nbsp;<a href='#' id='btn-del' class='btn btn-danger btn-xs' data-toggle='modal' data-no='".$row->rmPasien."' data-target='#modal-hapus'><i class='fa fa-trash'></i></a>";
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
        window.location = base_url + 'datapasien/index.html?q=' + $("#filter-cari").val();
    }
</script>