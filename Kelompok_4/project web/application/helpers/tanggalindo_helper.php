<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('bulan'))
{
    function bulan($bln)
    {
        switch ($bln)
        {
            case 1:
            return "Januari";
            break;
            case 2:
            return "Februari";
            break;
            case 3:
            return "Maret";
            break;
            case 4:
            return "April";
            break;
            case 5:
            return "Mei";
            break;
            case 6:
            return "Juni";
            break;
            case 7:
            return "Juli";
            break;
            case 8:
            return "Agustus";
            break;
            case 9:
            return "September";
            break;
            case 10:
            return "Oktober";
            break;
            case 11:
            return "November";
            break;
            case 12:
            return "Desember";
            break;
        }
    }
} if ( ! function_exists('bulann'))
{
    function bulann($bln)
    {
        switch ($bln)
        {
            case 1:
            return "Jan";
            break;
            case 2:
            return "Feb";
            break;
            case 3:
            return "Mar";
            break;
            case 4:
            return "Apr";
            break;
            case 5:
            return "Mei";
            break;
            case 6:
            return "Jun";
            break;
            case 7:
            return "Jul";
            break;
            case 8:
            return "Agu";
            break;
            case 9:
            return "Sep";
            break;
            case 10:
            return "Okt";
            break;
            case 11:
            return "Nov";
            break;
            case 12:
            return "Des";
            break;
        }
    }
}
if ( ! function_exists('poee'))
{
    function poee($day)
    {
        switch ($day)
        {
            case 1:
            return "Senin";
            break;
            case 2:
            return "Selasa";
            break;
            case 3:
            return "Rabu";
            break;
            case 4:
            return "Kamis";
            break;
            case 5:
            return "Jum'at";
            break;
            case 6:
            return "Sabtu";
            break;
            case 7:
            return "Minggu";
            break;
        }
    }
}

//format tanggal yyyy-mm-dd
if ( ! function_exists('tanggal'))
{
    function tanggal($tgl)
    {
        $ubah = gmdate($tgl, time()+60*60*8);
        $pecah = explode("-",$ubah);  //memecah variabel berdasarkan -
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal.' '.$bulan.' '.$tahun; //hasil akhir
    }
}
if ( ! function_exists('bln_hungkul'))
{
    function bln_hungkul($tanggal)
    {
        $bln = substr($tanggal,5,2);
        $bulan = bulann($bln);
        return $bulan; //hasil akhir
    }
}
if ( ! function_exists('tgl_hungkul'))
{
    function tgl_hungkul($tanggal)
    {
        $tgl = substr($tanggal,8,2);
        return $tgl; //hasil akhir
    }
}
if ( ! function_exists('sdate'))
{
    function sdate($tgl)
    {
        $ubah = gmdate($tgl, time()+60*60*8);
        $pecah = explode("-",$ubah);  //memecah variabel berdasarkan -
        $tanggal = $pecah[2];
        $bulan = bulann($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal.' '.$bulan; //hasil akhir
    }
}
if ( ! function_exists('stime'))
{
    function stime($time)
    {
        $t = substr($time,0,5);
        return $t;
    }
}
if ( ! function_exists('poe'))
{
    function poe($day)
    {
        $poe = poee($day);
        return $poe; //hasil akhir
    }
}

//format tanggal timestamp
if( ! function_exists('tgl_indo_timestamp')){

    function tgl_indo_timestamp($tgl)
    {
    $inttime=date('Y-m-d H:i:s',$tgl); //mengubah format menjadi tanggal biasa
    $tglBaru=explode(" ",$inttime); //memecah berdasarkan spaasi

    $tglBaru1=$tglBaru[0]; //mendapatkan variabel format yyyy-mm-dd
    $tglBaru2=$tglBaru[1]; //mendapatkan fotmat hh:ii:ss
    $tglBarua=explode("-",$tglBaru1); //lalu memecah variabel berdasarkan -

    $tgl=$tglBarua[2];
    $bln=$tglBarua[1];
    $thn=$tglBarua[0];

    $bln=bulan($bln); //mengganti bulan angka menjadi text dari fungsi bulan
    $ubahTanggal="$tgl $bln $thn | $tglBaru2 "; //hasil akhir tanggal

    return $ubahTanggal;
}
}

//format tanggal timestamp
if( ! function_exists('convert_tgl')){

    function convert_tgl($tgl)
    {
        return date("Y-m-d", strtotime($tgl));
    }
}
if( ! function_exists('rupiah')){

    function rupiah($angka)
    {
     $jadi="Rp. ".number_format($angka,0,',','.').",-";
     return $jadi;
 }
}

if( ! function_exists('sel_jam')){

    function sel_jam($awal,$akhir)
    {
        $start  = date_create($awal);
    $end    = date_create($akhir); // Current time and date
    $diff   = date_diff( $start, $end );
    // $a = explode(':', $awal);
    // $b = explode(':', $akhir);
    // $jam_start = $a['0'];
    // $menit_start = $a['1'];
    // $jam_end = $b['0'];
    // $menit_end = $b['1'];
    // $hasil = (intVal($jam_end) - intVal($jam_start)) * 60 + (intVal($menit_end) - intVal($menit_start));
    // $hasil = $hasil / 60;
    // $hasil = number_format($hasil,2);
    $jam = $diff->h;
    $men = $diff->i;
    if($jam==0){
        $hasil = $men." Menit";
    }elseif($men==0){
        $hasil = $jam." Jam";
    }elseif($jam==0&&$men==0){
        $hasil = 'Sekejap Mata';
    }else{
        $hasil=$jam." Jam ".$men." Menit";
    }
    return $hasil;
}
}
if( ! function_exists('status_pembayaran')){
    function status_pembayaran($status){
        if($status=='sudah_dibayar'){
            $color = "success";
        }elseif($status=='proses_verifikasi'){
            $color = "warning";
        }else{
            $color = "danger";
        }
        $res = '<span class="badge badge-'.$color.'">'.ucwords(str_replace('_', ' ', $status)).'</span>';
        return $res;
    }
}