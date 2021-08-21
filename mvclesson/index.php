<?php
session_unset();
require_once 'controller/sekolahController.php'; 
$controller = new sekolahController(); 
$controller->mvcHandler();

?>