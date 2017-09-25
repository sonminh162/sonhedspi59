<?php
	session_start();
	$id_sp = $_GET['id_sp'];
	if(isset($_SESSION['cart'][$id_sp])){
		$_SESSION['cart'][$id_sp] = $_SESSION['cart'][$id_sp] + 1;
	}
	else{
		$_SESSION['cart'][$id_sp] = 1;
	}
	header('location:../../index.php?page_layout=giohang');
?>