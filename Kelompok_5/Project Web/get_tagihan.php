<?php
include 'config.php';
if(!empty($_POST)){
	if(isset($_POST['id_anggota'])){
		$id_anggota = $_POST['id_anggota'];
		$q = mysqli_query($conn,"SELECT * FROM pinjaman WHERE id_anggota='$id_anggota'");
			echo'<option value="">Pilih Kode Pinjam</option>';
		while($r=mysqli_fetch_array($q)){
			echo'<option value="'.$r['kd_pinjaman'].'">'.$r['kd_pinjaman'].'</option>';
		}
	}
	if(isset($_POST['kd_pinjaman'])){
		$kd_pinjaman = $_POST['kd_pinjaman'];
		$q = mysqli_query($conn,"SELECT * FROM pinjaman WHERE kd_pinjaman='$kd_pinjaman'");
		$d = mysqli_fetch_array($q);
		$qq = mysqli_query($conn,"SELECT SUM(bayar) as jml_bayar FROM bayar WHERE kd_pinjaman='$kd_pinjaman'");
		$dd = mysqli_fetch_array($qq);
		$sudah_bayar = $dd['jml_bayar'];
		$jml_pinjam = $d['jumlah'];
		$sisa = $jml_pinjam-$sudah_bayar;
		$bunga = ($sisa*3)/100;
		$data = array('jml_pinjam'=>$jml_pinjam,'sisa'=>$sisa,'bunga'=>round($bunga));
		echo json_encode($data);
	}
}