<?php
session_start();
if($_SESSION['tk'] == 'vietpro.edu.vn' && $_SESSION['mk'] == 'vietpro.edu.vn'){
	session_unset($_SESSION['tk']);
	session_unset($_SESSION['mk']);
}
header('location:index.php');
?>