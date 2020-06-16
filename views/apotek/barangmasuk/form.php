<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title" class="action">Input <small>Barang Masuk</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Apotek</a></li>
            <li class="active action">Input Barang Masuk</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php                    
            echo form_open('barangmasuk/input/action', array(
                'method' => 'post',
                'data-toggle' => 'validator'
            ));
        ?>
        <div class="box box-solid">
            <div class="box-body">
                <div class="form-group">
                    <?php 
                        echo form_label('Tanggal Masuk', 'tglBarangMasuk', array(
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
                                'id' => 'tglBarangMasuk',
                                'name' => 'tglBarangMasuk',
                                'value' => date('d M Y'),
                                'class' => 'form-control datepicker',
                                'required' => '',
                                'readonly' => ''
                            ));
                        ?>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <?php 
                        echo form_label('Keterangan', 'ketBarangMasuk', array(
                            'class' => "control-label"
                        ));
                        echo form_textarea(array(
                            'id' => 'ketBarangMasuk',
                            'name' => 'ketBarangMasuk',
                            'class' => 'form-control',
                            'rows' => '3',
                            'autocomplete' => 'off',
                            'required' => ''
                        ));
                    ?>
                </div>
                <div class="alert alert-info alert-dismissible">
                    <div class="table-responsive no-padding">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th width=100>Qty</th>
                                    <th style="max-width=200">Tgl. Kadaluarsa</th>
                                    <th style="max-width=200">Tgl. Jatuh Tempo</th>
                                    <th>Supplier</th>
                                    <th>Pabrik</th>
                                    <th width="5"></th>
                                </tr>
                            </thead>
                            <tbody id="detail-brg">
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <a class="btn btn-warning btn-sm" onclick="addBarang()" style="text-decoration: none;">Tambah Barang</a>
                    </div>
                </div>
                <div class="form-group input-group-sm has-feedback">
                    <?php 
                        echo form_label('Total Harga', 'totalHarga', array(
                            'class' => "control-label"
                        ));
                        echo form_input(array(
                            'style' => 'text-align: right;',
                            'type' => 'text',
                            'maxlength' => 255,
                            'id' => 'totalHarga',
                            'name' => 'totalHarga',
                            'class' => 'form-control',
                            'autocomplete' => 'off',
                            'value' => number_format(0, 2),
                            'readonly' => ''
                        ));
                    ?>
                </div>
<script>
    var brg;
    var barang;
    var sup;
    var supplier;
    var pbr;
    var pabrik;

    $(document).ready(function() {
        brg = <?php echo $barangJSON; ?>;
        for (var i = 0; i < brg.length; i++) {
            barang = barang + "<option value=" + brg[i]['idBarang'] + " data-harga=" + brg[i]['hargaBeliBarang'] + ">" + brg[i]['namaBarang1'] + "</option>";
        }
        sup = <?php echo $supplierJSON; ?>;
        for (var i = 0; i < sup.length; i++) {
            supplier = supplier + "<option value=" + sup[i]['namaSupplier'] + ">" + sup[i]['namaSupplier'] + "</option>";
        }
        pbr = <?php echo $pabrikJSON; ?>;
        for (var i = 0; i < pbr.length; i++) {
            pabrik = pabrik + "<option value=" + pbr[i]['namaPabrik'] + ">" + pbr[i]['namaPabrik'] + "</option>";
        }
    });

    function addBarang(){
        var random = Math.floor(Math.random()*10000);
        $("#detail-brg").append("<tr class='barang'>\
            <td><div class='input-group-sm'>\
                <select class='form-control form-control-sm' name='idBarang[]' id='id" + random + "' style='width: 100%; font-color: 12px' onchange='setHargaBeli(" + random + ")'>" +
                    barang
                + "</select>\
            </div>\
            <input type='hidden' class='harga' id='hrg" + random + "' value='0' name='hargaBeliBarang[]' onkeyup='total()' onchange='total()' autocomplete='off'>\
            </td>\
            <td><div class='input-group-sm'>\
                <input type='number' class='form-control qty' step='any' min=0 value='0' onkeyup='total()' onchange='total()' name='jmlBarang[]' autocomplete='off'>\
            </div></td>\
            <td><div class='input-group-sm'>\
                <input type='text' class='form-control datepicker' value='<?php echo date('d M Y'); ?>' name='tglKadaluarsaBarang[]' readonly='' autocomplete='off'>\
            </div></td>\
            <td><div class='input-group-sm'>\
                <input type='text' class='form-control datepicker' value='<?php echo date('d M Y'); ?>' name='tglJatuhTempo[]' readonly='' autocomplete='off'>\
            </div></td>\
            <td><div class='input-group-sm'>\
                <select class='form-control form-control-sm' id='supp" + random + "' name='namaSupplier[]' style='width: 100%; font-color: 12px'>" +
                supplier
                + "</select>\
            </div></td>\
            <td><div class='input-group-sm'>\
                <select class='form-control form-control-sm' id='pabrik" + random + "' name='namaPabrik[]' style='width: 100%; font-color: 12px'>" +
                pabrik
                + "</select>\
            </div></td>\
            <td><a style='margin-top:3px' onclick='delBarang(this)' class='btn btn-danger btn-xs'><i class='fa fa-times'></i></a></td>\
        </tr>");
        $('#id' + random).select2();
        $('#supp' + random).select2();
        $('#pabrik' + random).select2();
        $('.datepicker').datepicker({
            autoclose: true,
            setDate : new Date(),
            format: "dd M yyyy"
        });
        setHargaBeli(random);
    }

    function setHargaBeli(id){
        var harga = $('#id' + id).select2().find(":selected").data("harga");
        $('#hrg' + id).val(rupiah(harga));
        new AutoNumeric('#hrg' + id, harga, { modifyValueOnWheel : false });
    }
    
    function total(){
        var total = 0;
        
        $('.harga').each(function(i, obj) {
            var qty = 0;
            var harga = parseFloat($(this).val().split(',').join(''));
            
            if($(this).closest('td').next('td').find('.qty').val())
                qty = parseFloat($(this).closest('td').next('td').find('.qty').val().split(',').join(''));


            total += harga * qty;
        });
        $('#totalHarga').val(rupiah(total));
    };

    function delBarang(id){
        $(id).closest("tr").remove();
        total();
    }
</script>
                <?php
                    if($this->session->userdata('lvlPengguna') < 2){
                        echo form_input(array(
                            'type' => 'submit',
                            'class' => 'btn btn-sm btn-success',
                            'value' => 'Simpan'
                        ));
                    }
                    echo form_close();
                ?>
                <a href="<?php echo site_url('barangmasuk/data');?>" class="btn btn-sm btn-primary">Data Barang Masuk</a>
            </div>
        </div>
    </section>
</div>