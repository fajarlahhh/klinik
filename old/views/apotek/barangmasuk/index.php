<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title">Barang Masuk</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Apotek</a></li>
            <li class="active">Barang Masuk</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="form-inline">
                            <a href="<?php echo base_url('barangmasuk')?>" class="btn btn-sm btn-primary" ><span class="glyphicon glyphicon-plus"></span> Tambah</a>
							<div class="form-group input-group-sm">
                                <select class="form-control" id="filter-kategori">
									<option value="1" <?php echo ($kat == 2? "selected": "")?>>Tgl. Masuk</option>
									<option value="2" <?php echo ($kat == 2? "selected": "")?>>Tgl. Jatuh Tempo Pembayaran</option>
									<option value="3" <?php echo ($kat == 3? "selected": "")?>>Tgl. Kadaluarsa</option>
                                </select>
                            </div>
                            <div class="form-group">
								<div class="input-group input-group-sm ">
									<?php 
										echo form_input(array(
											'type' => 'text',
											'id' => 'filter-tgl1',
											'value' => date('d M Y', strtotime($tgl1)),
											'class' => 'form-control datepicker',
											'required' => '',
											'readonly' => ''
										));
									?>
								</div>
							</div>
							s/d
							<div class="form-group">
								<div class="input-group input-group-sm ">
									<?php 
										echo form_input(array(
											'type' => 'text',
											'id' => 'filter-tgl2',
											'value' => date('d M Y', strtotime($tgl2)),
											'class' => 'form-control datepicker',
											'required' => '',
											'readonly' => ''
										));
									?>
								</div>
							</div>
							<a href="#" onClick="filter()" class="btn btn-sm btn-default" >Refresh</a>
							<a href="#" onClick="cetak()" class="btn btn-sm btn-warning" >Cetak</a>
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
                                    <th>ID Transaksi</th>
                                    <th>Tgl. Masuk</th>
                                    <th>Keterangan</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Tgl. Kadaluarsa</th>
                                    <th>Tgl. Jatuh Tempo Pembayaran</th>
                                    <th>Supplier</th>
                                    <th>Pabrik</th>
                                    <th>Konsinyasi</th>
                                    <th>Operator</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php 
                                    foreach ($data as $row) {
                                        echo "<tr>";
                                        echo "<td>".$row->idBarangMasuk."</td>";
                                        echo "<td>".date("d M Y", strtotime($row->tglBarangMasuk))."</td>";
                                        echo "<td>".$row->ketBarangMasuk."</td>";
                                        echo "<td>".$row->namaBarang."</td>";
                                        echo "<td>".$row->jmlBarang." ".$row->satuanBarang."</td>";
                                        echo "<td>".date("d M Y", strtotime($row->tglKadaluarsaBarang))."</td>";
                                        echo "<td>".date("d M Y", strtotime($row->tglJatuhTempo))."</td>";
                                        echo "<td>".$row->namaSupplier."</td>";
                                        echo "<td>".$row->konsinyasiSupplier."</td>";
                                        echo "<td>".$row->namaPabrik."</td>";
                                        echo "<td>".$row->operator."</td>";
                                        echo "<td align='right'>";
                                        if($this->session->userdata('lvlPengguna') < 2){
                                            echo "&nbsp;<a href='#' id='btn-del' class='btn btn-danger btn-xs' data-toggle='modal' data-no='".$row->idBarangMasuk."' data-target='#modal-hapus'><i class='fa fa-trash'></i></a>";
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
        window.location = base_url + 'barangmasuk/data?tgl1=' + $("#filter-tgl1").val() + '&tgl2=' + $("#filter-tgl2").val() + '&kat=' + $("#filter-kategori").val() + '&q=' + $("#filter-cari").val();
    }
    function cetak(){
		window.open(base_url + 'barangmasuk/cetak?tgl1=' + $("#filter-tgl1").val() + '&tgl2=' + $("#filter-tgl2").val() + '&kat=' + $("#filter-kategori").val() + '&q=' + $("#filter-cari").val(), '_blank');
    }
</script>