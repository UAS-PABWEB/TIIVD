<?php

	$id = $_GET['id'];
	$id_buku = $_GET['judul'];

	// $sql = $koneksi->query("update tb_transaksi set status='kembali' where id = '$id'");
	$sql = $koneksi->query("delete from tb_transaksi where id = '$id'");

	$buku = $koneksi->query("update  tb_buku set jumlah_buku = (jumlah_buku+1) where judul='$id_buku' ");

	if ($sql || $buku) {
		?>

			<script type="text/javascript">
				
				alert("Buku Berhasil Dikembalikan");

				window.location.href="?page=transaksi";

			</script>
		<?php
	}

?>