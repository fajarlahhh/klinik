<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title" class="action"><?php echo $action;?> <small>Data Barang</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li class="active action"><?php echo $action;?> Data Barang</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <?php                    
                    echo form_open_multipart('databarang/'.strtolower($action).'/action', array(
                        'method' => 'post',
                        'data-toggle' => 'validator'
                    ));
                    echo form_hidden('back', $back);
                    echo form_hidden('idBarang', $idBarang);
                    ?>
                        <div class="box-body">
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Nama', 'namaBarang', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 255,
                                        'id' => 'namaBarang',
                                        'name' => 'namaBarang',
                                        'class' => 'form-control',
                                        'value' => $namaBarang,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Deskripsi', 'deskBarang', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 50,
                                        'id' => 'deskBarang',
                                        'name' => 'deskBarang',
                                        'class' => 'form-control',
                                        'value' => $deskBarang,
                                        'autocomplete' => 'off'
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Satuan Jual', 'satuanBarang', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 45,
                                        'id' => 'satuanBarang',
                                        'name' => 'satuanBarang',
                                        'class' => 'form-control',
                                        'value' => $satuanBarang,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Stok Min', 'stokMinBarang', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'number',
                                        'maxlength' => 45,
                                        'id' => 'stokMinBarang',
                                        'name' => 'stokMinBarang',
                                        'class' => 'form-control',
                                        'step' => 'any',
                                        'value' => $stokMinBarang? $stokMinBarang: 10,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Harga Beli + PPN (Rp.)', 'hargaBeliBarang', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 45,
                                        'id' => 'hargaBeliBarang',
                                        'name' => 'hargaBeliBarang',
                                        'class' => 'form-control numbering',
                                        'value' => $hargaBeliBarang? $hargaBeliBarang: 0,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Harga Jual (Rp.)', 'hargaJualBarang', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 45,
                                        'id' => 'hargaJualBarang',
                                        'name' => 'hargaJualBarang',
                                        'class' => 'form-control numbering',
                                        'value' => $hargaJualBarang? $hargaJualBarang: 0,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <!--<div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Keuntungan (%)', 'keuntunganBarang', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'number',
                                        'maxlength' => 45,
                                        'id' => 'keuntunganBarang',
                                        'name' => 'keuntunganBarang',
                                        'class' => 'form-control',
                                        'step' => 'any',
                                        'min' => 0,
                                        'value' => $keuntunganBarang? $keuntunganBarang: 20,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>-->
                            <div class="form-group input-group-sm">
                                <?php
                                    echo form_label('Tipe', 'tipeBarang', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_dropdown('tipeBarang', array('o' => 'Obat', 'a' => 'Alat/Bahan'), $tipeBarang, array(
                                        'class' => 'form-control select2',
                                        'style' => 'width: 100%;'
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm">
                                <?php
                                    echo form_label('Barang Khusus', 'khusus', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_dropdown('khusus', array('0' => 'Tidak', '1' => 'Ya'), $khusus, array(
                                        'class' => 'form-control select2',
                                        'style' => 'width: 100%;'
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Keterangan', 'ketBarang', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'id' => 'ketBarang',
                                        'name' => 'ketBarang',
                                        'class' => 'form-control',
                                        'value' => $ketBarang,
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
    $("#namaBarang").focus();
</script>