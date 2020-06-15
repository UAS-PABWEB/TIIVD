<?php
$server = "localhost";
$user = "root";
$pass = "";
$dbname = "koperasi";
$conn = new mysqli($server, $user, $pass, $dbname);

function insertDB($table, $array) {
  global $conn;
  $query = "INSERT INTO ".$table;
  $fis = array(); 
  $vas = array();
  foreach($array as $field=>$val) {
    $fis[] = "`$field`"; //you must verify keys of array outside of function;
                         //unknown keys will cause mysql errors;
                         //there is also sql injection risc;
    $vas[] = "'".mysqli_real_escape_string($conn,$val)."'";
  }
  $query .= " (".implode(", ", $fis).") VALUES (".implode(", ", $vas).")";
  if (mysqli_query($conn,$query))
    return mysqli_insert_id($conn);
  else return false;
}

function updateDB($table,$array,$wherek,$wherev) {
  global $conn;
  unset($_POST[$wherek]);
  $query = "UPDATE ".$table." SET ";
  $fis = array(); 
  $vas = array();
  foreach($array as $field=>$val) {
    $vas = "'".mysqli_real_escape_string($conn,$val)."'";
    $fis[] = "$field = $vas";
  }
  $query .= "".implode(", ", $fis)."";
  $query .= " WHERE $wherek='$wherev'";
    if (mysqli_query($conn,$query))
    return true;
  else return false;
}
function idAnggota($id_user){
  global $conn;
  $data = mysqli_query($conn,"SELECT * FROM anggota WHERE id_user='$id_user'");
  $d = mysqli_fetch_array($data);
  $id_anggota = $d['id_anggota'];
  return $id_anggota;
}
?>
