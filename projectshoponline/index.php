<?php
	ob_start();
	session_start();
	include_once('ketnoi/ketnoi.php');
	include_once('layout/header.php');
			if(isset($_GET['page_layout'])){
					switch($_GET['page_layout']){
						case 'gioithieu':
						require_once('chucnang/menungang/gioithieu.php');
						break;
						case 'dichvu':
						require_once('chucnang/menungang/dichvu.php');
						break;
						case 'lienhe':
						require_once('chucnang/menungang/lienhe.php');
						break;
						case 'danhmucsp':
						include_once('chucnang/sanpham/danhsachsp.php');
						break;
						case 'danhsachtimkiem':
						include_once('chucnang/timkiem/danhsachtimkiem.php');
						break;
						case 'chitietsp':
						include_once('chucnang/sanpham/chitietsp.php');
						break;
						case 'giohang':
						include_once('chucnang/giohang/giohang.php');
						break;
						case 'muahang':
						include_once('chucnang/giohang/muahang.php');
						break;
					}
			}
			else{
				include_once('chucnang/sanpham/sanphamdacbiet.php');
				include_once('chucnang/sanpham/sanphammoi.php');
			}
	include_once('layout/footer.php');
?>