<?php 

	if(!isset($_SESSION["login"]) && !isset($_SESSION["user"])) {
		echo "<script>
				alert('Anda harus login terlebih dahulu!!');
				document.location.href = 'login.php';
			  </script>";
		// header("Location: login.php");
		// exit;
	}
	
	include 'functions.php';

	$id = $_SESSION['user']['id'];
	$postingan = query("SELECT * FROM postingan WHERE id_user = '$id'");

	$query = mysqli_query($conn, "SELECT * FROM postingan WHERE id_user = '$id'");
	$jumlah = mysqli_num_rows($query);



 ?>



 <style type="text/css">
	tbody img {
		width: 100px;
		height: 100px;
	}

	.card {
		min-height: 500px;
	}

	table {
		margin-top: 25px;
	}

	.card-body .buttonTambah {
		margin-bottom: 20px;
	}
</style>

<!-- Page Heading -->


	<h1 class="h3 mb-2 text-gray-800">Postingan Saya</h1>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Tabel Data Postingan</h6>
        </div>
		<div class="card-body">
	<!-- 		<?php print_r($jumlah); ?>
	 -->
			<?php if ($jumlah<1): ?>
				<div class="container">
				  <div class="row">
				    <div class="col-sm-4"></div>
				    <div class="col-sm-4 text-center">
				      	<img src="../assets/img/icon/icons camera.png" style="margin-top: 50%;"><br>
				      	<span style="color: #C2C2C2;">Belum ada postingan</span><br><br>
				      	<a href="index.php?halaman=tambahPost" class="btn btn-primary btn-icon-split btn-sm buttonTambah">
		                    <span class="icon text-white-50">
		                      <i class="fas fa-plus"></i>
		                    </span>
		                    <span class="text">Tambah Postingan</span>
		                </a>
				    </div>
				    <div class="col-sm-4"></div>
				  </div>
				</div>
			<?php else : ?>
				<a href="index.php?halaman=tambahPost" class="btn btn-primary btn-icon-split buttonTambah">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Postingan</span>
                </a>
				<div class="table-responsive">
					<table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
						<thead class="table text-center">
							<tr>
								<th>No</th>
								<th>Photo</th>
								<th>Nama foto</th>
								<th>Kategori</th>
								<th>Deskripsi</th>
								<th>Tanggal Post</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tfoot>
		                    <tr>
		                      	<th>No</th>
		                      	<th>Photo</th>
		                      	<th>Nama foto</th>
		                      	<th>Kategori</th>
		                      	<th>Deskripsi</th>
		                      	<th>Tanggal Post</th>
		                      	<th>Aksi</th>
		                    </tr>
		                </tfoot>
						<tbody>
							<?php $i=1; ?>
							<?php foreach($postingan as $pos): ?>
								<tr>
									<td style="font-weight: bold;"><?= $i; ?></td>
									<td><img src="Photo/<?= $pos['gambar']?>"></td>
									<td><?= $pos['nama_foto']; ?></td>
									<td><?= $pos['kategori']; ?></td>
									<td><?= $pos['deskripsi']; ?></td>
									<td><?= date('d-F-Y', $pos['date_post']); ?></td>
									<td>
										<a href="index.php?halaman=ubahPost&id=<?= $pos['id_post']; ?>" class="btn btn-warning btn-circle"><i class="fas fa-pen"></i></a> | <a href="hapusPost.php?id=<?= $pos['id_post']; ?>" class="btn btn-danger btn-circle" onclick="return confirm('Apakah anda yakin ingin menghapus ?')"><i class="fas fa-trash"></i></a>
									</td>
								</tr>
							<?php $i++; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>	
			<?php endif ?>
			
		</div>

	</div>
