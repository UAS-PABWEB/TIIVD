<?php 

	session_start();
	$_SESSION = [];
	session_unset();
	session_destroy();
	
	echo "<script>
			alert('Logout berhasil');
			document.location.href = '../index.php';
		  </script>";

 ?>