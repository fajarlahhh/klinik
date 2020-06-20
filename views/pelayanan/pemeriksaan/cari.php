<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title" class="action">Input <small>Pemeriksaan</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pelayanan</a></li>
            <li class="active action">Input Pemeriksaan</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
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
                    </div>
                </div>
                <a href="<?php echo site_url('pemeriksaan/data');?>" class="btn btn-sm btn-info">Data Pemeriksaan</a>
            </div>
        </div>
    </section>
</div>
<script>
    $("#idPendaftaran").on("change", function(e) {
        window.location.href = base_url + 'pemeriksaan/form?no=' + $(this).select2('data')[0]['id'] + '&rm=' + $(this).select2('data')[0]['rmPasien'];
    });

    function format(data) {
        if (!data.id) { return data.text; }
        var $data = $("<div style='color: #151e1e;'><label>No. Pendaftaran</label> : " + data.id + "<br>"+
        "<label>Nama : </label>" + data.namaPasien + "<br><label>No. RM : </label>" + data.rmPasien + "<br><label>Alamat : </label>" + data.alamatPasien + "</div>");
        return $data;
    }

    $("#idPendaftaran").select2({
        minimumInputLength: 1,
        templateResult: format,
        ajax:{
            url: base_url + 'pemeriksaan/getblmperiksa',
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

</script>
