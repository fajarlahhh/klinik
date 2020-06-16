<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title" class="action"><?php echo $action;?> <small>Pendaftaran</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pelayanan</a></li>
            <li class="active action"><?php echo $action;?> Pendaftaran</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Pasien Baru</a></li>
                <li><a href="#tab_2" data-toggle="tab">Pasien Lama</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="row">
                        <div class="col-xs-6">
                        <?php                    
                            echo form_open('pendaftaran/'.strtolower($action).'/action', array(
                                'method' => 'post',
                                'data-toggle' => 'validator'
                            ));
                            echo form_hidden('back', $back);
                            echo form_hidden('baruOrLama', 'b');
                            echo form_hidden('idPendaftaran', $idPendaftaran);
                        ?>
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
                        <div class="col-xs-6">
							<div class="alert alert-info alert-dismissible">
								<div class="form-group">
									<?php 
										echo form_label('Tanggal Periksa', 'tglPendaftaran', array(
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
												'id' => 'tglPendaftaran',
												'name' => 'tglPendaftaran',
												'value' => $tglPendaftaran ? date('d M Y', strtotime($tglPendaftaran)) : date('d M Y'),
												'class' => 'form-control pull-right datepicker',
												'required' => '',
												'readonly' => ''
											));
										?>
									</div>
								</div>
                                <div class="form-group input-group-sm">
                                    <?php
                                        echo form_label('Nama Dokter', 'namaDokter', array(
                                            'class' => "control-label"
                                        ));
                                        echo form_dropdown('namaDokter', $dokter, $namaDokter, array(
                                            'class' => 'form-control select2',
                                            'id' => 'namaDokter_',
                                            'style' => 'width: 100%;'
                                        ));
                                    ?>
                                </div>
                                <div class="form-group has-feedback">
                                    <?php 
                                        echo form_label('Keterangan', 'keteranganPendaftaran', array(
                                            'class' => "control-label"
                                        ));
                                        echo form_textarea(array(
                                            'id' => 'keteranganPendaftaran',
                                            'name' => 'keteranganPendaftaran',
                                            'class' => 'form-control',
                                            'rows' => '5',
                                            'value' => $keteranganPendaftaran,
                                            'autocomplete' => 'off'
                                        ));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        if($this->session->userdata('lvlPengguna') < 3){
                            echo form_input(array(
                                'type' => 'submit',
                                'class' => 'btn btn-sm btn-success',
                                'value' => 'Simpan'
                            ));
                        }
                        echo form_close();
                    ?>
                    <a href="<?php echo site_url('pendaftaran/data');?>" class="btn btn-sm btn-info">Data Pendaftaran</a>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="row">
                        <div class="col-xs-6">
                        <?php                    
                            echo form_open('pendaftaran/'.strtolower($action).'/action', array(
                                'method' => 'post',
                                'data-toggle' => 'validator'
                            ));
                            echo form_hidden('back', $back);
                            echo form_hidden('baruOrLama', 'l');
                            echo form_hidden('idPendaftaran', $idPendaftaran);
                        ?>
                            <div class="form-group input-group-sm">
                                <?php 
                                    echo "<div class='form-group input-group-sm'>";
                                    echo form_label('Cari Pasien', 'rmPasien', array(
                                        'class' => "control-label"
                                    ));
                                    $rm = ($action == 'edit'? 'select2': '');
                                    echo form_dropdown('rmPasien', '', '', array(
                                        'id' => 'rmPasien',
                                        'class' => 'form-control form-control-sm '.$rm,
                                        'style' => 'width: 100%;',
                                        'required' => ''
                                    ));
                                    echo '</div>';
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
                                        'class' => 'form-control',
                                        'value' => $namaPasien,
                                        'autocomplete' => 'off',
                                        'required' => '',
                                        'readonly' => ''
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
                                        'class' => 'form-control',
                                        'value' => $alamatPasien,
                                        'autocomplete' => 'off',
                                        'required' => '',
                                        'readonly' => ''
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
                                        'required' => '',
                                        'readonly' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group">
                                <?php 
                                    echo form_label('Tanggal Lahir', 'tglLahirPasien', array(
                                        'class' => "control-label"
                                    ));
                                ?>
                                <div class="input-group input-group-sm has-feedback">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?php 
                                        echo form_input(array(
                                            'type' => 'text',
                                            'id' => 'tglLahirPasien',
                                            'name' => 'tglLahirPasien',
                                            'value' => $tglLahirPasien ? date('d M Y', strtotime($tglLahirPasien)) : '',
                                            'class' => 'form-control pull-right ',
                                            'required' => '',
                                            'readonly' => ''
                                        ));
                                    ?>
                                </div>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Jenis Kelamin', 'kelaminPasien', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 45,
                                        'id' => 'kelaminPasien',
                                        'name' => 'kelaminPasien',
                                        'class' => 'form-control',
                                        'value' => $kelaminPasien,
                                        'autocomplete' => 'off',
                                        'required' => '',
                                        'readonly' => ''
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
                                        'required' => '',
                                        'readonly' => ''
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
                                        'required' => '',
                                        'readonly' => ''
                                    ));
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="alert alert-info alert-dismissible">
								<div class="form-group">
									<?php 
										echo form_label('Tanggal Periksa', 'tglPendaftaran', array(
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
												'id' => 'tglPendaftaran',
												'name' => 'tglPendaftaran',
												'value' => $tglPendaftaran ? date('d M Y', strtotime($tglPendaftaran)) : date('d M Y'),
												'class' => 'form-control pull-right datepicker',
												'required' => '',
												'readonly' => ''
											));
										?>
									</div>
								</div>
                                <div class="form-group input-group-sm">
                                    <?php
                                        echo form_label('Nama Dokter', 'namaDokter', array(
                                            'class' => "control-label"
                                        ));
                                        echo form_dropdown('namaDokter', $dokter, $namaDokter, array(
                                            'class' => 'form-control select2',
                                            'id' => 'namaDokter',
                                            'style' => 'width: 100%;'
                                        ));
                                    ?>
                                </div>
                                <div class="form-group has-feedback">
                                    <?php 
                                        echo form_label('Keterangan', 'keteranganPendaftaran', array(
                                            'class' => "control-label"
                                        ));
                                        echo form_textarea(array(
                                            'id' => 'keteranganPendaftaran',
                                            'name' => 'keteranganPendaftaran',
                                            'class' => 'form-control',
                                            'rows' => '5',
                                            'value' => $keteranganPendaftaran,
                                            'autocomplete' => 'off'
                                        ));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        if($this->session->userdata('lvlPengguna') < 3){
                            echo form_input(array(
                                'type' => 'submit',
                                'class' => 'btn btn-sm btn-success',
                                'value' => 'Simpan'
                            ));
                        }
                        echo form_close();
                    ?>
                    <a href="<?php echo site_url('pendaftaran/data');?>" class="btn btn-sm btn-info">Data Pendaftaran</a>
                </div>
            </div>
            <!-- /.tab-content -->
        </div>
    </section>
</div>
<script>
    $("#namaPasien").focus();
    
    $(".select2").select2();
    $("#rmPasien").on("change", function(e) {
        $("#tab_2 #namaPasien").val($(this).select2('data')[0]['namaPasien']);
        $("#tab_2 #alamatPasien").val($(this).select2('data')[0]['alamatPasien']);
        $("#tab_2 #ktpPasien").val($(this).select2('data')[0]['ktpPasien']);
        $("#tab_2 #tempatLahirPasien").val($(this).select2('data')[0]['tempatLahirPasien']);
        $("#tab_2 #tglLahirPasien").val($(this).select2('data')[0]['tglLahirPasien_']);
        $("#tab_2 #kelaminPasien").val(($(this).select2('data')[0]['kelaminPasien'] == 'L'? 'Laki-laki': 'Perempuan'));
        $("#tab_2 #telpPasien").val($(this).select2('data')[0]['telpPasien']);
        $("#tab_2 #pekerjaanPasien").val($(this).select2('data')[0]['pekerjaanPasien']);
    });

    function format(data) {
        if (!data.id) { return data.text; }
        var $data = $("<tr><th width='90'>No. RM</th><td>: " + data.id + "</td></tr>" + 
                        "<tr><th>Nama</th><td>: " + data.namaPasien + "</td></tr>" + 
                        "<tr><th>Alamat</th><td>: " + data.alamatPasien + "</td></tr>"+ 
                        "<tr><th>Jenis Kelamin</th><td>: " + data.kelaminPasien + "</td></tr>");
        return $data;
    }

    $("#rmPasien").select2({
        minimumInputLength: 1,
        templateResult: format,
        ajax:{
            url: base_url + 'datapasien/getpasien',
            dataType: "json",
            delay: 250,
            type : 'POST',
            data: function(params){
                return{
                    ID: params.term
                };
            },
            processResults: function(data){
                var results = [];

                $.each(data, function(index, item){
                    results.push({
                        id: item.rmPasien,
                        namaPasien : item.namaPasien ,
                        alamatPasien : item.alamatPasien ,
                        ktpPasien : item.ktpPasien ,
                        tempatLahirPasien : item.tempatLahirPasien ,
                        tglLahirPasien_ : item.tglLahirPasien_ ,
                        kelaminPasien : item.kelaminPasien ,
                        telpPasien : item.telpPasien ,
                        pekerjaanPasien : item.pekerjaanPasien ,
                        text: item.rmPasien
                    });
                });
                return{
                    results: results
                };
            }
        }
    });
</script>