<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="menu-title" class="action">Posting Stok Barang</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Administrator</a></li>
            <li class="active action">Posting Stok Barang</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row no-padding">
                            <div class="col-sm-12 form-inline">
                                <div class="form-group input-group-sm">
                                    <label for="cKode" class="control-label">Periode : </label>
                                    <select class="form-control" name="bulan" id="bulan">
                                        <?php
                                            for ($bln=1; $bln < 13; $bln++) { 
                                                echo "<option value='".date("m", strtotime("2017-".$bln."-1"))."' ";
                                                if ($bln == date("m", strtotime("-1 months"))) 
                                                    echo " selected ";                                                
                                                echo ">".date("F", strtotime("2016-".$bln."-1"))."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group input-group-sm">
                                    <select class="form-control" name="tahun" id="tahun">
                                        <?php
                                            for ($thn=2018; $thn < date("Y") + 1; $thn++) { 
                                                echo "<option value='".$thn."'";
                                                if ($thn == date('Y', strtotime("-1 months"))) 
                                                    echo " selected ";                                                
                                                echo ">".$thn."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <?php if($this->session->userdata('lvlPengguna') < 3){?>
                                <button onclick="posting()" id="btn_posting" class="btn btn-sm btn-success">
                                    Posting
                                </button>
                                <?php }?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="alert alert-info">
                    <center><b><u>Informasi</u></b><br>
                    Proses posting saldo akhir dilakukan pada akhir bulan transaksi.
                    </center>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    var waitingDialog = waitingDialog || (function ($) {
        'use strict';

    var $dialog = $(
        '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
        '<div class="modal-dialog modal-m">' +
        '<div class="modal-content">' +
        '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
        '<div class="modal-body">' +
            '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
        '</div>' +
        '</div></div></div>');

    return {
        show: function (message, options) {
        if (typeof options === 'undefined') {
            options = {};
        }
        if (typeof message === 'undefined') {
            message = 'Loading';
        }
        var settings = $.extend({
            dialogSize: 'm',
            progressType: '',
            onHide: null 
        }, options);

        $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
        $dialog.find('.progress-bar').attr('class', 'progress-bar');
        if (settings.progressType) {
            $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
        }
        $dialog.find('h3').text(message);
        if (typeof settings.onHide === 'function') {
            $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
            settings.onHide.call($dialog);
            });
        }
        $dialog.modal();
        },
        hide: function () {
            $dialog.modal('hide');
        }
    };

    })(jQuery);

    function posting(){
        $.ajax({
            url     : base_url + 'postingstok',
            type    : 'POST',
            cache   : false,
            data    : { bulan : $('#bulan').val(), tahun : $('#tahun').val() },
            timeout : 0,
            beforeSend: function() {
                waitingDialog.show('Mohon tunggu...');
            },
            success: function(data){
                if (data < 1){
                    alert('Proses posting gagal!!!');
                }
                waitingDialog.hide();
            },			
            error: function(jqXHR, textStatus, errorThrown) {
                if(textStatus==="timeout") {
                    alert("Call has timed out"); 
                } else {
                    alert("Another error was returned"); 
                }
            }
        });
    }
</script>