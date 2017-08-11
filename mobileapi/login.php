<?php
require_once("../php/connection.php");

$respon = array();

if (isset($_GET['email']) && isset($_GET['password']) ) {
  $email = $_GET['email'];
  $pass = $_GET['password'];


  $hasil = mysqli_query($mysqli, "SELECT * FROM data_pasien WHERE email='$email' AND password=md5('$pass')")
        or die("Could not execute the select query.");

        $hasil2 = mysqli_query($mysqli, "SELECT * FROM data_dokter WHERE email='$email' AND password=md5('$pass')")
                    or die("Could not execute the select query.");

      $row = mysqli_fetch_assoc($hasil);
      $row2 = mysqli_fetch_assoc($hasil2);

    if(is_array($row) && !empty($row)) {
        $respon["data_pasien"] = array();
        $data_pasien = array();
        $data_pasien["id_pasien"] = $row["id_pasien"];
        $data_pasien["nama_pasien"] = $row["nama_pasien"];
        $data_pasien["email"] = $row["email"];
        $data_pasien["password"] = $row["password"];
        $data_pasien["device_id"] = $row["device_id"];
        $data_pasien["alamat"] = $row["alamat"];
        $data_pasien["jenis_kelamin"] = $row["jenis_kelamin"];
        $data_pasien["id_dokter"] = $row["id_dokter"];

        array_push($respon["data_pasien"], $data_pasien);

        $respon["sukses"] = 1;
        $respon["pesan"] = "Pasien sukses login.";

        echo json_encode($respon);
    }else if(is_array($row2) && !empty($row2)) {
        $respon["data_dokter"] = array();
        $data_dokter = array();
        $data_dokter["id_dokter"] = $row2["id_dokter"];
        $data_dokter["nama_dokter"] = $row2["nama_dokter"];
        $data_dokter["email"] = $row2["email"];
        $data_dokter["password"] = $row2["password"];

        array_push($respon["data_dokter"], $data_dokter);

        $respon["sukses"] = 2;
        $respon["pesan"] = "Dokter sukses login.";

        echo json_encode($respon);
    } else {

        $respon["sukses"] = 3;
        $respon["pesan"] = "Terjadi error.";


        echo json_encode($respon);
    }

}else {

    $respon["sukses"] = 0;
    $respon["pesan"] = "Field requestnya kosong";


    echo json_encode($respon);
}



?>
