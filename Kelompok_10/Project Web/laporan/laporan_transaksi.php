<?php
error_reporting(0);
$koneksi = new mysqli("localhost","root","","db_perpustakaan");
$content ='

<style type="text/css">
	
	.tabel{border-collapse: collapse;}
	.tabel th{padding: 8px 5px;  background-color:  #cccccc;  }
	.tabel td{padding: 8px 5px;     }
</style>


';


 $content .= '
<page>
<h1>Laporan Data Transaksi</h1>
<br>
<table border="1px" class="tabel"  >
<tr>
<th>No </th>
<th>Judul</th>
<th>NIS</th>
<th>Nama</th>
<th>Tanggal Pinjam</th>
<th>Tanggal Kembali</th>
<th>Status</th>

</tr>';

if (isset($_POST['cetak'])) {


	
	$tgl1 = $_POST['tanggal1'];
	$tgl2 = $_POST['tanggal2'];

	
		
	$no = 1;
	$sql = $koneksi->query("select * from tb_transaksi where tgl_input between '$tgl1' and '$tgl2' ");
	while ($tampil=$sql->fetch_assoc()) {
		$judulbuku = $koneksi->query('SELECT judul FROM tb_buku WHERE id_buku=$tampil->judul');
		$content .='
			<tr>
				<td align="center">'.$no++.'</td>
				<td align="center">'.$tampil['judul'].'</td>
				<td align="center">'.$tampil['nis'].'</td>
				<td align="center">'.$tampil['nama'].'</td>
				<td align="center">'.$tampil['tgl_pinjam'].'</td>
				<td align="center">'.$tampil['tgl_kembali'].'</td>
				<td align="center">'.$tampil['status'].'</td>
			</tr>
		';
	
}
}else{

$no=1;

$sql = $koneksi->query("select * from tb_transaksi");
while ($tampil=$sql->fetch_assoc()) {
	$content .='
		<tr>
			<td align="center">'.$no++.'</td>
			<td align="center">'.$tampil['judul'].'</td>
			<td align="center">'.$tampil['nis'].'</td>
			<td align="center">'.$tampil['nama'].'</td>
			<td align="center">'.$tampil['tgl_pinjam'].'</td>
			<td align="center">'.$tampil['tgl_kembali'].'</td>
			<td align="center">'.$tampil['status'].'</td>
		</tr>
	';
}
}

$content .='


</table>
</page>';

require_once('../assets/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('exemple.pdf');
?>
