<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title" class="action"><?php echo $action;?> <small>Data Pasien</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li class="active action"><?php echo $action;?> Data Pasien</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <?php                    
                    echo form_open_multipart('datapasien/'.strtolower($action).'/action', array(
                        'method' => 'post',
                        'data-toggle' => 'validator'
                    ));
                    echo form_hidden('back', $back);
                    ?>
                        <div class="box-body">
                            <?php if($action == 'Edit') {?>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('ID', 'rmPasien', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 8,
                                        'id' => 'rmPasien',
                                        'name' => 'rmPasien',
                                        'class' => 'form-control',
                                        'value' => $rmPasien,
                                        'autocomplete' => 'off',
                                        'required' => '',
                                        'readonly' => ''
                                    ));
                                ?>
                            </div>
                            <?php }?>
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
                                        'class' => 'form-control',
                                        'value' => $namaPasien,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('No. KTP', 'ktpPasien', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 24,
                                        'id' => 'ktpPasien',
                                        'name' => 'ktpPasien',
                                        'class' => 'form-control',
                                        'value' => $ktpPasien,
                                        'autocomplete' => 'off',
                                        'required' => ''
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
                                        'class' => 'form-control',
                                        'value' => $alamatPasien,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Tempat Lahir', 'tempatLahirPasien', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 45,
                                        'id' => 'tempatLahirPasien',
                                        'name' => 'tempatLahirPasien',
                                        'class' => 'form-control',
                                        'value' => $tempatLahirPasien,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group">
                                <?php 
                                    echo form_label('Tanggal Lahir', 'tglLahirPasien', array(
                                        'class' => "control-label"
                                    ));
                                ?>
                                <div class="input-group input-group-sm has-feedback date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?php 
                                        echo form_input(array(
                                            'type' => 'text',
                                            'id' => 'tglLahirPasien',
                                            'name' => 'tglLahirPasien',
                                            'value' => $tglLahirPasien ? date('d M Y', strtotime($tglLahirPasien)) : date('d M Y'),
                                            'class' => 'form-control pull-right datepicker',
                                            'required' => '',
                                            'readonly' => ''
                                        ));
                                    ?>
                                </div>
                            </div>
                            <div class="form-group input-group-sm">
                                <?php
                                    echo form_label('Jenis Kelamin', 'kelaminPasien', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_dropdown('kelaminPasien', array(
                                        'L' => 'Laki-laki', 
                                        'P' => 'Perempuan'
                                    ), $kelaminPasien, array(
                                        'class' => 'form-control',
                                        'id' => 'kelaminPasien',
                                        'style' => 'width: 100%;'
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('No. Telp.', 'telpPasien', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 45,
                                        'id' => 'telpPasien',
                                        'name' => 'telpPasien',
                                        'class' => 'form-control',
                                        'value' => $telpPasien,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Pekerjaan', 'pekerjaanPasien', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 50,
                                        'id' => 'pekerjaanPasien',
                                        'name' => 'pekerjaanPasien',
                                        'class' => 'form-control',
                                        'value' => $pekerjaanPasien,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                        </div>
                        <div class="box-footer">
                            <?php if($this->session->userdata('lvlPengguna') < 3){
                            echo form_input(array(
                                'type' => 'submit',
                                'class' => 'btn btn-sm btn-success',
                                'value' => 'Simpan'
                            ));}?>
                            <a href="<?php echo $back;?>" class="btn btn-sm btn-danger">Batal</a>
                        </div>
                    <?php
                        echo form_close();
                    ?>
                </div>
            </div>
			<?php if($action == 'Edit') { ?>
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
											<td><a href="<?php base_url($row->fotoPemeriksaan)?>"><img src="<?php base_url($row->fotoPemeriksaan)?>" alt="" width="100"></a></td>
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
											<td><?php date('d M Y', strtotime($row->tglBarangKeluar)) ?></td>
											<td><?php $row->namaBarang ?></td>
											<td><?php $row->qtyBarang." ".$row->satuanBarang ?></td>
										</tr>
										<?php
											}
										?>
									</thead>
								</table>
							</div>
						</div>
                    </div>
			<?php }?>
		</div>
    </section>
</div>