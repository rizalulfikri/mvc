<?php
class sekolah
{
 // table fields
 public $id;
 public $namasekolah;
 public $alamatsekolah;
 public $fasilitassekolah;
 public $jumlahsiswa;
 public $jumlahguru;
 public $statussekolah;
 public $akreditasisekolah;
 public $namakepalasekolah;
 public $namakepalatatausaha;
 // message string
 public $id_msg;
 public $namasekolah_msg;
 public $alamatsekolah_msg;
 public $fasilitassekolah_msg;
 public $jumlahsiswa_msg;
 public $jumlahguru_msg;
 public $statussekolah_msg;
 public $akreditasisekolah_msg;
 public $namakepalasekolah_msg;
 public $namakepalatatausaha_msg;
 // constructor set default value
 function __construct()
 {
 $id=0;$namasekolah=$alamatsekolah=$fasilitassekolah=$jumlahsiswa=$jumlahguru=$statussekolah=$akreditasisekolah=$namakepalasekolah=$namakepalatatausaha"";
 $id_msg=$namasekolah_msg=$alamatsekolah_msg=$fasilitassekolah_msg=$jumlahsiswa_msg=$jumlahguru_msg=$statussekolah_msg=$akreditasisekolah_msg=$namakepalasekolah_msg=$namakepalatatausaha_msg"";
 }
}
?>
