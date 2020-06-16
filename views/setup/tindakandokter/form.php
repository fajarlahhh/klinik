<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title" class="action"><?php echo $action;?> <small>Tindakan Dokter</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li class="active action"><?php echo $action;?> Tindakan Dokter</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <?php                    
                    echo form_open_multipart('tindakandokter/'.strtolower($action).'/action', array(
                        'method' => 'post',
                        'data-toggle' => 'validator'
                    ));
                    echo form_hidden('back', $back);
                    echo form_hidden('idDokter', $idDokter);
                    echo form_hidden('idTindakanDokter', $idTindakanDokter);
                    ?>
                        <div class="box-body">
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
                                        'class' => 'form-control',
                                        'value' => $namaDokter,
                                        'autocomplete' => 'off',
                                        'required' => '',
                                        'readonly' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo "<td><div class='input-group-sm'>";
                                    echo form_label('Tindakan', 'idTindakan', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_dropdown('idTindakan', $tindakan, $idTindakan, array(
                                        'class' => 'form-control form-control-sm select2',
                                        'id' => 'idTindakan',
                                        'name' => 'idTindakan',
                                        'style' => 'width: 100%;'
                                    ));
                                    echo "</div></td>";
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
                                        'value' => $biayaTindakan? $biayaTindakan: 0,
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
                                        'min' => 0,
                                        'step' => 'any',
                                        'id' => 'bagianKlinik',
                                        'name' => 'bagianKlinik',
                                        'class' => 'form-control',
                                        'value' => $bagianKlinik? $bagianKlinik: 0,
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
                                        'min' => 0,
                                        'step' => 'any',
                                        'id' => 'bagianPetugas',
                                        'name' => 'bagianPetugas',
                                        'class' => 'form-control',
                                        'value' => $bagianPetugas? $bagianPetugas: 0,
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
    $(".select2").select2();
</script>