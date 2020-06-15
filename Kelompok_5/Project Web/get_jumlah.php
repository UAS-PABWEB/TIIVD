<?php
include 'config.php';
if(!empty($_POST)){
	$id_anggota = $_POST['id_anggota'];
	$jenis = $_POST['jenis'];
	if($jenis!=='ambil'&&$jenis!=='sukarela'){
		$q = mysqli_query($conn,"SELECT SUM(jml_simpan) as jml FROM simpanan WHERE id_anggota='$id_anggota' AND jenis_simpan='$jenis'");
		$d = mysqli_fetch_array($q);
		$jml =  mysqli_num_rows($q);
		if(empty($d['jml'])){
			echo 0;
		}else{
			echo $d['jml'];
		}
	}else{
		$q = mysqli_query($conn,"SELECT SUM(jml_simpan) as jml FROM simpanan WHERE id_anggota='$id_anggota' AND jenis_simpan='ambil'");
		$d = mysqli_fetch_array($q);
		$qq = mysqli_query($conn,"SELECT SUM(jml_simpan) as jml FROM simpanan WHERE id_anggota='$id_anggota' AND jenis_simpan='sukarela'");
		$dd = mysqli_fetch_array($qq);
		$a = $d['jml'];
		$b = $dd['jml'];
		if(empty($a) && empty($b)){
			echo 0;
		}else{
			echo $b-$a;
		}

	}
}