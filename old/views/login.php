<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Klinik</title>
    <link rel="icon" href="<?php echo base_url('img/favicon.png')?>" type="image/gif">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'bootstrap/dist/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url(TEMPLATE_DIST_PATH.'css/AdminLTE.css')?>">
    <link rel="stylesheet" href="<?php echo base_url(TEMPLATE_PLUGIN_PATH.'iCheck/all.css')?>">
    <link rel="stylesheet" href="<?php echo base_url(ASSET_PATH.'font-awesome/css/font-awesome.css')?>">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-box-body">
            <div class="login-logo">
                <img src="<?php echo base_url('img/favicon.png')?>" style="height: 100px;">
            </div>
            <?php
                echo form_open('login/validasi', array(
                    'method' => 'post',
                    'data-toggle' => 'validator'
                ));
                echo "<div class='form-group has-feedback'>";
                echo form_input(array(
                    'type' => 'text',
                    'name' => 'idPengguna',
                    'class' => 'form-control',
                    'placeholder' => 'ID Pengguna',
                    'value' => $idPengguna,
                    'autofocus' => true,
                    'autocomplete' => 'off',
                    'required' => ''
                ));
                echo "<span class='glyphicon glyphicon-user form-control-feedback'></span></div>";
                echo "<div class='form-group has-feedback'>";
                echo form_input(array(
                    'type' => 'password',
                    'name' => 'sandiPengguna',
                    'class' => 'form-control',
                    'placeholder' => 'Kata Sandi',
                    'value' => $sandiPengguna,
                    'autocomplete' => 'off',
                    'required' => ''
                ));
                echo "<span class='glyphicon glyphicon-lock form-control-feedback'></span></div>";
            ?>
            <div class="row">
                <div class="col-xs-8">
                    <?php 
                        echo form_input(array(
                            'type' => 'checkbox',
                            'class' => 'minimal minimal-blue',
                            'name' => 'pengingat',
                            'value' => 1
                        ));
                    ?>
                    Ingat Saya
                </div>
                <div class="col-xs-4">
                    <?php 
                        echo form_input(array(
                            'type' => 'submit',
                            'class' => 'btn btn-sm btn-primary btn-block btn-flat',
                            'value' => 'Login'
                        ));
                    ?>
                </div>
                <div class="col-xs-12">
                    <div class="error text-center" style="display: none; position: absolute; text-align: center">
                        <label style="font-size: 11px; color: red; "><?php echo $this->session->flashdata('message'); ?></label>
                    </div>
                </div>
            </div>
            <?php
                echo form_close();
            ?>
            <hr>
            <div class="text-center">
                <h5>© 2018</h5>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'jquery/dist/jquery.min.js')?>"></script>
    <script src="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'bootstrap/dist/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url(ASSET_PATH.'validator/validator.min.js')?>"></script>
	<script src="<?php echo base_url(TEMPLATE_PLUGIN_PATH.'iCheck/icheck.min.js')?>"></script>
    <script>
		$(function () {
            <?php if($this->session->flashdata('message')){ ?>
                $(".error").fadeIn('medium').delay(2000).fadeOut('medium');
            <?php } ?>
			$('input[type="checkbox"].minimal-blue, input[type="radio"].minimal-blue').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass   : 'iradio_minimal-blue'
			})
        });
    </script>
</body>
</html>