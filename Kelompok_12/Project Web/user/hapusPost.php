<?php 

	include 'functions.php';

	$id = $_GET['id'];

	$ambil = mysqli_query($conn, "SELECT * FROM postingan WHERE id_post='$id'");
	$pecah = mysqli_fetch_assoc($ambil);
	$gambar = $pecah['gambar'];

	if(file_exists("Photo/$gambar")) {
		unlink("Photo/$gambar");
	}

	if(delete($id) > 0) {
		echo "
			<script>
				alert('Postingan berhasil dihapus');
				document.location.href = 'index.php?halaman=postingan';
			</script>
		";
	}else {
		echo "
			<script>
				alert('Postingan gagal dihapus');
				document.location.href = 'index.php?halaman=postingan';
			</script>
		";
	}
	


?>