<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title" class="action"><?php echo $action;?> <small>Data Supplier</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li class="active action"><?php echo $action;?> Data Supplier</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <?php                    
                    echo form_open_multipart('datasupplier/'.strtolower($action).'/action', array(
                        'method' => 'post',
                        'data-toggle' => 'validator'
                    ));
                    echo form_hidden('back', $back);
                    echo form_hidden('ID', $namaSupplier);
                    ?>
                        <div class="box-body">
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Nama', 'namaSupplier', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 255,
                                        'id' => 'namaSupplier',
                                        'name' => 'namaSupplier',
                                        'class' => 'form-control',
                                        'value' => $namaSupplier,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Alamat', 'alamatSupplier', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 500,
                                        'id' => 'alamatSupplier',
                                        'name' => 'alamatSupplier',
                                        'class' => 'form-control',
                                        'value' => $alamatSupplier,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('No. Telp.', 'telpSupplier', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 45,
                                        'id' => 'telpSupplier',
                                        'name' => 'telpSupplier',
                                        'class' => 'form-control',
                                        'value' => $telpSupplier,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm">
                                <?php
                                    echo form_label('Konsinyasi', 'konsinyasiSupplier', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_dropdown('konsinyasiSupplier', array('0' => 'Tidak', '1' => 'Ya'), $konsinyasiSupplier, array(
                                        'class' => 'form-control select2',
                                        'style' => 'width: 100%;'
                                    ));
                                ?>
                            </div>
                        </div>
                        <div class="box-footer">
                            <?php if($this->session->userdata('lvlPengguna') < 2){
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