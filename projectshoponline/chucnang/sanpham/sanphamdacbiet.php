<?php
	$sql = "SELECT * FROM sanpham WHERE dac_biet = 1 ORDER BY id_sp DESC LIMIT 6"	;	
	$query = mysqli_query($dbConnect, $sql);
?>
				<div class="prd-block">
                	<h2>sản phẩm đặc biệt</h2>
                    <div class="pr-list"> 
					<?php
						$i=0;
						while ($product = mysqli_fetch_array($query)){
					?>
					
                    	<div class="prd-item">
                        	<a href="index.php?page_layout=chitietsp&id_sp=<?php echo $product['id_sp']?>"><img width="80" height="144" src="quantri/anh/
							<?php echo $product['anh_sp']?>"/></a>
                            <h3><a href="#"><?php echo $product['ten_sp']?></a></h3>
                            <p>Bảo hành: <?php echo $product['bao_hanh']?></p>
                            <p>Tình trạng: <?php echo $product['tinh_trang']?></p>
                            <p class="price"><span>Giá: <?php echo number_format($product['gia_sp'],0,',','.')?>VND</span></p>
                        </div>	
                    <?php
						$i++;
						if($i % 3 == 0){
							echo '<div class="clear"></div>';
						}
						}
					?>
                        <div class="clear"></div>
                    </div>
                </div>
                