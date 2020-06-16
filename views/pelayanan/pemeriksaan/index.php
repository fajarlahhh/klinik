<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title">Data Pemeriksaan</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pelayanan</a></li>
            <li class="active">Data Pemeriksaan</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="form-inline">
                            <a href="<?php echo base_url('pemeriksaan')?>" class="btn btn-sm btn-primary" ><span class="glyphicon glyphicon-plus"></span> Tambah</a>
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
                                    <th>No. RM</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tgl. Pemeriksaan</th>
                                    <th>Hasil</th>
                                    <th width=80></th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php 
                                    foreach ($data as $row) {
                                        echo "<tr>";
                                        echo "<td>".$row->rmPasien."</td>";
                                        echo "<td>".$row->namaPasien."</td>";
                                        echo "<td>".$row->alamatPasien."</td>";
                                        echo "<td>".($row->kelaminPasien == 'L'? 'Laki-laki' : 'Perempuan')."</td>";
                                        echo "<td>".date("d M Y", strtotime($row->tglPemeriksaan))."</td>";
										echo "<td>";
										$detail = $this->mpemeriksaan->get_diagnosa($row->idPendaftaran);
										echo "<table class='table-bordered' style='font-size: 10px'>";
										echo "<tr>";
										echo "<th style='width: 120px'>Diagnosa</th>";
										echo "<th style='width: 70px'>Sifat</th>";
										echo "<th style='width: 100px'>Keterangan</th>";
										echo "</tr>";
										foreach ($detail as $det) {
											echo "<tr>";
											echo "<td>".$det->diagnosaPemeriksaan."</td>";
											echo "<td>".$det->sifatPemeriksaan."</td>";
											echo "<td>".$det->ketPemeriksaan."</td>";
											echo "</tr>";
										}
										echo "</table>";
										echo "</td>";
										echo "<td align='right'>";
										if ($row->fotoPemeriksaan) {
											echo "&nbsp;<a href='".base_url($row->fotoPemeriksaan)."' class='btn bg-green btn-xs' data-toggle='modal' target='_blank'><i class='fa fa-images '></i></a>";
										}
                                        if($this->session->userdata('lvlPengguna') < 2){
                                            echo "&nbsp;<a href='#' id='btn-del' class='btn btn-danger btn-xs' data-toggle='modal' data-no='".$row->idPendaftaran."' data-target='#modal-hapus'><i class='fa fa-trash'></i></a>";
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
        window.location = base_url + 'pemeriksaan/data?bln=' + $("#filter-bulan").val() + '&thn=' + $("#filter-tahun").val() + '&q=' + $("#filter-cari").val();
    }
</script>
