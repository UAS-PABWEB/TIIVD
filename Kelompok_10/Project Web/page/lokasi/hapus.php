<?php
	
	$id_lokasi = $_GET ['id_lokasi'];

	$koneksi->query("delete from tb_lokasi where id_lokasi ='$id_lokasi'");

?>


<script type="text/javascript">
		window.location.href="?page=lokasi";
</script>