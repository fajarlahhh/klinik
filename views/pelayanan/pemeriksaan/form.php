<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title" class="action">Input <small>Pemeriksaan</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pelayanan</a></li>
            <li class="active action">Input Pemeriksaan</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<form action="<?php echo site_url('pemeriksaan/form/action');?>" method="post" data-toggle="validator" role="form" enctype="multipart/form-data">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group input-group-sm has-feedback">
                            <?php 
                                echo form_label('No. Pendaftaran', 'idPendaftaran', array(
                                    'class' => "control-label"
                                ));
                                echo form_input(array(
                                    'type' => 'text',
                                    'maxlength' => 24,
                                    'id' => 'idPendaftaran',
                                    'name' => 'idPendaftaran',
									'class' => 'form-control',
									'value' => $data->idPendaftaran,
                                    'autocomplete' => 'off',
                                    'required' => '',
                                    'readonly' => ''
                                ));
                            ?>
                        </div>
                        <div class="form-group input-group-sm has-feedback">
                            <?php 
                                echo form_label('No. RM', 'rmPasien', array(
                                    'class' => "control-label"
                                ));
                                echo form_input(array(
                                    'type' => 'text',
                                    'maxlength' => 24,
                                    'id' => 'rmPasien',
                                    'name' => 'rmPasien',
									'value' => $data->rmPasien,
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'required' => '',
                                    'readonly' => ''
                                ));
                            ?>
                        </div>
                        <div class="form-group input-group-sm has-feedback">
                            <?php 
                                echo form_label('Nama', 'namaPasien', array(
                                    'class' => "control-label"
                                ));
                                echo form_input(array(
                                    'type' => 'text',
                                    'maxlength' => 255,
                                    'id' => 'namaPasien',
                                    'name' => 'namaPasien',
									'value' => $data->namaPasien,
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'required' => '',
                                    'readonly' => ''
                                ));
                            ?>
                        </div>
                        <div class="form-group input-group-sm has-feedback">
                            <?php 
                                echo form_label('Alamat', 'alamatPasien', array(
                                    'class' => "control-label"
                                ));
                                echo form_input(array(
                                    'type' => 'text',
                                    'maxlength' => 500,
                                    'id' => 'alamatPasien',
                                    'name' => 'alamatPasien',
									'value' => $data->alamatPasien,
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'required' => '',
                                    'readonly' => ''
                                ));
                            ?>
                        </div>
                        <div class="form-group input-group-sm has-feedback">
                            <?php 
                                echo form_label('Nama Dokter', 'namaDokter', array(
                                    'class' => "control-label"
                                ));
                                echo form_input(array(
                                    'type' => 'text',
                                    'maxlength' => 255,
                                    'id' => 'namaDokter',
                                    'name' => 'namaDokter',
									'value' => $data->namaDokter,
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'required' => '',
                                    'readonly' => ''
                                ));
                            ?>
                        </div>
                    </div>
						
                    <div class="col-md-8">
						<div class="alert alert-danger">
							<h5>Rekam Medis</h5>
							<hr>
							<div class="table-responsive" style="height: 400px">
								<table class="table">
									<thead>
										<tr>
											<th width="100">Tanggal Periksa</th>
											<th width="200">Diagnosa</th>
											<th width="300">Tindakan</th>
											<th>Foto</th>
										</tr>
										<?php
											foreach ($rm as $row) {
										?>
										<tr>
											<td><?php echo date('d M Y', strtotime($row->tglPeriksa? $row->tglPeriksa: $row->tglPendaftaran)) ?></td>
											<td>
											<?php 
												$pemeriksaan = $this->mrekammedis->get_pemeriksaan($row->idPendaftaran);
												foreach ($pemeriksaan as $det) {
													echo $det->diagnosaPemeriksaan.", sifat : ".$det->sifatPemeriksaan.", ket : ".$det->ketPemeriksaan."<br>";
												}
											?>
											</td>
											<td>
											<?php 
												$tindakan = $this->mrekammedis->get_tindakan($row->noPembayaran);
												foreach ($tindakan as $det) {
													echo $det->namaTindakan." ".$det->qtyTindakan." x , oleh ".$det->namaPetugas."<br>";
												}
											?>
											</td>
											<td><a href="<?php echo base_url($row->fotoPemeriksaan)?>" target="_blank"><img src="<?php echo base_url($row->fotoPemeriksaan)?>" alt="" width="100"></a></td>
										</tr>
										<?php
											}
										?>
									</thead>
								</table>
							</div>
							<hr>
							<h5>Obat</h5>
							<div class="table-responsive" style="height: 400px">
								<table class="table">
									<thead>
										<tr>
											<th width="100">Tanggal Pembelian</th>
											<th width="300">Nama Obat</th>
											<th>Qty</th>
										</tr>
										<?php
											foreach ($obat as $row) {
										?>
										<tr>
											<td><?php echo date('d M Y', strtotime($row->tglBarangKeluar)) ?></td>
											<td><?php echo $row->namaBarang ?></td>
											<td><?php echo $row->qtyBarang." ".$row->satuanBarang ?></td>
										</tr>
										<?php
											}
										?>
									</thead>
								</table>
							</div>
						</div>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab" style="text-decoration: none;">Diagnosa</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="form-group input-group-sm has-feedback">
                                        <label for="fotoPemeriksaan" class="control-label">Upload Foto</label>
                                        <input type="file" name="fotoPemeriksaan" id="fotoPemeriksaan" accept="image/*" >
                                        <span class="form-control-feedback glyphicon"></span>
                                    </div>
                                    <div class="alert alert-info">
                                        <div class="table-responsive no-padding">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th width="35%">Diagnosa</th>
                                                        <th width="20%">Sifat</th>
                                                        <th>Keterangan</th>
                                                        <th width=5></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="detail-tdk">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center">
                                            <a class="btn btn-warning btn-sm" onclick="addDiagnosa()" style="text-decoration: none;">Tambah Diagnosa</a>
                                        </div>
                                    </div>
								</div>              
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        if($this->session->userdata('lvlPengguna') < 3){
                        echo form_input(array(
                            'type' => 'submit',
                            'id' => 'btn-simpan',
                            'class' => 'btn btn-sm btn-success',
                            'value' => 'Simpan'
                        ));
                    }
                ?>
                <a href="<?php echo site_url('pemeriksaan');?>" class="btn btn-sm btn-danger">Kembali</a>
                <a href="<?php echo site_url('pemeriksaan/data');?>" class="btn btn-sm btn-info">Data Pemeriksaan</a>
            </div>
        </div>
        </form>
    </section>
</div>
<script>
    var diagnosa;

    function addDiagnosa(){
        if(diagnosa){
            var random = Math.floor(Math.random()*10000);
            $("#detail-tdk").append("<tr class='diagnosa'>\
                <td><div class='input-group-sm'>\
                    <select class='form-control form-control-sm select2 diagnosaPemeriksaan' id='diagnosa" + random + "' name='diagnosaPemeriksaan[]' style='width: 100%; font-color: 12px'>" +
                        diagnosa
                    + "</select>\
                </div></td>\
                <td><div class='input-group-sm'>\
                    <input type='text' class='form-control' name='sifatPemeriksaan[]' autocomplete='off'>\
                </div></td>\
                <td><div class='input-group-sm'>\
                    <input type='text' class='form-control' name='ketPemeriksaan[]' autocomplete='off'>\
                </div></td>\
                <td><a onclick='delDiagnosa(this)' class='btn btn-danger btn-xs'><i class='fa fa-times'></i></a></td>\
            </tr>");
            $('#diagnosa' + random).select2();
        }
    }
    function delDiagnosa(id){
        $(id).closest("tr").remove();
    }

    $(document).keypress(function(e) {
        if(e.which == 13) {
            $('form').validator();
        }
    });

    $(document).ready(function() {
        brg = <?php echo $diagnosaJSON; ?>;
        for (var i = 0; i < brg.length; i++) {
            diagnosa = diagnosa + "<option value='" + brg[i]['namaDiagnosa'] + "'>" + brg[i]['namaDiagnosa'] + "</option>";
        }
    });

    function getDiagnosa(){
        diagnosa = null;
        $.ajax({
            url : base_url + "pemeriksaan/getdiagnosa",
            type : "POST",
            data : { dr : $("#namaDokter").val()},
            success : function(data){
                if(data){                    
                    for (var i = 0; i < data.length; i++) {
                        diagnosa = diagnosa + "<option value='" + data[i]['diagnosaPemeriksaan'] + "' data-nama='" + data[i]['namaDiagnosa'] + "' data-harga='" + data[i]['sifatPemeriksaan'] + "'>" + data[i]['namaDiagnosa'] + "</option>";
                    }
                }else {
                    diagnosa = null;
                }
            },
            error:function(){
                diagnosa = null;
            }
        });
    }

</script>
