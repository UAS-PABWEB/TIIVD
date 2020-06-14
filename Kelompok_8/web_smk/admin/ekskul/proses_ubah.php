<?php 

if(!isset($_GET['id']) || $_GET['id'] == '') header('Location: index.php');

require_once '../../koneksi.php';
$id = $_GET['id'];
$nama_ekskul = mysqli_real_escape_string($koneksi, $_POST['nama_ekskul']);
$pembina = mysqli_real_escape_string($koneksi, $_POST['pembina']);
$query = mysqli_query($koneksi, "UPDATE tbl_ekskul SET nama_ekskul = '$nama_ekskul', pembina = '$pembina' WHERE id = $id");
if($query){
	$_SESSION['sukses'] = 'Data Berhasil Diubah!';
	header('Location: index.php');
} else {
	$_SESSION['gagal'] = 'Data Gagal Diubah!';
	header('Location: index.php');
}

?>