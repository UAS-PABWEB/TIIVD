<?php 
	
	session_start();

	include 'functions.php';

	$id = $_GET['id'];

	$ambil = mysqli_query($conn, "SELECT * FROM users INNER JOIN postingan ON users.id = postingan.id_user WHERE id = '$id'");

	$ambilD = query("SELECT * FROM users INNER JOIN postingan ON users.id = postingan.id_user WHERE id = '$id'");

	$pecah = mysqli_fetch_all($ambil, MYSQLI_ASSOC);

  
  	$image = $ambilD[0]['image'];



	if(deleteAkun($id) > 0) {
		if (file_exists("Foto Profile/$image")) {
			foreach ($ambilD as $amb) {
				if(file_exists("Photo/$amb['gambar']")) {
					unlink("Photo/$amb['gambar']");
				}
			}
			unlink("Foto Profile/$amb['gambar']");
		}

		$_SESSION = [];
		session_unset();
		session_destroy();

		echo "
			<script>
				alert('Akun berhasil dihapus');
				document.location.href = '../index.php';
			</script>
		";
		
	}else {
		echo "
			<script>
				alert('Akun gagal dihapus');
				document.location.href = 'index.php?halaman=profile';
			</script>
		";
	}
	
?>


