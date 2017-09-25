<?php
	session_start();
	$id_sp=$_GET['id_sp'];
	if(isset($_SESSION['cart'])){
		if($id_sp == 'all'){
			unset($_SESSION['cart']);
		}
		else{
			unset($_SESSION['cart'][$id_sp]);
		}
	}
	header('location:../../index.php?page_layout=giohang');
?>