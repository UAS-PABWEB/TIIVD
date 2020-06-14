<?php 

	$conn = mysqli_connect("localhost", "root", "", "instapict");

	function query($query) {
		global $conn;
		$result = mysqli_query($conn, $query);
		$rows = [];
		while( $row = mysqli_fetch_assoc($result) ) {
			$rows[] = $row;
		}
		return $rows;
	}


	function tambah($data) {
		global $conn;

		$idUser = $data['idUser'];
		$namaP = htmlspecialchars($data['namaP']);
		$kategori = htmlspecialchars(trim($data['kategori']));
		$deskripsi = htmlspecialchars($data['deskripsi']);
		$foto = upload();
		$dateP = time();

		$query = "INSERT INTO postingan (id_user, nama_foto, kategori, deskripsi, gambar, date_post)
						VALUES
				 ('$idUser', '$namaP', '$kategori', '$deskripsi', '$foto', '$dateP')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function upload() {
		$namaFile = $_FILES['foto']['name'];
		$lokasi = $_FILES['foto']['tmp_name'];
		move_uploaded_file($lokasi, 'Photo/' . $namaFile);

		return $namaFile;
	}

	function delete($id) {
		global $conn;

		$query = "DELETE FROM postingan WHERE id_post=$id";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	function deleteAkun($id) {
		global $conn;

		$query = "DELETE FROM users INNER JOIN postingan ON users.id = postingan.id_user WHERE id = '$id'";
		
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	function registrasi($data) {
		global $conn;

		$email = htmlspecialchars($data["email"]);
		$namaL = htmlspecialchars($data['namaL']);
		$username = strtolower(stripcslashes($data["username"]));
		$password = mysqli_real_escape_string($conn, $data["password"]);
		$confirmP = mysqli_real_escape_string($conn, $data["confirmP"]);
		$dateCr = time();

		$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

		if(mysqli_fetch_assoc($result)) {
			echo "<script>
					alert('username sudah terdaftar!');
				  </script>";
			return false;
		}

		if($email == '' || $username == '' || $password == '' || $confirmP == '') {
			echo "<script>
					alert('Form harus diisi semuanya!!');
				  </script>";
			return false;
		} 

		if($password !== $confirmP) {
			echo "<script>
					alert('konfirmasi password tidak sesuai!');
				 </script>";
			return false;
		}

		$query = "INSERT INTO users (nama_lengkap, username, email, password, date_created)
					VALUES
				('$namaL', '$username', '$email', '$password', '$dateCr') 
				";

		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}


	function cari($keyword) {
		$query = "SELECT * FROM postingan
						WHERE
				 nama_foto LIKE '%$keyword%' OR
				 kategori LIKE '%$keyword%'
				ORDER BY id_post DESC";
		return query($query);
	}


	// function edit($data) {
	// 	global $conn;
	// 	$namaFoto = $_FILES['foto']['name'];
	// 	$lokasiFoto = $_FILES['foto']['tmp_name'];

	// 	if(!empty($lokasiFoto)) {
	// 		global $conn, $namaFoto, $lokasiFoto;
	// 		move_uploaded_file($lokasiFoto, "../foto produk/".$namaFoto);

	// 		$id = $data['id'];
	// 		$namaProduk = htmlspecialchars($data['nama']);
	// 		$hargaProduk = htmlspecialchars($data['harga']);
	// 		$berat = htmlspecialchars($data['berat']);
	// 		$deskripsi = htmlspecialchars($data['deskripsi']);

	// 		$query = "UPDATE produk SET
	// 					nama_produk = '$namaProduk',
	// 					harga_produk = '$hargaProduk',
	// 					berat = '$berat',
	// 					foto_produk = '$namaFoto',
	// 					deskripsi_produk = '$deskripsi'

	// 				  WHERE id_produk = $id;
	// 				 ";
	// 		mysqli_query($conn, $query);
	// 		return mysqli_affected_rows($conn);
	// 	}else {
	// 		global $conn;
	// 			$id = $data['id'];
	// 			$namaProduk = htmlspecialchars($data['nama']);
	// 			$hargaProduk = htmlspecialchars($data['harga']);
	// 			$berat = htmlspecialchars($data['berat']);
	// 			$deskripsi = htmlspecialchars($data['deskripsi']);

	// 			$query = "UPDATE produk SET
	// 						nama_produk = '$namaProduk',
	// 						harga_produk = '$hargaProduk',
	// 						berat = '$berat',
	// 						deskripsi_produk = '$deskripsi'

	// 					  WHERE id_produk = $id;
	// 					 ";
	// 			mysqli_query($conn, $query);
	// 			return mysqli_affected_rows($conn);
	// 	}
	// }


?>