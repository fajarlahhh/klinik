<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Klinik </title>
    <link rel="icon" href="<?php echo base_url('img/favicon.png')?>" type="image/gif">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'bootstrap/dist/css/bootstrap.css')?>">
    <link rel="stylesheet" href="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'Ionicons/css/ionicons.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url(TEMPLATE_DIST_PATH.'css/AdminLTE.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url(TEMPLATE_DIST_PATH.'css/skins/_all-skins.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url(TEMPLATE_PLUGIN_PATH.'iCheck/all.css')?>">
    <link rel="stylesheet" href="<?php echo base_url(ASSET_PATH.'font-awesome/css/font-awesome.css')?>">
    <link rel="stylesheet" href="<?php echo base_url(ASSET_PATH.'select2-4.0.6-rc.1/dist/css/select2.min.css')?>">
    <style type="text/css">
        .numbering {
            text-align:right;
        }
        .select2-search__field{
            color: #000;
        }
        input[type=text].upper{
            text-transform:uppercase;
        }
    </style>

    <script src="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'jquery/dist/jquery.min.js')?>"></script>
    <script src="<?php echo base_url(ASSET_PATH.'select2-4.0.6-rc.1/dist/js/select2.full.min.js')?>"></script>
    <script type="text/javascript">
        var base_url = '<?php echo base_url();?>';
    </script>
</head>
<body class="hold-transition skin-blue-light sidebar-mini fixed">
    <div class="wrapper">
        <header class="main-header">
            <a href="<?php echo base_url('dashboard')?>" class="logo">
                <span class="logo-mini"><b>K.O.</b></span>
                <span class="logo-lg"><b>Klinik</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url('img/pengguna.png')?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $this->session->userdata('nmPengguna')?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo base_url('img/pengguna.png')?>" class="img-circle" alt="User Image">
                                    <p>
                                        <?php echo $this->session->userdata('nmPengguna')?><br>
                                        <small><?php echo $this->session->userdata('nikPengguna')?></small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('logout')?>" class="btn btn-default btn-flat">Log out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="alert alert-danger alert-dismissible" id="info" style="display:none; position: fixed;z-index: 1055; width: 50%; top: 95%; margin-top: -80px; margin-left: -50px; left: 35%" align="center">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <label id="text_message" style="font-size: 15px; white-space: pre-wrap;"></label>
        </div>