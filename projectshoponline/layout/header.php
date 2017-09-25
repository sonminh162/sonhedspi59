<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vietpro Mobile Shop - Website Bán Hàng Trực Tuyến</title>
<link rel="stylesheet" type="text/css" href="css/trangchu.css" />

<link rel="stylesheet" type="text/css" href="css/slideshow.css" />
<?php
	if(isset($_GET['page_layout'])){
					switch($_GET['page_layout']){
						case 'gioithieu':
							echo '<link rel="stylesheet" type="text/css" href="css/gioithieu.css">';
						break;
						case 'dichvu':
							echo '<link rel="stylesheet" type="text/css" href="css/dichvu.css">';
						break;
						case 'lienhe':
							echo '<link rel="stylesheet" type="text/css" href="css/lienhe.css">';
						case 'danhmucsp':
							echo '<link rel="stylesheet" type ="text/css" href="css/danhsachsp.css"/>';
						break;
						case 'danhsachtimkiem':
							echo '<link rel= "stylesheet type="text/css" href="css/danhsachtimkiem.css"/>';
						break;
						case 'chitietsp':
							echo '<link rel= "stylesheet type="text/css" href="css/chitietsp.css"/>';
						break;
						case 'giohang':
							echo '<link rel= "stylesheet type="text/css" href="css/giohang.css"/>';
						break;
						case 'muahang':
							echo '<link rel= "stylesheet type="text/css" href="css/muahang.css"/>';
						break;
					}
			}
?>

<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>

<script type="text/javascript">

/*** 
    Simple jQuery Slideshow Script
    Released by Jon Raasch (jonraasch.com) under FreeBSD license: free to use or modify, not responsible for anything, etc.  Please link out to me if you like it :)
***/

function slideSwitch() {
    var $active = $('#slideshow IMG.active');

    if ( $active.length == 0 ) $active = $('#slideshow IMG:last');

    // use this to pull the anh in the order they appear in the markup
    var $next =  $active.next().length ? $active.next()
        : $('#slideshow IMG:first');

    // uncomment the 3 lines below to pull the anh in random order
    
    // var $sibs  = $active.siblings();
    // var rndNum = Math.floor(Math.random() * $sibs.length );
    // var $next  = $( $sibs[ rndNum ] );


    $active.addClass('last-active');

    $next.css({opacity: 0.0})
        .addClass('active')
        .animate({opacity: 1.0}, 1000, function() {
            $active.removeClass('active last-active');
        });
}

$(function() {
    setInterval( "slideSwitch()", 2000 );
});

</script>

</head>
<body>

<!-- Wrapper -->
<div id="wrapper">
	<!-- Header -->
    <div id="header">
    	<div id="search-bar">
        	<?php
				include_once('chucnang/timkiem/timkiem.php');
				include_once('chucnang/giohang/giohangcuaban.php');
			?>	
        </div>
        <div id="main-bar">
        	<div id="logo"><a href="#"><img src="anh/logo.png" /></a></div>
            <div id="banner"></div>
        </div>
        <div id="navbar">
        	<ul>
            	<li id="menu-home"><a href="index.php">trang chủ</a></li>
                <li><a href="index.php?page_layout=gioithieu">giới thiệu</a></li>
                <li><a  href="index.php?page_layout=dichvu">dịch vụ</a></li>
                <li><a  href="index.php?page_layout=lienhe">liên hệ</a></li>
                <li><a 	href="#">diễn đàn</a></li>
            </ul>
        </div>
    </div>
    <!-- End Header -->
    <!-- Body -->
    <div id="body">
    	<!-- Left Column -->
    	<div id="l-col">
        	<div class="l-sidebar">
            	<h2>tư vấn online</h2>
            	<ul id="hotline">
                	<li><span>Tư vấn 01</span><a class="yh" href="ymsgr:sendIM?daotaotructuyen01&amp;m=Xin chào!"><img border="0" alt="" src="http://opi.yahoo.com/online?u=daotaotructuyen01&amp;m=g&amp;t=1"></a></li>
                    <li><span>Tư vấn 02</span><a class="yh" href="ymsgr:sendIM?daotaotructuyen01&amp;m=Xin chào!"><img border="0" alt="" src="http://opi.yahoo.com/online?u=daotaotructuyen01&amp;m=g&amp;t=1"></a></li>
                    <li><span>Tư vấn 03</span><a class="yh" href="ymsgr:sendIM?daotaotructuyen01&amp;m=Xin chào!"><img border="0" alt="" src="http://opi.yahoo.com/online?u=daotaotructuyen01&amp;m=g&amp;t=1"></a></li>
                    <li><span>Tư vấn 04</span><a class="yh" href="ymsgr:sendIM?daotaotructuyen01&amp;m=Xin chào!"><img border="0" alt="" src="http://opi.yahoo.com/online?u=daotaotructuyen01&amp;m=g&amp;t=1"></a></li>
                </ul>
            </div>
            <?php
				include_once('chucnang/sanpham/danhmucsanpham.php');
			?>
            <div class="l-sidebar">
            	<h2>đối tác</h2>
            	<div class="l-banner"><a href="#"><img width="216" src="anh/banner01.png" /></a></div>
            </div>
            <div class="l-sidebar">
            <?php
				include_once('chucnang/thongke/thongke.php');
			?>	
                
            </div>
            <!-- <div class="l-sidebar"></div> -->
        </div>
        <!-- End Left Column -->
        
        <!-- Right Column -->
        <div id="r-col">
        	<div id="slideshow">
            	<img src="anh/sls01.jpg" alt="Slideshow Image 1" class="active" />
                <img src="anh/sls02.png" alt="Slideshow Image 2" />
                <img src="anh/sls03.jpg" alt="Slideshow Image 3" />
                <img src="anh/sls04.jpg" alt="Slideshow Image 4" />
                <img src="anh/sls05.png" alt="Slideshow Image 5" />
                <img src="anh/sls06.png" alt="Slideshow Image 6" />
            </div>
            
            <div id="main">
