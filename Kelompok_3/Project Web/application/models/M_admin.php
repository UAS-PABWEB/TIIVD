<?php
class M_admin extends CI_Model{
	public function eDB($tabel){
       $this->load->dbutil();
       $prefs = array(
           'tables'        => array($tabel),
           'format'        => 'zip',
           'filename'      => $tabel.'.sql'       
       );
       $r = rand(10,100);
       if($this->db->table_exists($tabel)){
           $backup = $this->dbutil->backup($prefs);
           $this->load->helper('file');
           write_file('backup_db/backup_'.$tabel.'_'.$r.'.zip', $backup);
           $this->load->helper('download');
           return force_download('backup_'.$tabel.'_'.$r.'.zip', $backup);
       }else{
          echo "Tabel <b>$tabel</b> tidak ditemukan";
          return;
      }
  }
  public function eCSV($tabel){
   if($this->db->table_exists($tabel)){
      $this->load->dbutil();
      $this->load->helper('file');
      $this->load->helper('download');
      $delimiter = ",";
      $newline = "\r\n";
      $filename = "$tabel.csv";
      $enclosure = '"';
      $query = "SELECT * FROM $tabel";
      $result = $this->db->query($query);
      $data = $this->dbutil->csv_from_result($result, $delimiter, $newline, $enclosure);
      return force_download($filename, $data);
  }else{
      echo"gagal";
      return;
  }
}
public function emDB($table){
  return $this->db->truncate($table);
}
public function gTransportation(){
  $this->db->join('transportation_class','transportation_class.id_transportation_class=transportation.id_transportation_class');
  $this->db->join('transportation_type','transportation_type.id_transportation_type=transportation.id_transportation_type');
  $this->db->join('transportation_company','transportation_company.id_transportation_company=transportation.id_transportation_company');
  $query = $this->db->get('transportation');
  return $query->result();
}
public function gTransportationC(){
    $this->db->join('transportation_type','transportation_type.id_transportation_type=transportation_class.id_transportation_type');
    $query = $this->db->get('transportation_class');
    return $query->result();
}
public function gTransportationCo(){
    $this->db->join('transportation_type','transportation_type.id_transportation_type=transportation_company.id_transportation_type');
    $query = $this->db->get('transportation_company');
    return $query->result();
}
public function gPlace(){
    $this->db->join('city','city.id_city = place.id_city');
    $this->db->join('transportation_type','transportation_type.id_transportation_type = place.id_transportation_type');
    $query = $this->db->get('place');
    return $query->result();
}
public function gRute(){
    $this->db->join('transportation','transportation.id_transportation = rute.id_transportation');
    $this->db->join('transportation_type','transportation_type.id_transportation_type = rute.id_transportation_type');
    $query = $this->db->get('rute');
    return $query->result();
}
}