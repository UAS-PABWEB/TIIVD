<?php 
	
	include 'user/functions.php';

	session_start();

	$query = mysqli_query($conn, "SELECT * FROM postingan");
	$jumlahDatabase = mysqli_num_rows($query);

  	if(isset($_POST["cari"])) {
    	$gambar = cari($_POST["keyword"]);
    	$jumlahData = count(cari($_POST["keyword"]));
  	}else {
  		$gambar = query("SELECT * FROM postingan ORDER BY id_post DESC");
  		$jumlahG = mysqli_query($conn, "SELECT * FROM postingan ORDER BY id_post DESC");
  		$jumlahData = mysqli_num_rows($jumlahG);
  	}



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

	<!-- Custom styles for this template-->
	<link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Catamaran:wght@400;800&family=Open+Sans+Condensed:wght@300&family=Teko:wght@600&display=swap" rel="stylesheet">

	<style type="text/css">

		body {
			margin-bottom: 0;
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

		.submitG {
			margin-right: 20px;
		}

		.jumbotron {
			background-image: url("https://images.unsplash.com/photo-1499343245400-cddc78a01317?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60");
			background-repeat: no-repeat;
			background-size: cover;
			height: 550px;
			max-height: 550px;
			color: #DDDDDD;
		}

		.jumbotron .title {
			margin-top: 20px;
		}

		.jumbotron .description {
			margin-bottom: 100px;
		}

		.jumbotron input {
			margin: auto;
			width: 100%;
			text-align: left;
			padding: 15px;
			float: left;
			font-size: 14px;
		}

		.jumbotron button {
			float: left;
			height: 35px;
		}

		.form-group {
			margin-top: 20px;
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

	    .image {
	    	margin-top: 40px;
	    }

	    footer {
	    	margin-top: 500px;
	    }

	</style>

</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="index.php">
		        <div class="navbar-brand-icon rotate-n-15">
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
			   		<a href="user/index.php?halaman=tambahPost" class="btn btn-outline-success my-2 my-sm-0" role="button">Submit Photo</a>
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
			   		<a href="user/index.php?halaman=tambahPost" class="btn btn-outline-success my-2 my-sm-0" role="button" style="margin-right: 20px;">Submit Photo</a>
			   		<a href="user/login.php" class="btn btn-success my-2 my-sm-0" role="button">Login</a><span style="margin: 0 5px;">|</span>
			   		<a href="user/register.php" class="btn btn-warning my-2 my-sm-0" role="button">Register</a>
			   	<?php endif ?>			   	
			</div>
		</div>	
	</nav>


	<div class="jumbotron"">
		<div class="container title">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="display-4">Share Your Moment</h1>
				</div>				
			</div>
			<div class="row description">
				<div class="col-lg-12">
					<p class="lead">Bagikan hasil potretan anda dimanapun dan kapanpun.</p>
				</div>			
			</div>	  	
		  		<div class="form-group">
			  		<form action="" method="post">
			  			<div class="row">
				  			<div class="col-lg-4 col-md-8 col-sm-11">
				  				<input type="text" class="form-control" name="keyword" placeholder="Input keyword pencarian !">
				  			</div>
					  		<div class="col-lg-8 col-md-4 col-sm-1">
					  			<button class="btn btn-primary btn-sm" type="submit" name="cari"><i class="fas fa-search"></i></button>
					  		</div>
					  	</div>		  				  			
			  		</form>
			  	</div>
		  	<div class="row">
		  		<div class="col-lg-12">
		  			<p style="font-size: 14px;">Example keyword : animal, fashion, teknologi</p>
		  		</div>		  		
		  	</div>	  		  	
		</div>	
	</div>

	<hr>

	<section class="gallery" id="portfolio">
      <div class="container">
      	<div class="row">
      		<div class="col-sm-12 title">
      			<h2 class="text-black">FEATURED IMAGE</h2>
      		</div>	    		
      	</div>
      	<?php if ($jumlahDatabase < 1): ?>
      		<div class="col">
	      		<p>Tidak ada postingan</p>
	      	</div>      
      	<?php else: ?>
      		<?php if ($jumlahData < 1): ?>
	      		<div class="row">
	      			<div class="col">
	      				<p>Pencarian tidak ditemukan</p>
	      			</div>      			
	      		</div>
	      	<?php else: ?>
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