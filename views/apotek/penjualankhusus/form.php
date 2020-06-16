<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title" class="action">Input <small>Penjualan Khusus</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pelayanan</a></li>
            <li class="active action">Input Penjualan Khusus</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php                    
            echo form_open('penjualankhusus/input/action', array(
                'method' => 'post',
                'data-toggle' => 'validator',
                'target' => '_blank',
                'onSubmit' => 'return cekStok()'
            ));
        ?>
        <div class="box box-solid">
            <div class="box-body">
				<div class="form-group">
					<?php 
						echo form_label('Tanggal Penjualan', 'tglBarangKeluar', array(
							'class' => "control-label"
						));
					?>
					<div class="input-group input-group-sm has-feedback date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<?php 
							echo form_input(array(
								'type' => 'text',
								'id' => 'tglBarangKeluar',
								'name' => 'tglBarangKeluar',
								'value' => date('d M Y'),
								'class' => 'form-control pull-right datepicker',
								'required' => '',
								'readonly' => ''
							));
						?>
					</div>
				</div>
                <div class="form-group input-group-sm has-feedback">
                    <?php 
                        echo form_label('Nama Pelanggan', 'pelangganBarangKeluar', array(
                            'class' => "control-label"
                        ));
                        echo form_input(array(
                            'type' => 'text',
                            'maxlength' => 255,
                            'id' => 'pelangganBarangKeluar',
                            'name' => 'pelangganBarangKeluar',
                            'class' => 'form-control',
                            'autocomplete' => 'off',
                            'required' => ''
                        ));
                    ?>
                </div>
                <div class="form-group input-group-sm has-feedback">
                    <?php 
                        echo form_label('Keterangan', 'ketBarangKeluar', array(
                            'class' => "control-label"
                        ));
                        echo form_input(array(
                            'type' => 'text',
                            'maxlength' => 500,
                            'id' => 'ketBarangKeluar',
                            'name' => 'ketBarangKeluar',
                            'class' => 'form-control',
                            'autocomplete' => 'off',
                            'required' => ''
                        ));
                    ?>
                </div>
				<div class="form-group input-group-sm">
					<?php
						echo form_label('Nama Dokter', 'namaDokter', array(
							'class' => "control-label"
						));
						echo form_dropdown('namaDokter', $dokter, '', array(
							'class' => 'form-control select2',
							'id' => 'namaDokter_',
							'style' => 'width: 100%;'
						));
					?>
				</div>
                <div id="resep-barang">
                    <div class="alert alert-info">
                        <div class="row">
                            <div class="col-xs-1">
                                <h4>R1</h4> 
                            </div>
                            <div class="col-xs-11">
                                <div class="form-group input-group-sm">
                                    <?php 
                                        echo form_label('Nama Resep', 'namaResep1', array(
                                            'class' => "control-label"
                                        ));
                                        echo form_input(array(
                                            'type' => 'text',
                                            'maxlength' => 500,
                                            'id' => 'namaResep1',
                                            'name' => 'namaResep[]',
                                            'class' => 'form-control',
                                            'autocomplete' => 'off'
                                        ));
                                    ?>
                                </div>
                                <div class="table-responsive no-padding">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Barang/Alat & Bahan</th>
                                                <th>Harga</th>
                                                <th width=120>Diskon</th>
                                                <th width=120>Qty</th>
                                                <th>Total Harga</th>
                                                <th width=5></th>
                                            </tr>
                                        </thead>
                                        <tbody id="detail-resep1">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center">
                                    <a class="btn btn-warning btn-sm" onclick="addBarang(1)" style="text-decoration: none;">Tambah Barang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a class="btn btn-info btn-sm" onclick="addResep()" style="text-decoration: none;">Tambah Resep</a>
                    <a class="btn btn-danger btn-sm" onclick="delResep()" style="text-decoration: none;">Hapus Resep</a>
                </div>
                <div class="form-group input-group-sm has-feedback">
                    <?php 
                        echo form_label('Biaya Resep', 'resepBarangKeluar', array(
                            'class' => "control-label"
                        ));
                        echo form_input(array(
                            'type' => 'text',
                            'maxlength' => 45,
                            'id' => 'resepBarangKeluar',
                            'name' => 'resepBarangKeluar',
                            'class' => 'form-control numbering',
							'onChange' => 'total()',
							'onKeyUp' => 'total()',
                            'autocomplete' => 'off',
                            'value' => 3000,
                            'required' => ''
                        ));
                    ?>
                </div>
                <div class="form-group input-group-sm has-feedback">
                    <?php 
                        echo form_label('Biaya Listrik', 'listrikBarangKeluar', array(
                            'class' => "control-label"
                        ));
                        echo form_input(array(
                            'type' => 'text',
                            'maxlength' => 45,
                            'id' => 'listrikBarangKeluar',
                            'name' => 'listrikBarangKeluar',
							'onChange' => 'total()',
							'onKeyUp' => 'total()',
                            'class' => 'form-control numbering',
                            'autocomplete' => 'off',
                            'value' => 2000,
                            'required' => ''
                        ));
                    ?>
                </div>
                <!--<div class="form-group input-group-sm has-feedback">
                    <?php 
                        echo form_label('Biaya Administrasi', 'adminBarangKeluar', array(
                            'class' => "control-label"
                        ));
                        echo form_input(array(
                            'type' => 'text',
                            'maxlength' => 45,
                            'id' => 'adminBarangKeluar',
                            'name' => 'adminBarangKeluar',
                            'class' => 'form-control numbering',
							'onChange' => 'total()',
							'onKeyUp' => 'total()',
                            'autocomplete' => 'off',
                            'value' => 10000,
                            'required' => ''
                        ));
                    ?>
                </div>-->
                <hr>
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
                <a href="<?php echo site_url('penjualankhusus/data');?>" class="btn btn-sm btn-primary">Data Penjualan</a>
            </div>
        </div>
        <?php echo form_close();?>
    </section>
</div>
<script>
    var brg;
    var barang;
    var jmlTagihan, jmlPembayaran, jmlKembali;
    var r = 2;
    
    $(document).ready(function() {
        brg = <?php echo $barangJSON; ?>;
        for (var i = 0; i < brg.length; i++) {
            barang = barang + "<option value='" + brg[i]['idBarang'] + "' data-nama='" + brg[i]['namaBarang'] + "' data-harga='" + brg[i]['hargaJualBarang'] + "'>" + brg[i]['namaBarang'] + "</option>";
        }
        jmlTagihan = new AutoNumeric('#jmlTagihan', 0, { modifyValueOnWheel : false });
        jmlPembayaran = new AutoNumeric('#jmlPembayaran', 0, { modifyValueOnWheel : false });
        jmlKembali = new AutoNumeric('#jmlKembali', 0, { modifyValueOnWheel : false });
        total();
    });

    function addBarang(r){
        var random = Math.floor(Math.random()*10000);
        $("#detail-resep" + r).append("<tr class='barang'>\
            <td><div class='input-group-sm'>\
                <select class='form-control form-control-sm idBarang' id='barang" + random + "' onchange='setHargaBarang("+random+")' name='idBarang[]' style='width: 100%; font-color: 12px'>" +
                    barang
                + "</select>\
            </div><label style='font-size: 12px; color:#dd4b39;' class='label' id='label" + random + "' data-id='" + random + "'>&nbsp;</label></td>\
            <td style='vertical-align: top'><div class='input-group-sm'>\
                <input type='text' class='form-control numbering' id='hrg" + random + "' value='0' name='hargaJualBarang[]' autocomplete='off' readonly>\
                <input type='hidden' id='rsp" + random + "' value='" + r + "' name='resepBarang[]'>\
            </div></td>\
			<td  style='vertical-align: top'><div class='input-group-sm'>\
				<input type='number' class='form-control diskonBarang' split='any' max=100 min=0 value='0' id='disc" + random + "' name='diskonBarang[]' autocomplete='off' onchange='setSumHargaBarang("+random+")' onkeyup='setSumHargaBarang("+random+")'>\
			</div></td>\
            <td style='vertical-align: top'><div class='input-group-sm'>\
                <input type='number' class='form-control qtyBarang' min='0' step='any' value='0' id='qty" + random + "' name='qtyBarang[]' autocomplete='off' onchange='setSumHargaBarang("+random+")' onkeyup='setSumHargaBarang("+random+")'>\
            </div></td>\
            <td style='vertical-align: top'><div class='input-group-sm'>\
                <input type='text' class='form-control numbering hargaJualBarang' id='sumhrg" + random + "' value='0.00' name='sumHargaJualBarang[]' autocomplete='off' readonly>\
            </div></td>\
            <td style='vertical-align: top'><a style='margin-top:3px' onclick='delBarang(this)' class='btn btn-danger btn-xs'><i class='fa fa-times'></i></a></td>\
        </tr>");
        $('#barang' + random).select2();
        setHargaBarang(random);
        total();
    }

    function setHargaBarang(i){
        $('#hrg' + i).val(rupiah($('#barang' + i).find(':selected').data('harga')));
        setSumHargaBarang(i);
    }

    function delBarang(id){
        $(id).closest("tr").remove();
        total();
    }

    function setSumHargaAlatBahan(i){
        $("#label" + i).text(' ');
        var harga = parseFloat($('#hrgabh' + i ).val().split(',').join(''));
        var qty = parseFloat(($('#qtyabh' + i ).val().length > 0? $('#qtyabh' + i ).val(): 0));
        $('#sumhrgabh' + i).val(rupiah(harga * (qty?qty:0)));
        $("#jmlPembayaran").val(0);
        total();
    }

    function setSumHargaBarang(i){
        $("#label" + i).text(' ');
        var harga = parseFloat($('#hrg' + i ).val().split(',').join(''));
        var qty = parseFloat(($('#qty' + i ).val().length > 0? $('#qty' + i ).val(): 0));
        var disc = parseFloat(($('#disc' + i ).val().length > 0? $('#disc' + i ).val(): 0));
        $('#sumhrg' + i).val(rupiah((harga - (harga * disc/100)) * (qty?qty:0)));
        $("#jmlPembayaran").val(0);
        total();
    }

    function addResep(){
        var hrg = 1000;
        if(r > 5)
            hrg = 0;
        $("#resep-barang").append("<div class='alert alert-info' id='R"+r+"'>\
            <div class='row'>\
                <div class='col-xs-1'>\
                    <h4>R"+r+"</h4>\
                </div>\
                <div class='col-xs-11'>\
                    <div class='input-group-sm'>\
                        <label for='namaResep" + r + "' class='control-label'>Nama Resep</label>\
                        <input type='text' class='form-control' id='namaResep" + r + "' name='namaResep[]' autocomplete='off'>\
                    </div>\
                    <div class='table-responsive no-padding'>\
                        <table class='table'>\
                            <thead>\
                                <tr>\
                                    <th>Barang</th>\
                                    <th>Harga</th>\
                                    <th width=120>Diskon</th>\
                                    <th width=120>Qty</th>\
                                    <th>Total Harga</th>\
                                    <th width=5></th>\
                                </tr>\
                            </thead>\
                            <tbody id='detail-resep"+r+"'>\
                            </tbody>\
                        </table>\
                    </div>\
                    <div class='text-center'>\
                        <a class='btn btn-warning btn-sm' onclick='addBarang("+r+")' style='text-decoration: none;'>Tambah Barang</a>\
                    </div>\
                </div>\
            </div>\
        </div>");
        r++;
        total();
    }

    function delResep(){
        $("#R" + (r-1)).remove();
        if(r >= 3)
            r--;
    }

    function total(){
        var sumBarang = 0;
        var listrik = parseFloat($("#listrikBarangKeluar").val()? $("#listrikBarangKeluar").val().split(',').join(''): 0);
        /*var admin = parseFloat($("#adminBarangKeluar").val()? $("#adminBarangKeluar").val().split(',').join(''): 0);*/
        var admin = 0;
        var resep = parseFloat($("#resepBarangKeluar").val()? $("#resepBarangKeluar").val().split(',').join(''): 0);

        $('.hargaJualBarang').each(function(i, obj) {
            if(this.value.length > 0)
                sumBarang += parseFloat(this.value.split(',').join(''));
            else
                sumBarang += 0;
        });
            
        jmlTagihan.set(sumBarang + resep + listrik + admin);
        balance();
    }
    
    function balance(){
        var bayar = 0;
        var tagihan = parseFloat($("#jmlTagihan").val().split(',').join(''));
        if($("#jmlPembayaran").val())
            bayar = parseFloat($("#jmlPembayaran").val().split(',').join(''));
        jmlKembali.set(
            bayar-tagihan
        );
        if(bayar >= tagihan && $('#pelangganBarangKeluar').val().length > 0 && $('#ketBarangKeluar').val().length > 0){
            $("#btn-simpan").prop("disabled", false);
        }else{
            $("#btn-simpan").prop("disabled", true);
        }
    }

    $(document).keypress(function(e) {
        if(e.which == 13) {
            $('form').validator();
        }
    });

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
