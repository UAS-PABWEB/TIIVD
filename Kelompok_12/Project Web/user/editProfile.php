<?php 

	include 'functions.php';

	$id = $_GET['id'];
	$data = query("SELECT * FROM users WHERE id=$id")[0];

	if(isset($_POST['ubah'])) {
		$namaFile = $_FILES['foto']['name'];
		$lokasi = $_FILES['foto']['tmp_name'];
		
		if(!empty($lokasi)) {
			function edit($data) {
				global $conn, $namaFile, $lokasi;
				move_uploaded_file($lokasi, "Foto Profile/".$namaFile);

				$id = $data['id'];
				$namaL = htmlspecialchars($data['namaL']);
				$username = htmlspecialchars($data['username']);
				$email = htmlspecialchars($data['email']);
				$password = htmlspecialchars($data['password']);

				$query = "UPDATE users SET
							nama_lengkap = '$namaL',
							username = '$username',
							email = '$email',
							image = '$namaFile',
							password = '$password'

						  WHERE id = $id;
						 ";
				mysqli_query($conn, $query);
				return mysqli_affected_rows($conn);
			}
			
			if(edit($_POST)>0) {
				echo "<script>
						alert('Profile berhasil diubah');
						document.location.href = 'index.php?halaman=profile';
					  </script>";
			}else {
				echo "<script>
						alert('Profile gagal diubah');
						document.location.href = 'index.php?halaman=profile';
					  </script>";
			}
			

		}else {
			function edit($data) {
				global $conn;
				$id = $data['id'];
				$namaL = htmlspecialchars($data['namaL']);
				$username = htmlspecialchars($data['username']);
				$email = htmlspecialchars($data['email']);
				$password = htmlspecialchars($data['password']);

				$query = "UPDATE users SET
							nama_lengkap = '$namaL',
							username = '$username',
							email = '$email',
							password = '$password'

						  WHERE id = $id;
						 ";
				mysqli_query($conn, $query);
				return mysqli_affected_rows($conn);
			}
			

			if(edit($_POST)>0) {
				echo "<script>
					alert('Profile berhasil diubah');
					document.location.href = 'index.php?halaman=profile';
				  </script>";
			}else {
				echo "<script>
					alert('Profile gagal diubah');
					document.location.href = 'index.php?halaman=profile';
				  </script>";
			}
		}
	}


 ?>

 <html>
 <head>
 	<title></title>

 	<style type="text/css">
 		.foto-preview {
			padding: .25rem;
			background-color: #fff;
			border: 1px solid #dee2e6;
			border-radius: .25rem;
			width: 16rem;
			height: 16rem;
			margin-bottom: 20px;
		}

		.right {
			text-align: right;
		}
 	</style>
 </head>
 <body>

 	<div class="card shadow mb-4">
		<div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
        </div>
		<div class="card-body">
			<div class="container">
				<div class="row">
					<form action="" method="post" enctype="multipart/form-data" novalidate>
						<div class="row">
							<input type="hidden" name="id" value="<?= $data["id"]; ?>">
							<div class="col">
								<div class="form-group col-md-12">
									<label for="namaL">Nama Lengkap</label>
									<input type="text" name="namaL" id="namaL" class="form-control" value="<?= $data['nama_lengkap'];?>">
								</div>

								<div class="form-group col-md-12">
									<label for="username">Username</label>
									<input type="text" name="username" id="username" class="form-control" value="<?= $data['username'];?>">			
								</div>
							</div>

							<div class="col">
								<div class="form-group col-md-12">
									<label for="email">Email</label>
									<input type="text" name="email" id="email" class="form-control" value="<?= $data['email'];?>">
								</div>
								<div class="form-group col-md-12">
									<label for="password">Password</label>
									<input type="text" class="form-control" name="password" id="password" value="<?= $data['password'];?>">
								</div>			
							</div>

							<div class="col">
								<div class="form-group col-md-12">
									<label>Foto Profile Sebelumnya</label>
									<img class="foto-preview" src="Foto Profile/<?= $data['image']; ?>">
									<label>Ubah Foto Profile</label>
									<input type="file" class="form-control-file mb-3" name="foto">							
								</div>
							</div>
						</div>

						<div class="my-md-4 pt-md-1 border-top"> </div>
						<div class="form-group col-md-12 right">
							<button type="submit" class="btn btn-info btn-submit mr-2" name="ubah">Simpan</button>
							<a href="index.php" class="btn btn-secondary btn-reset"> Batal </a>
						</div>
					</form>
			 				
			 	</div>
			</div>		 	
		</div>
	</div>

 
 </body>
 </html>

