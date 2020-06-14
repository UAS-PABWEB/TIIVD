<?php 

	include 'functions.php';

	if(isset($_POST['tambah'])) {
		if(tambah($_POST) > 0) {
			echo "
				<script>
					alert('Data berhasil ditambahkan');
					document.location.href = 'index.php?halaman=postingan';
				</script>
			";
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

	</style>
</head>
<body>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Tambah Postingan</h6>
        </div>
		<div class="card-body">
			<div class="container">	
				<form action="" method="post" enctype="multipart/form-data">
					<div class="row">
						<input type="hidden" name="idUser" value="<?= $_SESSION['user']['id'];?>">
						<div class="col-md-6">
							<div class="form-group col-md-12">
								<label for="namaP">Nama Photo</label>
								<input type="text" name="namaP" id="namaP" class="form-control" required>
							</div>
							<!-- <div class="form-group col-md-12">
								<label for="kategori">Kategori</label>
								<input type="text" name="kategori" id="kategori" class="form-control">
							</div> -->
							<div class="form-group col-md-12">
							    <label for="exampleFormControlSelect1">Kategori</label>
							    <select class="form-control" name="kategori" id="exampleFormControlSelect1" required>
							      <option value=""></option>
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
								<textarea class="form-control" name="deskripsi" id="deskripsi" rows="10" required></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Foto</label>
								<input type="file" name="foto" class="form-control" required>
							</div>
						</div>	
					</div>	
					<div class="my-md-4 pt-md-1 border-top"> </div>	
					<div class="form-group right">
						<button type="submit" class="btn btn-info btn-submit mr-2" name="tambah">Simpan</button>
						<a href="index.php?halaman=postingan" class="btn btn-secondary btn-reset"> Batal </a>
					</div>				
				</form>
			</div>
		</div>
	</div>		
</body>
</html>

	

