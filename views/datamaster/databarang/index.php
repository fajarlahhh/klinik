<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title">Data Barang</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li class="active">Data Barang</li>
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
                            <a href="<?php echo base_url('databarang/tambah')?>" class="btn btn-sm btn-primary" ><span class="glyphicon glyphicon-plus"></span> Tambah</a>
                            <?php }?>
							<a href="<?php echo base_url('databarang/cetak')?>" target="_blank" class="btn btn-sm btn-warning">Cetak</a>
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
                                    <th>Deskripsi</th>
                                    <th>Satuan Jual</th>
                                    <th>Stok Min</th>
                                    <th>Harga Beli + PPN</th>
                                    <th>Harga Jual</th>
                                    <th>Tipe</th>
                                    <th>Keterangan</th>
                                    <th>Barang Khusus</th>
                                    <th width=90></th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php 
                                    foreach ($data as $row) {
                                        echo "<tr>";
                                        echo "<td>".$row->namaBarang."</td>";
                                        echo "<td>".$row->deskBarang."</td>";
                                        echo "<td>".$row->satuanBarang."</td>";
                                        echo "<td>".$row->stokMinBarang."</td>";
                                        echo "<td class='text-right'>Rp. ".number_format($row->hargaBeliBarang, 2)."</td>";
                                        echo "<td class='text-right'>Rp. ".number_format($row->hargaJualBarang, 2)."</td>";
                                        //echo "<td class='text-center'>".$row->keuntunganBarang." %</td>";
                                        echo "<td>".($row->tipeBarang == 'o'? "Obat": "Alat/Bahan")."</td>";
                                        echo "<td>".$row->ketBarang."</td>";
                                        echo "<td>".($row->khusus == 1? 'Ya': 'Tidak')."</td>";
                                        echo "<td align='right'>";
										if($this->session->userdata('lvlPengguna') == 0){
											echo "<a href='".base_url('databarang/edit?id='.$row->idBarang)."' class='btn btn-default btn-xs'><i class='fa fa-pencil'></i></a>";
											if($this->session->userdata('lvlPengguna') == 0){
												echo "&nbsp;<a href='#' id='btn-del' class='btn btn-danger btn-xs' data-toggle='modal' data-no='".$row->idBarang."' data-target='#modal-hapus'><i class='fa fa-trash'></i></a>";
											}
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
        window.location = base_url + 'databarang/index.html?q=' + $("#filter-cari").val();
    }
</script>