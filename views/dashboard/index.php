<div class="content-wrapper">
    <section class="content-header">
        <h1 id="menu-title">&nbsp;</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-5 no-padding">
                <div class="col-md-12">
                    <div class="box box-solid" align="center">
                        <div class="box-body">
                            <img src="<?php echo base_url('img/favicon.png');?>" width="80%">
                            <hr>
                            <h4>Selamat 
                                <?php 
                                    if (date('H') > 5 and date('H') < 10) {
                                        echo "Pagi";
                                    }elseif (date('H') >= 10 and date('H') < 15) {
                                        echo "Siang";
                                    }elseif (date('H') >= 15 and date('H') < 18) {
                                        echo "Sore";
                                    }elseif (date('H') >= 18 and date('H') < 19) {
                                        echo "Petang";
                                    }elseif (date('H') >= 19 and date('H') < 24) {
                                        echo "Malam";
                                    }elseif (date('H') >= 0 and date('H') < 3) {
                                        echo "Dini Hari";
                                    }elseif (date('H') >= 3 and date('H') < 5) {
                                        echo "Dini Hari";
                                    }
                                ?> <b><?php echo $this->session->userdata('nmPengguna') ?></b>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>