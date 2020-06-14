<?php 

	include 'functions.php';

	$id = $_GET['id'];
	$data = query("SELECT * FROM postingan WHERE id_post=$id")[0];

	if(isset($_POST['ubah'])) {
		$namaFile = $_FILES['foto']['name'];
		$lokasi = $_FILES['foto']['tmp_name'];
		
		if(!empty($lokasi)) {
			function edit($data) {
				global $conn, $namaFile, $lokasi;
				move_uploaded_file($lokasi, "Photo/".$namaFile);

				$id = $data['id'];
				$namaP = htmlspecialchars($data['namaP']);
				$kategori = htmlspecialchars(trim($data['kategori']));
				$deskripsi = htmlspecialchars($data['deskripsi']);

				$query = "UPDATE postingan SET
							nama_foto = '$namaP',
							kategori = '$kategori',
							gambar = '$namaFile',
							deskripsi = '$deskripsi'

						  WHERE id_post = $id;
						 ";
				mysqli_query($conn, $query);
				return mysqli_affected_rows($conn);
			}
			
			if(edit($_POST)>0) {
				echo "<script>
					alert('Postingan berhasil diubah');
					document.location.href = 'index.php?halaman=postingan';
				  </script>";
			}else {
				echo "<script>
					alert('Postingan gagal diubah');
					document.location.href = 'index.php?halaman=postingan';
				  </script>";
			}
			

		}else {
			function edit($data) {
				global $conn;
				$id = $data['id'];
				$namaP = htmlspecialchars($data['namaP']);
				$kategori = htmlspecialchars(trim($data['kategori']));
				$deskripsi = htmlspecialchars($data['deskripsi']);

				$query = "UPDATE postingan SET
							nama_foto = '$namaP',
							kategori = '$kategori',
							deskripsi = '$deskripsi'

						  WHERE id_post = $id;
						 ";
				mysqli_query($conn, $query);
				return mysqli_affected_rows($conn);
			}
			

			if(edit($_POST)>0) {
				echo "<script>
					alert('Postingan berhasil diubah');
					document.location.href = 'index.php?halaman=postingan';
				  </script>";
			}else {
				echo "<script>
					alert('Postingan gagal diubah');
					document.location.href = 'index.php?halaman=postingan';
				  </script>";
			}
		}
	}


 ?>


<html>
<head>
	<title></title>
	<style type="text/css">
		.right {
			text-align: right;
		}

		.foto-preview {
			padding: .25rem;
			background-color: #fff;
			border: 1px solid #dee2e6;
			border-radius: .25rem;
			width: 12rem;
			height: 16rem;
		}
	</style>
</head>
<body>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Edit Postingan</h6>
        </div>
		<div class="card-body">
			<div class="container">	
					<form action="" method="post" enctype="multipart/form-data">
						<div class="row">
							<input type="hidden" name="id" value="<?= $data["id_post"]; ?>">
							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="namaP">Nama Photo</label>
									<input type="text" name="namaP" id="namaP" class="form-control" value="<?= $data['nama_foto'];?>" required>
								</div>
								<div class="form-group col-md-12">
								    <label for="exampleFormControlSelect1">Kategori</label>
								    <select class="form-control" name="kategori" id="exampleFormControlSelect1" required>
								      <option value="<?= $data['kategori']; ?>"><?= $data['kategori']; ?></option>
								      <option value="Nature">Nature</option>
								      <option value="People">People</option>
								      <option value="Animal">Animal</option>
								      <option value="Technology">Technology</option>
								      <option value="Travelling">Travelling</option>
								      <option value="Fashion">Fashion</option>
								    </select>
								</div>
								<div class="form-group col-md-12">
									<label for="deskripsi">Deskripsi</label>
									<textarea class="form-control" name="deskripsi" id="deskripsi" rows="10" required><?= $data['deskripsi'];?></textarea>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group col-md-12">
									<label for="foto">Foto Postingan Sebelumnya</label><br>
									<img src="Photo/<?= $data['gambar']; ?>" style="max-width: 200px; max-height: 200px;">
								</div>						
								<div class="form-group col-md-12">
									<label>Ubah Foto</label>
									<input type="file" name="foto" class="form-control">
								</div>
							</div>											
						</div>
						<div class="my-md-4 pt-md-1 border-top"> </div>	
						<div class="form-group right">
							<button type="submit" class="btn btn-info btn-submit mr-2" name="ubah">Simpan</button>
							<a href="index.php?halaman=postingan" class="btn btn-secondary btn-reset"> Batal </a>
						</div>		
					</form>
			</div>		
		</div>	
	</div>		
</body>
</html>


	

