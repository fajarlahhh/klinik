<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title" class="action"><?php echo $action;?> <small>Hak Akses</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Setup</a></li>
            <li class="active action"><?php echo $action;?> Hak Akses</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <?php                    
                    echo form_open_multipart('hakakses/'.strtolower($action).'/action', array(
                        'method' => 'post',
                        'data-toggle' => 'validator'
                    ));
                    echo form_hidden('back', $back);
                    echo form_hidden('ID', $idPengguna);
                    ?>
                        <div class="box-body">
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('ID', 'idPengguna', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 25,
                                        'id' => 'idPengguna',
                                        'name' => 'idPengguna',
                                        'class' => 'form-control',
                                        'value' => $idPengguna,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Nama', 'nmPengguna', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 255,
                                        'id' => 'nmPengguna',
                                        'name' => 'nmPengguna',
                                        'class' => 'form-control',
                                        'value' => $nmPengguna,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Telpon', 'tlpPengguna', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 15,
                                        'id' => 'tlpPengguna',
                                        'name' => 'tlpPengguna',
                                        'class' => 'form-control',
                                        'value' => $tlpPengguna,
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm has-feedback">
                                <?php 
                                    echo form_label('Kata Sandi', 'sandiPengguna', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_input(array(
                                        'type' => 'text',
                                        'maxlength' => 50,
                                        'id' => 'sandiPengguna',
                                        'name' => 'sandiPengguna',
                                        'class' => 'form-control',
                                        'value' => base64_decode($sandiPengguna),
                                        'autocomplete' => 'off',
                                        'required' => ''
                                    ));
                                ?>
                            </div>
                            <div class="form-group input-group-sm">
                                <?php
                                    echo form_label('Level', 'kdBrlvlPenggunag', array(
                                        'class' => "control-label"
                                    ));
                                    echo form_dropdown('lvlPengguna', array(
                                        '0' => 'Administrator', 
                                        '1' => 'Super User', 
                                        '2' => 'User', 
                                        '3' => 'Monitoring'
                                    ), $lvlPengguna, array(
                                        'class' => 'form-control',
                                        'id' => 'lvlPengguna',
                                        'style' => 'width: 100%; font-color: 12px',
                                        'onChange' => 'setHakAkses()'
                                    ));
                                ?>
                            </div>
                            <div class="row" id="hak-akses" hidden>
                                <?php 
                                    if($action == "Edit"){
                                        $i = 0;
                                        foreach ($detail as $row) {
                                            $akses[$i] = $row->kdMenu;
                                            $i++;
                                        }
                                    }
                                    
                                    $parent = null;
                                    foreach ($menu as $parent) {
                                        echo "<div class='col-md-3'>";
                                        if($parent->parentMenu == $parent->kdMenu){
                                            echo "<div class='form-group input-group-sm'>";
                                            echo form_checkbox(array(
                                                    'class' => 'minimal-red',
                                                    'name' => 'kdMenu[]',
                                                    'id' => strtolower($parent->kdMenu),
                                                    'value' => $parent->kdMenu,
                                                    'checked' => ($detail && in_array($parent->kdMenu, $akses) ? TRUE : FALSE)
                                                ));
                                            echo "<b>".$parent->nmMenu."</b><br>";
                                        }
                                        else{
                                            echo "<label>".$parent->nmMenu."</label>";
                                            echo "<div class='form-group input-group-sm'>";
                                            $submenu = $this->mmenu->get_child($parent->kdMenu, 'admin');
                                            foreach ($submenu as $sub) {
                                                echo form_checkbox(array(
                                                        'class' => 'minimal-red',
                                                        'name' => 'kdMenu[]',
                                                        'id' => strtolower($sub->kdMenu),
                                                        'value' => $sub->kdMenu,
                                                        'checked' => ($detail && in_array($sub->kdMenu, $akses) ? TRUE : FALSE)
                                                    ));
                                                echo $sub->nmMenu."<br>";
                                            }
                                        }
                                        echo "</div></div>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="box-footer">
                            <?php if($this->session->userdata('lvlPengguna') == 0){
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
                <div class="callout callout-info">
                    <h4>Level Hak Akses</h4>
                    <p>
                        <ul>
                            <li>
                                Administrator : Level tertinggi yang dapat melakukan segala hal.
                            </li>
                            <li>
                                Super User : Level no. 2 yang dapat melakukan input data dan pembatalan.
                            </li>
                            <li>
                                User : Level no. 3 yang dapat melakukan input data namun tidak dapat melakukan pembatalan.
                            </li>
                            <li>
                                Monitoring : Hanya dapat melakukan monitoring tidak dapat melakukan input, edit dan hapus data.
                            </li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(function(){
        setHakAkses();
    });

    function setHakAkses(){
        if($("#lvlPengguna option:selected").val() == 0 || $("#lvlPengguna option:selected").val() == 4){
            $('#hak-akses').hide();
        }else{
            $('#hak-akses').show();
        }
    }
</script>