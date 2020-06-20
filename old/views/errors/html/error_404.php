<!DOCTYPE html>
<html>
<?php
	$CI =& get_instance();
	if( ! isset($CI))
	{
	    $CI = new CI_Controller();
	}
	$CI->load->helper('url');
?>
<head>
  <meta charset="UTF-8">
  <title>Error 404</title>
</head>

<body>
	<div style="position: absolute; left: 50%; top: 50%; margin-left: -285px; margin-top: -260px;" align="center">
		<img src="<?php echo base_url('img/404.png')?>" alt="Page Not Found (404)." ><br>
		<button style="cursor: pointer; border: 1px solid transparent; border-radius: 3px; box-shadow: none; background-color: #3c8dbc; border-color: #367fa9; color: #fff; display: inline-block;" onclick="back()">Kembali Ke Halaman Sebelumnya</button>
	</div>
<script type="text/javascript">
	function back(){
		window.location='<?php echo $_SERVER['HTTP_REFERER'];?>';
	}
</script>
</body>

</html>