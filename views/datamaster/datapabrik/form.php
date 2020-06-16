<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title" class="action"><?php echo $action;?> <small>Data Pabrik</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li class="active action"><?php echo $action;?> Data Pabrik</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <?php                    
                    echo form_open_multipart('datapabrik/'.strtolower($action).'/action', array(
                        'method' => 'post',
                        'data-toggle' => 'validator'
                    ));
                    echo form_hidden('back', $back);
                    ?>
                        <div class="box-body">
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Nama', 'namaPabrik', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 255,
                                        'id' => 'namaPabrik',
                                        'name' => 'namaPabrik',
                                        'class' => 'form-control',
                                        'value' => $namaPabrik,
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
    $("#namaPabrik").focus();
</script>