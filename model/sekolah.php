<?php
class sekolah
{
 // table fields
 public $id;
 public $namasekolah;
 public $alamat;
 public $fasilitas;
 public $jumlahsiswa;
 public $kepalasekolah;
 
 // message string
 public $id_msg;
 public $namasekolah_msg;
 public $alamat_msg;
 public $fasilitas_msg;
 public $jumlahsiswa_msg;
 public $kepalasekolah_msg;
 
 // constructor set default value
 function __construct()
 {
 $id=$jumlahsiswa=0;$namasekolah=$alamat=$fasilitas=$kepalasekolah="";
 $id_msg=$namasekolah_msg=$alamat_msg=$fasilitas_msg=$jumlahsiswa_msg=$kepalasekolah_msg="";

 }
}
?>
