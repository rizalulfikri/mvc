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

 // Validate alamat
 if(empty($sekolahtb->alamat)){
 $sekolahtb->alamat_msg = "Field is empty.";$noerror=false;
 } elseif(!filter_var($sekolahtb->alamat, FILTER_VALIDATE_REGEXP,
array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
 $sekolahtb->alamat_msg = "Invalid entry.";$noerror=false;
 }else{$sekolahtb->alamat_msg ="";}

 // Validate fasilitas
 if(empty($sekolahtb->fasilitas)){
    $sekolahtb->fasilitas_msg = "Field is empty.";$noerror=false;
    } elseif(!filter_var($sekolahtb->fasilitas, FILTER_VALIDATE_REGEXP,
   array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $sekolahtb->fasilitas_msg = "Invalid entry.";$noerror=false;
    }else{$sekolahtb->fasilitas_msg ="";} 

    // Validate jumlahsiswa
 if(empty($sekolahtb->jumlahsiswa)){
    $sekolahtb->jumlahsiswa_msg = "Field is empty.";$noerror=false;
    } elseif(!filter_var($sekolahtb->jumlahsiswa, FILTER_VALIDATE_REGEXP,
   array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $sekolahtb->jumlahsiswa_msg = "Invalid entry.";$noerror=false;
    }else{$sekolahtb->jumlahsiswa_msg ="";} 

    // Validate kepalasekolah
 if(empty($sekolahtb->kepalasekolah)){
    $sekolahtb->kepalasekolah_msg = "Field is empty.";$noerror=false;
    } elseif(!filter_var($sekolahtb->kepalasekolah, FILTER_VALIDATE_REGEXP,
   array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $sekolahtb->kepalasekolah_msg = "Invalid entry.";$noerror=false;
    }else{$sekolahtb->kepalasekolah_msg ="";} 

      
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
 $sekolahtb->alamat = trim($_POST['alamat']);
 $sekolahtb->fasilitas = trim($_POST['fasilitas']);
 $sekolahtb->jumlahsiswa = trim($_POST['jumlahsiswa']);
 $sekolahtb->kepalasekolah = trim($_POST['kepalasekolah']);
 
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
 $sekolahtb->alamat = trim($_POST['alamat']);
 $sekolahtb->fasilitas = trim($_POST['fasilitas']);
 $sekolahtb->jumlahsiswa = trim($_POST['jumlahsiswa']);
 $sekolahtb->kepalasekolah = trim($_POST['kepalasekolah']);
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
 $sekolahtb->alamat=$row["alamat"];
 $sekolahtb->fasilitas=$row["fasilitas"];
 $sekolahtb->jumlahsiswa=$row["jumlahsiswa"];
 $sekolahtb->kepalasekolah=$row["kepalasekolah"];
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
