<?php
session_start();
if($_SESSION['tk'] == 'vietpro.edu.vn' && $_SESSION['mk'] == 'vietpro.edu.vn'){
	$id_sp = $_GET['id_sp'];
	include_once('ketnoi.php');
	$sql = "DELETE FROM sanpham WHERE id_sp = $id_sp";
	$query = mysql_query($sql);
	header('location:quantri.php?page_layout=danhsachsp');
}
?>