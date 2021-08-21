<?php
 require 'model/sekolahModel.php';
 require 'model/sekolah.php';
 require_once 'config.php';
 session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

 class sekolahController
 {
 function __construct()
 {
 $this->objconfig = new config();
 $this->objsm = new sekolahModel($this->objconfig);
 }
 // mvc handler request
 public function mvcHandler()
 {
 $act = isset($_GET['act']) ? $_GET['act'] : NULL;
 switch ($act)
 {
 case 'add' :
 $this->insert();
 break;
 case 'update':
 $this->update();
 break;
 case 'delete' :
 $this -> delete();
 break;
 default:
 $this->list();
 }
 }
 // page redirection
 public function pageRedirect($url)
 {
 header('Location:'.$url);
 }
 // check validation
 public function checkValidation($sekolahtb)
 { $noerror=true;
 // Validate namasekolah
 if(empty($sekolahtb->namasekolah)){
 $sekolahtb->namasekolah_msg = "Field is empty.";$noerror=false;
 } elseif(!filter_var($sekolahtb->namasekolah, FILTER_VALIDATE_REGEXP,
array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
 $sekolahtb->namasekolah_msg = "Invalid entry.";$noerror=false;
 }else{$sekolahtb->namasekolah_msg ="";} 

 // Validate alamatsekolah
 if(empty($sekolahtb->alamatsekolah)){
 $sekolahtb->alamatsekolah_msg = "Field is empty.";$noerror=false;
 } elseif(!filter_var($sekolahtb->alamatsekolah, FILTER_VALIDATE_REGEXP,
array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
 $sekolahtb->alamatsekolah_msg = "Invalid entry.";$noerror=false;
 }else{$sekolahtb->alamatsekolah_msg ="";}

 // Validate fassilitassekolah
 if(empty($sekolahtb->fasilitassekolah)){
    $sekolahtb->fasilitassekolah_msg = "Field is empty.";$noerror=false;
    } elseif(!filter_var($sekolahtb->fasilitassekolah, FILTER_VALIDATE_REGEXP,
   array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $sekolahtb->fasilitassekolah_msg = "Invalid entry.";$noerror=false;
    }else{$sekolahtb->fasilitassekolah_msg ="";}

    // Validate jumlahsiswa
 if(empty($sekolahtb->jumlahsiswa)){
    $sekolahtb->jumlahsiswa_msg = "Field is empty.";$noerror=false;
    } elseif(!filter_var($sekolahtb->jumlahsiswa, FILTER_VALIDATE_REGEXP,
   array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $sekolahtb->jumlahsiswa_msg = "Invalid entry.";$noerror=false;
    }else{$sekolahtb->jumlahsiswa_msg ="";}

    // Validate jumlahguru
 if(empty($sekolahtb->jumlahguru)){
    $sekolahtb->jumlahguru_msg = "Field is empty.";$noerror=false;
    } elseif(!filter_var($sekolahtb->jumlahguru, FILTER_VALIDATE_REGEXP,
   array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $sekolahtb->jumlahguru_msg = "Invalid entry.";$noerror=false;
    }else{$sekolahtb->jumlahguru_msg ="";}

    // Validate statussekolah
 if(empty($sekolahtb->statussekolah)){
    $sekolahtb->statussekolah_msg = "Field is empty.";$noerror=false;
    } elseif(!filter_var($sekolahtb->statussekolah, FILTER_VALIDATE_REGEXP,
   array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $sekolahtb->statussekolah_msg = "Invalid entry.";$noerror=false;
    }else{$sekolahtb->statussekolah_msg ="";}

    // Validate akreditasisekolah
 if(empty($sekolahtb->akreditasi)){
    $sekolahtb->akreditasi_msg = "Field is empty.";$noerror=false;
    } elseif(!filter_var($sekolahtb->akreditasisekolah, FILTER_VALIDATE_REGEXP,
   array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $sekolahtb->akreditasisekolah_msg = "Invalid entry.";$noerror=false;
    }else{$sekolahtb->akreditasisekolah_msg ="";}

    // Validate namakepalasekolah
 if(empty($sekolahtb->namakepalasekolah)){
    $sekolahtb->namakepalasekolah_msg = "Field is empty.";$noerror=false;
    } elseif(!filter_var($sekolahtb->namakepalasekolah, FILTER_VALIDATE_REGEXP,
   array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $sekolahtb->namakepalasekolah_msg = "Invalid entry.";$noerror=false;
    }else{$sekolahtb->namakepalasekolah_msg ="";}

    // Validate namakepalatatausaha
 if(empty($sekolahtb->namakepalatatausaha)){
    $sekolahtb->namakepalatatausaha_msg = "Field is empty.";$noerror=false;
    } elseif(!filter_var($sekolahtb->namakepalatatusaha, FILTER_VALIDATE_REGEXP,
   array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $sekolahtb->namakepalatatausaha_msg = "Invalid entry.";$noerror=false;
    }else{$sekolahtb->namakepalatatausaha_msg ="";}
 return $noerror;
 }
 // add new record
 public function insert()
 {
 try{
 $sekolahtb=new sekolah();
 if (isset($_POST['addbtn']))
 {
 // read form value
 $sekolahtb->namasekolah = trim($_POST['namasekolah']);
 $sekolahtb->alamatsekolah = trim($_POST['alamatsekolah']);
 $sekolahtb->fasilitassekolah = trim($_POST['fasilitassekolah']);
 $sekolahtb->jumlahsiswa = trim($_POST['jumlahsiswa']);
 $sekolahtb->jumlahguru = trim($_POST['jumlahguru']);
 $sekolahtb->statussekolah = trim($_POST['statussekolah']);
 $sekolahtb->akreditasisekolah = trim($_POST['akreditasisekolah']);
 $sekolahtb->namakepalasekolah = trim($_POST['namakepalasekolah']);
 $sekolahtb->namakepalatatausaha = trim($_POST['namakepalatatausaha']);
 //call validation
 $chk=$this->checkValidation($sekolahtb);
 if($chk)
 {
 //call insert record
 $pid = $this -> objsm ->insertRecord($sekolahtb);
 if($pid>0){
 $this->list();
 }else{
 echo "Somthing is wrong..., try again.";
 }
 }else
 {
 $_SESSION['sekolahtbl0']=serialize($sekolahtb);//add session obj
 $this->pageRedirect("view/insert.php");
 }
 }
 }catch (Exception $e)
 {
 $this->close_db();
 throw $e;
 }
 }
 // update record
 public function update()
 {
 try
 {

 if (isset($_POST['updatebtn'])) 

 {
 $sekolahtb=unserialize($_SESSION['sekolahtbl0']);
 $sekolahtb->id = trim($_POST['id']);
 $sekolahtb->namasekolah = trim($_POST['namasekolah']);
 $sekolahtb->alamatsekolah= trim($_POST['alamatsekolah']);
 $sekolahtb->fasilitassekolah = trim($_POST['fasilitassekolah']);
 $sekolahtb->jumlahsiswa = trim($_POST['jumlahsiswa']);
 $sekolahtb->jumlahguru = trim($_POST['jumlahguru']);
 $sekolahtb->statussekolah = trim($_POST['statussekolah']);
 $sekolahtb->akreditasisekolah = trim($_POST['akreditasisekolah']);
 $sekolahtb->namakepalasekolah= trim($_POST['namakepalasekolah']);
 $sekolahtb->namakepalatatausaha = trim($_POST['namakepalatatausaha']);
 // check validation
 $chk=$this->checkValidation($sekolahtb);
 if($chk)
 {
 $res = $this -> objsm ->updateRecord($sekolahtb);
 if($res){
 $this->list();
 }else{
 echo "Somthing is wrong..., try again.";
 }
 }else
 {
 $_SESSION['sekolahtbl0']=serialize($sekolahtb);
 $this->pageRedirect("view/update.php");
 }
 }elseif(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
 $id=$_GET['id'];
 $result=$this->objsm->selectRecord($id);
 $row=mysqli_fetch_array($result);
 $sekolahtb=new sekolah();
 $sekolahtb->id=$row["id"];
 $sekolahtb->namasekolah=$row["namasekolah"];
 $sekolahtb->alamatsekolah=$row["alamatsekolah"];
 $sekolahtb->fasilitassekolah=$row["id"];
 $sekolahtb->jumlahsiswa=$row["id"];
 $sekolahtb->jumlahguru=$row["id"];
 $sekolahtb->statussekolah=$row["id"];
 $sekolahtb->akreditasisekolah=$row["id"];
 $sekolahtb->namakepalasekolah=$row["id"];
 $sekolahtb->namakepalatatausaha=$row["id"];
 $_SESSION['sekolahtbl0']=serialize($sekolahtb);
 $this->pageRedirect('view/update.php');
 }else{
 echo "Invalid operation.";
 }
 }
 catch (Exception $e)
 {
 $this->close_db();
 throw $e;
 }
 }
 // delete record
 public function delete()
 {
 try
 {
 if (isset($_GET['id']))
 {
 $id=$_GET['id'];
 $res=$this->objsm->deleteRecord($id); 

 if($res){
 $this->pageRedirect('index.php');
 }else{
 echo "Somthing is wrong..., try again.";
 }
 }else{
 echo "Invalid operation.";
 }
 }
 catch (Exception $e)
 {
 $this->close_db();
 throw $e;
 }
 }
 public function list(){
 $result=$this->objsm->selectRecord(0);
 include "view/list.php";
 }
 }


?>
