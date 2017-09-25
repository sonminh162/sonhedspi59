<?php
	$search = $_REQUEST['search']; 
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}
	else {
		$page = 1;
	}
	$orders = 3;
	$record= ($page - 1)* $orders;
	$sql = "SELECT * FROM sanpham WHERE ten_sp like '%$search%' LIMIT $record, $orders";
	$query = mysqli_query($dbConnect, $sql);
	$num_rows =  mysqli_num_rows(mysqli_query($dbConnect,"SELECT * FROM sanpham WHERE ten_sp like '%$search%'"));
	$num_pages= ceil($num_rows/$orders);
	$list_page='';
	if($page >1){
		$prev = $page -1;
		$list_page .= '<a href ="index.php?page_layout=danhsachtimkiem&search='.$search.'&page=1">Trang đầu</a>';
		$list_page .= '<a href ="index.php?page_layout=danhsachtimkiem&search='.$search.'&page='.$prev.'"> << </a>';
	}
	for($i=1; $i <= $num_pages; $i++)
	{
		if($i == $page){
			$list_page .= '<span>'.$i.'</span>';
		}
		else{
			$list_page .= '<a href ="index.php?page_layout=danhsachtimkiem&search='.$search.'&page='.$i.'">'.$i.'</a>';
		};
	}
	if($page < $num_pages){
		$next = $page +1;
		$list_page .= '<a href ="index.php?page_layout=danhsachtimkiem&search='.$search.'&page='.$next.'"> >> </a>';
		$list_page .= '<a href ="index.php?page_layout=danhsachtimkiem&search='.$search.'&page='.$num_pages.'"> Trang cuoi </a>';
	}
?>
            	<div class="prd-block">
                	<h2>kết quả tìm được với từ khóa <span class="skeyword">"điện thoại samsung"</span></h2>
                    <div class="pr-list">
						<?php
							while ($product = mysqli_fetch_array($query)){;
						?>
                    	<div class="prd-item">
                        	<a href="#"><img width="80" height="144" src="quantri/anh/<?php echo $product['anh_sp'] ?>" /></a>
                            <h3><a href="#"><?php echo $product['ten_sp'] ?></a></h3>
                            <p>Bảo hành: <?php echo $product['bao_hanh'] ?></p>
                            <p>Tình trạng: <?php echo $product['tinh_trang']?></p>
                            <p class="price"><span>Giá: <?php echo number_format($product['gia_sp'],0,',','.')?></span></p>
                        </div>
						<?php } ?>
                       
                    </div>
                </div>
                
				 <div class="clear"></div>
				 <div id="pagination"><?php echo $list_page ?></div>
				 
                <!--<div id="pagination"><a href="#">Trang đầu</a> <a href="#"><<</a> <span>1</span> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">>></a> <a href="#">Trang cuối</a></div>-->
           