    	<div class="modal fade modal-danger" id="modal-hapus" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-md">
				<div class="modal-content">		
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="title">Hapus Data</h4>
					</div>
					<?php
						echo form_open($this->uri->segment(1).'/delete', array(
							'method' => 'post'
						));
						echo "<div class='modal-body' align='center'>";
						echo "<h5 id='hapus-pesan' style='font-weight: bold;'></h5>";
						echo form_input(array(
							'type' => 'hidden',
							'name' => 'ID',
							'id' => 'remove_ID'
						));
						echo "</div>";
						echo "<div class='modal-footer'>";
						echo form_input(array(
							'type' => 'submit',
							'class' => 'btn btn-sm btn-danger',
							'value' => 'OK',
							'style' => 'cursor:pointer'
						));
						echo "</div>";
                        echo form_close();
					?>
            	</div>
	      	</div>
		</div>

		<footer class="main-footer fixed">
			<div class="pull-right hidden-xs">
			  	<b>Ver</b> 1.0
			</div>
			<strong>Copyright &copy; 2018</strong>
		</footer>
		<div class="control-sidebar-bg"></div>
	</div>

    <script src="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'bootstrap/dist/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
	<script src="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>
	<script src="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'select2/dist/js/select2.full.min.js')?>"></script>
	<script src="<?php echo base_url(TEMPLATE_DIST_PATH.'js/adminlte.min.js')?>"></script>
	<script src="<?php echo base_url(TEMPLATE_PLUGIN_PATH.'iCheck/icheck.min.js')?>"></script>
    <script src="<?php echo base_url(ASSET_PATH.'validator/validator.min.js')?>"></script>
    <script src="<?php echo base_url(ASSET_PATH.'autonumeric/dist/autoNumeric.min.js');?>"></script>
    <script src="<?php echo base_url(ASSET_PATH.'moment/moment.min.js');?>"></script>
    <script src="<?php echo base_url(ASSET_PATH.'active-sidebar.js');?>"></script>
	<script src="<?php echo base_url(TEMPLATE_COMPONEN_PATH.'bootstrap-daterangepicker/daterangepicker.js')?>"></script>
	
    <script type="text/javascript">
    	AutoNumeric.multiple('.numbering', { modifyValueOnWheel : false });
		$(function () {
			<?php if($this->session->flashdata('message')){ ?>
	            info_alert("<?php echo $this->session->flashdata('message')['pesan'];?>", "<?php echo $this->session->flashdata('message')['tipe'];?>", 2000)
	        <?php } ?>
		    $('.datepicker').datepicker({
		      	autoclose: true,
        		"setDate": new Date(),
		      	format: "dd M yyyy"
		    });
		    
			$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
				checkboxClass: 'icheckbox_minimal-red',
				radioClass   : 'iradio_minimal-red'
			})
			setActive();
			$('[data-toggle="popover"]').popover();
			$('[data-toggle="tooltip"]').tooltip();
		});
		
	    $(".number").keydown(function (e) {
	        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
	            (e.keyCode == 65 && e.ctrlKey === true) ||
	            (e.keyCode == 67 && e.ctrlKey === true) ||
	            (e.keyCode == 88 && e.ctrlKey === true) ||
	            (e.keyCode >= 35 && e.keyCode <= 39)) {
	                 return;
	        }
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }
	    });
	    $(document).on("click", "#btn-del", function () {
	         var id = $(this).data('no');
	         $(".modal-body #remove_ID").val( id );
	         $(".modal-body #hapus-pesan").text("Anda akan menghapus data " + $("#menu-title").text() + " " + id);
	    });

	    function info_alert(pesan, type, delay = 0){
			$("#info").hide();
			$('#text_message').text(pesan);
            $("#info").attr('class', 'alert ' + type);
            if (delay > 0) {
            	$("#info").fadeIn('medium').delay(delay).fadeOut('medium');
            }else{
            	$("#info").fadeIn('medium');
            }
		}
		
		function rupiah(n) {
		    return parseFloat(n).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
		}
	</script>
</body>
</html>