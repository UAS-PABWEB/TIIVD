<?php 
	
	include 'user/functions.php';

	$id = $_GET['id'];

	session_start();

	$data = query("SELECT * FROM postingan INNER JOIN users ON postingan.id_user = users.id WHERE id_post = '$id'");


	// query menampilkan data yang related
	$query = mysqli_query($conn, "SELECT * FROM postingan INNER JOIN users ON postingan.id_user = users.id WHERE id_post = '$id'");

	$ambil = mysqli_fetch_assoc($query);
	$idPost = $ambil['id_post'];
	$kategori = $ambil['kategori'];
	$gambar = query("SELECT * FROM postingan WHERE kategori = '$kategori' AND NOT id_post = '$idPost' ORDER BY id_post DESC");


	// query menghitung jumlah data yang ditampilkan
	$query1 = mysqli_query($conn, "SELECT * FROM postingan WHERE kategori = '$kategori' AND NOT id_post = '$idPost' ORDER BY id_post DESC");
	$row = mysqli_num_rows($query1);

 ?>



<head>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 	<meta name="description" content="">
  	<meta name="author" content="">

	<title>INSTAPICT - Share your moment</title>

	<!-- Custom fonts for this template-->
	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@400;800&display=swap" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="index.css">

	<style type="text/css">
		body {
			
		}

		.nav-item {
			margin-left: 20px;
		}

		.navbar {
			z-index: 1;
		}

		.navbar img {
			width: 40px;
		}

		.content {
			margin-top: 80px;
			font-family: 'Catamaran';
		}

		.content .gambar img {
			max-width: 100%; 
			min-width: 420px;
			margin-bottom: 50px;
			transition: .3s;
		}

		.content .gambar img:hover {
			max-width: 100%; 
			min-width: 420px;
			margin-bottom: 50px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.10);
			border-radius: 10px;
		}

		.content .deskripsi .card {
			background-color: white;
			width: 100%;
			margin-bottom: 50px;
			border-radius: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.10);
			padding: 30px;
		}

		.content .deskripsi .namaP {
			font-family: 'Catamaran';
		}

		.content .deskripsi .card h6 {
			color: black;
		}

		.content .deskripsi .card p {
			margin-left: 20px;
			font-size: 16px;
			margin-bottom: 30px;
		}

		.content .deskripsi span {
			float: right;
			margin-top: 10px;
		}
	        
		.content .deskripsi img {
			width: 40px;
			float: right;
			margin-left: 10px;
		}

		.content .deskripsi .tombolD {
			width: 100%;
		}

		.gallery {
			margin-top: 60px;
		}


		.thumbnail img {
	      	max-width: 100%;
	      	height: 400px;
	      	margin-bottom: 30px;
	      	transition: .3s;
	    }

	    .thumbnail img:hover {
	        max-width: 100%;
	        height: 400px;
	        margin-bottom: 30px;
	        filter: brightness(.4);
	    }

	    .nothing {
	    	margin-top: 40px;
	    }

	    .image {
	    	margin-top: 40px;
	    }

	    footer {
	    	margin-top: 100px;
	    }

	    .submitG {
			margin-right: 20px;
		}

		

	</style>

</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="index.php">
		        <div class="navbar-brand-icon rotate-n-10">
		          <i class="fas fa-camera-retro"></i>
		        </div>
		        <td>INSTAPICT</td>
		    </a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
			    	<li class="nav-item active">
			    		<a class="nav-link" href="aboutUs.php">About Us <span class="sr-only">(current)</span></a>
			    	</li>
			    	<li class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          Category
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          	<a class="dropdown-item" href="kategori.php?id=Nature">Nature</a>
				          	<a class="dropdown-item" href="kategori.php?id=People">People</a>
				          	<a class="dropdown-item" href="kategori.php?id=Animal">Animal</a>
				          	<a class="dropdown-item" href="kategori.php?id=Technology">Technology</a>
				          	<a class="dropdown-item" href="kategori.php?id=Travelling">Travelling</a>
				          	<a class="dropdown-item" href="kategori.php?id=Fashion">Fashion</a>
				        </div>
				    </li>
			   	</ul>
			   	<?php if (isset($_SESSION['user'])): ?>
			   		<a href="user/index.php?halaman=tambahPost" class="btn btn-outline-success my-2 my-sm-0 submitG" role="button">Submit Photo</a>
			   		<div class="nav-item dropdown no-arrow">
			   			<a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Halo, <?= $_SESSION['user']['username']; ?></span>
	                        <img class="img-profile rounded-circle" src="user/Foto Profile/<?= $_SESSION['user']['image']; ?>">
	                    </a>
			   			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						    <a class="dropdown-item" href="user/index.php">Dashboard</a>
						</div>
			   		</div>
			   		
			   		<a href="user/logout.php" class="btn btn-danger my-2 my-sm-0" role="button">Logout</a>
			   	<?php else : ?>
			   		<a href="user/index.php?halaman=tambahPost" class="btn btn-outline-success my-2 my-sm-0 submitG" role="button">Submit Photo</a>
			   		<a href="user/login.php" class="btn btn-success my-2 my-sm-0" role="button">Login</a><span style="margin: 0 5px;">|</span>
			   		<a href="user/register.php" class="btn btn-warning my-2 my-sm-0" role="button">Register</a>
			   	<?php endif ?>			   	
			</div>
		</div>	
	</nav>

	<section class="content">
		<?php foreach ($data as $dat) : ?>
			<div class="container">
				<div class="row">
					<div class="gambar col-xs-2 col-sm-12 col-md-6 col-lg-7  text-center">
						<img src="user/Photo/<?= $dat['gambar'];?>">
					</div>
					<div class="deskripsi col-xs-10 col-sm-12 col-md-6 col-lg-5">				
						<div class="card">
							<div class="row">
								<div class="col-sm-2 col-lg-2 imageP" style="margin: auto; float: left;">
									<img class="img-profile rounded-circle" src="user/Foto Profile/<?= $dat['image'];?>">
								</div>
								<div class="col-sm-10 col-lg-10 namaP" style="margin: auto; float: left;">
									<div class="row">
										<a href="galleryUser.php?id=<?= $dat['id']; ?>">
											<span class="text-black-600 large" style="color: black; font-weight: bold;"><?= $dat['nama_lengkap']; ?></span>
										</a>						
									</div>
									<div class="row">
										<a href="galleryUser.php?id=<?= $dat['id']; ?>">
											<span class="text-black-600 small" style="color: black;">@<?= $dat['username']; ?></span>
										</a>
									</div>
								</div>				
							</div>

							<hr>

							<div class="row">
								<div class="col-md-6 col-sm-6">
									<h6>NAMA FOTO :</h6>
									<p><?= $dat['nama_foto']; ?></p>
									<h6>KATEGORI :</h6>
									<p><?= $dat['kategori']; ?></p>
								</div>
								<div class="col-md-6 col-sm-6">
									<h6>POST BY :</h6>
									<p>@<?= $dat['username']; ?></p>
									<h6>DATE POST :</h6>
									<p><?= date('d-F-Y', $dat['date_post']); ?></p>
								</div>								
							</div>	
							<div class="row">
								<div class="col-md-12">
									<h6>DESKRIPSI :</h6>
									<p><?= $dat['deskripsi']; ?></p>
									<br>
									<a class="btn btn-success tombolD" href="user/Photo/<?= $dat['gambar'];?>" download><i class="fas fa-download"></i> DOWNLOAD</a>
								</div>
							</div>		
						</div>				
					</div>
				</div>			
			</div>
		<?php endforeach; ?>
	</section>

	<hr>

	<section class="gallery" id="portfolio">
      <div class="container">
      	<div class="row">
      		<div class="col-sm-12 title">
      			<h2 class="text-black">RELATED IMAGE</h2>
      		</div>	    		
      	</div>
      	<?php if ($row < 1): ?>
      		<div class="row nothing">
      			<p>Tidak ada gambar yang sejenis</p>
      		</div>
      	<?php else : ?>
      		<div class="row image">
	          	<?php $i = 1; ?>
	            <?php foreach($gambar as $gbr): ?>
	              <tr>
	                <div class="gambar col-sm-12 col-md-6 col-lg-4 text-center">
	                  <a href="detailGambar.php?id=<?= $gbr['id_post']?>" class="thumbnail">
	                    <img src="user/Photo/<?php echo $gbr["gambar"]; ?>">
	                  </a>              
	                </div>
	              </tr>
	            <?php $i++; ?>
	            <?php endforeach; ?>
	        </div>
      	<?php endif ?>
        
      </div>
    </section>


	<!-- Footer -->
      <footer class="sticky-footer bg-light">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Kelompok12 <?= date('Y'); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->



	<!-- Bootstrap core JavaScript-->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="assets/js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="assets/vendor/chart.js/Chart.min.js"></script>

	<!-- Page level custom scripts -->
	<script src="assets/js/demo/chart-area-demo.js"></script>
	<script src="assets/js/demo/chart-pie-demo.js"></script>

</body>
</html>