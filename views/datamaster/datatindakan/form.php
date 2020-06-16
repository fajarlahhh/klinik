<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title" class="action"><?php echo $action;?> <small>Data Tindakan</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li class="active action"><?php echo $action;?> Data Tindakan</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <?php                    
                    echo form_open_multipart('datatindakan/'.strtolower($action).'/action', array(
                        'method' => 'post',
                        'data-toggle' => 'validator'
                    ));
                    echo form_hidden('back', $back);
                    echo form_hidden('idTindakan', $idTindakan);
                    ?>
                        <div class="box-body">
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Nama', 'namaTindakan', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 255,
                                        'id' => 'namaTindakan',
                                        'name' => 'namaTindakan',
                                        'class' => 'form-control',
                                        'value' => $namaTindakan,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Biaya', 'biayaTindakan', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 45,
                                        'id' => 'biayaTindakan',
                                        'name' => 'biayaTindakan',
                                        'class' => 'form-control numbering',
                                        'value' => $biayaTindakan,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Bagian Klinik (%)', 'bagianKlinik', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'number',
                                        'maxlength' => 3,
                                        'id' => 'bagianKlinik',
                                        'name' => 'bagianKlinik',
                                        'class' => 'form-control',
                                        'value' => $bagianKlinik,
                                        'step' => 'any',
                                        'min' => 0,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Bagian Dokter/Petugas (%)', 'bagianPetugas', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'number',
                                        'maxlength' => 3,
                                        'id' => 'bagianPetugas',
                                        'name' => 'bagianPetugas',
                                        'class' => 'form-control',
                                        'value' => $bagianPetugas,
                                        'step' => 'any',
                                        'min' => 0,
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
        </div>
    </section>
</div>
<script>
    $("#namaTindakan").focus();
</script>