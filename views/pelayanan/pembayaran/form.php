<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title" class="action">Input <small>Pembayaran</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pelayanan</a></li>
            <li class="active action">Input Pembayaran</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php                    
            echo form_open('pembayaran/input/action', array(
                'method' => 'post',
                'data-toggle' => 'validator',
                'target' => '_blank',
                'onSubmit' => 'return cekStok()'
            ));
        ?>
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group input-group-sm has-feedback">
                            <?php
                                echo form_label('Cari No. Pendaftaran', 'idPendaftaran', array(
                                    'class' => "control-label"
                                ));
                                echo form_dropdown('idPendaftaran', '', '', array(
                                    'class' => 'form-control',
                                    'id' => 'idPendaftaran',
                                    'style' => 'width: 100%;'
                                ));
                            ?>
                        </div>
                        <div class="form-group input-group-sm has-feedback">
                            <?php 
                                echo form_label('No. RM', 'rmPasien', array(
                                    'class' => "control-label"
                                ));
                                echo form_input(array(
                                    'type' => 'text',
                                    'maxlength' => 24,
                                    'id' => 'rmPasien',
                                    'name' => 'rmPasien',
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'required' => '',
                                    'readonly' => ''
                                ));
                            ?>
                        </div>
                        <div class="form-group input-group-sm has-feedback">
                            <?php 
                                echo form_label('Nama', 'namaPasien', array(
                                    'class' => "control-label"
                                ));
                                echo form_input(array(
                                    'type' => 'text',
                                    'maxlength' => 255,
                                    'id' => 'namaPasien',
                                    'name' => 'namaPasien',
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'required' => '',
                                    'readonly' => ''
                                ));
                            ?>
                        </div>
                        <div class="form-group input-group-sm has-feedback">
                            <?php 
                                echo form_label('Alamat', 'alamatPasien', array(
                                    'class' => "control-label"
                                ));
                                echo form_input(array(
                                    'type' => 'text',
                                    'maxlength' => 500,
                                    'id' => 'alamatPasien',
                                    'name' => 'alamatPasien',
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'required' => '',
                                    'readonly' => ''
                                ));
                            ?>
                        </div>
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
                                    'autocomplete' => 'off',
                                    'required' => '',
                                    'readonly' => ''
                                ));
                            ?>
                        </div>
                        <hr>
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab" style="text-decoration: none;">Tindakan</a></li>
                                <li><a href="#tab_3" data-toggle="tab" style="text-decoration: none;">Alat & Bahan</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="alert alert-info">
                                        <div class="table-responsive no-padding">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th width="35%">Tindakan</th>
                                                        <th>Biaya</th>
                                                        <th width="100">Diskon (%)</th>
                                                        <th width="100">Qty</th>
                                                        <th>Total Biaya</th>
                                                        <th>Petugas</th>
                                                        <th width=5></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="detail-tdk">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center">
                                            <a class="btn btn-warning btn-sm" onclick="addTindakan()" style="text-decoration: none;">Tambah Tindakan</a>
                                        </div>
                                    </div>
<script>
    var tindakan;
    var ptg;
    var petugas;

    function addTindakan(){
        if(tindakan){
            var random = Math.floor(Math.random()*10000);
            $("#detail-tdk").append("<tr class='tindakan'>\
                <td><div class='input-group-sm'>\
                    <select class='form-control form-control-sm select2 idTindakan' id='tindakan" + random + "' onchange='setHargaTindakan("+random+")' name='idTindakan[]' style='width: 100%; font-color: 12px'>" +
                        tindakan
                    + "</select>\
                </div></td>\
                <td><div class='input-group-sm'>\
                    <input type='text' class='form-control numbering' id='hrgtdk" + random + "' value='0' name='biayaTindakan[]' autocomplete='off' readonly>\
                </div></td>\
                <td><div class='input-group-sm'>\
                    <input type='number' class='form-control diskonTindakan' split='any' max=100 min=0 value='0' id='disctdk" + random + "' name='diskonTindakan[]' autocomplete='off' onchange='setSumHargaTindakan("+random+")' onkeyup='setSumHargaTindakan("+random+")'>\
                </div></td>\
                <td><div class='input-group-sm'>\
                    <input type='number' class='form-control qtyTindakan' min=1 value='1' id='qtytdk" + random + "' name='qtyTindakan[]' autocomplete='off' onchange='setSumHargaTindakan("+random+")' onkeyup='setSumHargaTindakan("+random+")'>\
                </div></td>\
                <td><div class='input-group-sm'>\
                    <input type='text' class='form-control numbering biayaTindakan' id='sumhrgtdk" + random + "' value='0.00' autocomplete='off' readonly>\
                </div></td>\
                <td><div class='input-group-sm'>\
                    <select class='form-control form-control-sm select2' name='namaPetugas[]' style='width: 100%; font-color: 12px'>\
						<option value='dokter'>Dokter</option>" +
                    petugas
                    + "</select>\
                </div></td>\
                <td><a onclick='delTindakan(this)' class='btn btn-danger btn-xs'><i class='fa fa-times'></i></a></td>\
            </tr>");
            $('#tindakan' + random).select2();
            setHargaTindakan(random);
            total();
        }
    }

    function setHargaTindakan(i){
        $('#hrgtdk' + i).val(rupiah($('#tindakan' + i).find(':selected').data('harga')));
        setSumHargaTindakan(i);
    }

    function delTindakan(id){
        $(id).closest("tr").remove();
        total();
    }

    function setSumHargaTindakan(i){
        $("#label" + i).text(' ');
        var harga = parseFloat($('#hrgtdk' + i ).val().split(',').join(''));
        var qtytdk = parseFloat(($('#qtytdk' + i ).val().length > 0? $('#qtytdk' + i ).val(): 0));
        var disctdk = parseFloat(($('#disctdk' + i ).val().length > 0? $('#disctdk' + i ).val(): 0));
        $('#sumhrgtdk' + i).val(rupiah((harga - (harga * disctdk/100)) * qtytdk));
        $("#jmlPembayaran").val(rupiah(0));
        total();
    }
</script>
                                    </div>
                                    <div class="tab-pane" id="tab_3">
                                        <div class="alert alert-info">
                                            <div class="table-responsive no-padding">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Alat & Bahan</th>
                                                            <th>Harga</th>
                                                            <th width=100>Qty</th>
                                                            <th>Total Harga</th>
                                                            <th width=5></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="detail-brg">
                                                    </tbody>
                                                </table>
                                            </div>                                    
                                            <div class="text-center">
                                                <a class="btn btn-warning btn-sm" onclick="addBarang()" style="text-decoration: none;">Tambah Alat & Bahan</a>
                                            </div>
                                        </div>
<script>
    var brg;
    var barang;

    function addBarang(){
        var random = Math.floor(Math.random()*10000);
        $("#detail-brg").append("<tr class='barang'>\
            <td><div class='input-group-sm'>\
                <select class='form-control form-control-sm idBarang' id='barang" + random + "' onchange='setHargaBarang("+random+")' name='idBarang[]' style='width: 100%; font-color: 12px'>" +
                    barang
                + "</select>\
            </div><label style='font-size: 12px; color:#dd4b39;' class='label' id='label" + random + "' data-id='" + random + "'>&nbsp;</label></td>\
            <td style='vertical-align: top'><div class='input-group-sm'>\
                <input type='text' class='form-control numbering' id='hrgbrg" + random + "' value='0' name='hargaJualBarang[]' autocomplete='off' readonly>\
            </div></td>\
            <td style='vertical-align: top'><div class='input-group-sm'>\
                <input type='number' class='form-control qtyBarang' step='any' min=0 value='0' id='qtybrg" + random + "' name='qtyBarang[]' autocomplete='off' onchange='setSumHargaBarang("+random+")' onkeyup='setSumHargaBarang("+random+")'>\
            </div></td>\
            <td style='vertical-align: top'><div class='input-group-sm'>\
                <input type='text' class='form-control numbering hargaBarang' id='sumhrgbrg" + random + "' value='0.00' autocomplete='off' readonly>\
            </div></td>\
            <td style='vertical-align: top; padding-top: 13px'><a onclick='delBarang(this)' class='btn btn-danger btn-xs'><i class='fa fa-times'></i></a></td>\
        </tr>");
        $('#barang' + random).select2();
        setHargaBarang(random);
        total();
    }

    function setHargaBarang(i){
        $('#hrgbrg' + i).val(rupiah($('#barang' + i).find(':selected').data('harga')));
        setSumHargaBarang(i);
    }

    function delBarang(id){
        $(id).closest("tr").remove();
        total();
    }

    function setSumHargaBarang(i){
        $("#label" + i).text(' ');
        var harga = parseFloat($('#hrgbrg' + i ).val().split(',').join(''));
        var qtybrg = parseFloat(($('#qtybrg' + i ).val().length > 0? $('#qtybrg' + i ).val(): 0));
        $('#sumhrgbrg' + i).val(rupiah(harga * qtybrg));
        $("#jmlPembayaran").val(rupiah(0));
        total();
    }
</script>
                                </div>
                            </div>
                        </div>
                        <div class="form-group input-group-sm has-feedback">
                            <?php 
                                echo form_label('Biaya Listrik', 'listrikPembayaran', array(
                                    'class' => "control-label"
                                ));
                                echo form_input(array(
                                    'type' => 'text',
                                    'maxlength' => 45,
                                    'id' => 'listrikPembayaran',
                                    'name' => 'listrikPembayaran',
                                    'class' => 'form-control numbering',
                                    'autocomplete' => 'off',
                                    'value' => 0,
									'onChange' => 'total()',
									'onKeyUp' => 'total()',
                                    'style' => 'text-align: right',
                                    'required' => ''
                                ));
                            ?>
                        </div>
                        <div class="form-group input-group-sm has-feedback">
                            <?php 
                                echo form_label('Biaya Admin', 'adminPembayaran', array(
                                    'class' => "control-label"
                                ));
                                echo form_input(array(
                                    'type' => 'text',
                                    'maxlength' => 45,
                                    'id' => 'adminPembayaran',
                                    'name' => 'adminPembayaran',
                                    'class' => 'form-control numbering',
                                    'autocomplete' => 'off',
                                    'value' => 0,
									'onChange' => 'total()',
									'onKeyUp' => 'total()',
                                    'style' => 'text-align: right',
                                    'required' => ''
                                ));
                            ?>
                        </div>
                        <div class="form-group input-group-sm has-feedback">
                            <?php 
                                echo form_label('Tagihan', 'jmlTagihan', array(
                                    'class' => "control-label"
                                ));
                                echo form_input(array(
                                    'type' => 'text',
                                    'maxlength' => 45,
                                    'id' => 'jmlTagihan',
                                    'name' => 'jmlTagihan',
                                    'class' => 'form-control numbering',
                                    'autocomplete' => 'off',
                                    'required' => '',
                                    'readonly' => ''
                                ));
                            ?>
                        </div>
                        <div class="form-group input-group-sm has-feedback">
                            <?php 
                                echo form_label('Uang Yang Diterima', 'jmlPembayaran', array(
                                    'class' => "control-label"
                                ));
                                echo form_input(array(
                                    'type' => 'text',
                                    'maxlength' => 45,
                                    'id' => 'jmlPembayaran',
                                    'name' => 'jmlPembayaran',
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'onKeyUp' => 'balance()',
                                    'onChange' => 'balance()',
                                    'style' => 'text-align: right',
                                    'required' => ''
                                ));
                            ?>
                        </div>
                        <div class="form-group input-group-sm has-feedback">
                            <?php 
                                echo form_label('Uang Kembali', 'jmlKembali', array(
                                    'class' => "control-label"
                                ));
                                echo form_input(array(
                                    'type' => 'text',
                                    'maxlength' => 45,
                                    'id' => 'jmlKembali',
                                    'name' => 'jmlKembali',
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'style' => 'text-align: right',
                                    'required' => '',
                                    'readonly' => ''
                                ));
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                        if($this->session->userdata('lvlPengguna') < 3){
                        echo form_input(array(
                            'type' => 'submit',
                            'id' => 'btn-simpan',
                            'class' => 'btn btn-sm btn-success',
                            'value' => 'Simpan'
                        ));
                    }
                ?>
                <a href="<?php echo site_url('pembayaran/data');?>" class="btn btn-sm btn-info">Data Pembayaran</a>
            </div>
        </div>
        <?php echo form_close();?>
    </section>
</div>
<script>
    var jmlTagihan, jmlPembayaran, jmlKembali;

    $(document).keypress(function(e) {
        if(e.which == 13) {
            $('form').validator();
        }
    });

    $(document).ready(function() {
        brg = <?php echo $barangJSON; ?>;
        for (var i = 0; i < brg.length; i++) {
            barang = barang + "<option value='" + brg[i]['idBarang'] + "' data-nama='" + brg[i]['namaBarang'] + "' data-harga='" + brg[i]['hargaJualBarang'] + "'>" + brg[i]['namaBarang'] + "</option>";
        }
        ptg = <?php echo $petugasJSON; ?>;
        for (var i = 0; i < ptg.length; i++) {
            petugas = petugas + "<option value=" + ptg[i]['namaPetugas'] + ">" + ptg[i]['namaPetugas'] + "</option>";
        }
        jmlTagihan = new AutoNumeric('#jmlTagihan', 0, { modifyValueOnWheel : false });
        jmlPembayaran = new AutoNumeric('#jmlPembayaran', 0, { modifyValueOnWheel : false });
        jmlKembali = new AutoNumeric('#jmlKembali', 0, { modifyValueOnWheel : false });
        total();
    });

    $("#idPendaftaran").on("change", function(e) {
        $("#rmPasien").val($(this).select2('data')[0]['rmPasien']);
        $("#namaPasien").val($(this).select2('data')[0]['namaPasien']);
        $("#alamatPasien").val($(this).select2('data')[0]['alamatPasien']);
        $("#namaDokter").val($(this).select2('data')[0]['namaDokter']);
        $('form').validator();
        balance();
        $("#detail-brg tr").empty();
        $("#detail-tdk tr").empty();
        getTindakan();
        total();
    });

    function format(data) {
        if (!data.id) { return data.text; }
        var $data = $("<div style='color: #151e1e;'><label>No. Pendaftaran</label> : " + data.id + "<br>"+
        "<label>Nama : </label>" + data.namaPasien + "<br><label>No. RM : </label>" + data.rmPasien + "<br><label>Alamat : </label>" + data.alamatPasien + "</div>");
        return $data;
    }

    function getTindakan(){
        tindakan = null;
        $.ajax({
            url : base_url + "pembayaran/gettindakan",
            type : "POST",
            data : { dr : $("#namaDokter").val()},
            success : function(data){
                if(data){                    
                    for (var i = 0; i < data.length; i++) {
                        tindakan = tindakan + "<option value='" + data[i]['idTindakan'] + "' data-nama='" + data[i]['namaTindakan'] + "' data-harga='" + data[i]['biayaTindakan'] + "'>" + data[i]['namaTindakan'] + "</option>";
                    }
                }else {
                    tindakan = null;
                }
            },
            error:function(){
                tindakan = null;
            }
        });
    }

    $("#idPendaftaran").select2({
        minimumInputLength: 1,
        templateResult: format,
        ajax:{
            url: base_url + 'pembayaran/getblmbayar',
            dataType: "json",
            delay: 250,
            type : 'POST',
            data: function(params){
                return{
                    cari: params.term
                };
            },
            processResults: function(data){
                var results = [];

                $.each(data, function(index, item){
                    results.push({
                        id: item.idPendaftaran,
                        rmPasien : item.rmPasien,
                        namaPasien : item.namaPasien,
                        alamatPasien : item.alamatPasien,
                        namaDokter : item.namaDokter,
                        idDokter : item.idDokter,
                        tamuDokter : item.tamuDokter,
                        kelaminPasien : item.kelaminPasien,
                        text : item.idPendaftaran
                    });
                });
                return{
                    results: results
                };
            },
            cache: true,
        },
    });

    function total(){
        var sumBarang = 0;
        var sumTindakan = 0;
        var admin = parseFloat($('#adminPembayaran').val().split(',').join(''));
        var listrik = parseFloat($('#listrikPembayaran').val().split(',').join(''));

        $('.hargaBarang').each(function(i, obj) {
            if(this.value.length > 0)
                sumBarang += parseFloat(this.value.split(',').join(''));
            else
                sumBarang += 0;
        });

        $('.biayaTindakan').each(function(i, obj) {
            if(this.value.length > 0)
                sumTindakan += parseFloat(this.value.split(',').join(''));
            else
                sumTindakan += 0;
        });

        jmlTagihan.set(sumBarang + sumTindakan + admin + listrik);
        balance();
    }
    
    function balance(){
        var bayar = parseFloat($("#jmlPembayaran").val().split(',').join(''));
        var tagihan = parseFloat($("#jmlTagihan").val().split(',').join(''));
        jmlKembali.set(
            bayar-tagihan
        );
        if(bayar >= tagihan){
            $("#btn-simpan").prop("disabled", false);
        }else{
            $("#btn-simpan").prop("disabled", true);
        }
    }

    function cekStok(){
        var idBarang = {};
        var qtyBarang = {};
        var satuanBarang = {};
        var label = {};

        var x = 0;
        $(".idBarang").each(function() {
            idBarang[x] = $(this).val();
            x++;
        });

        var i = 0;
        $(".qtyBarang").each(function() {
            qtyBarang[i] = $(this).val();
            i++;
        });
        
        i = 0;
        $(".label").each(function() {
            label[i] = $(this).data('id');
            i++;
        });

        var sub = null;
        if(x > 0){
            sub = $.ajax({
                        url : base_url + 'penjualan/cekstok',
                        type : 'POST', 
                        data : { 'idBarang' : idBarang, 'qtyBarang' : qtyBarang, 'label' : label },
                        dataType: 'json', 
                        async: false,
                        cache: false,
                        success : function(result){
                            if(result != null){
                                $('.label').text(' ');
                                for (var i = result.length - 1; i >= 0; i--) {
                                    $("#label" + result[i][0]).text(result[i][1]);
                                }
                            }
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                            return false;
                        }
                    }).responseJSON;
        }

        if(sub == null)
            setTimeout(function(){window.location.reload();}, 10);
        else
            return false;
    }
</script>