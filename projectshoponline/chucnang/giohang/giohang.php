<?php
	if(!EMPTY($_SESSION['cart'])){
		if(isset($_POST['num'])){
			foreach ($_POST['num'] as $key => $value){
				$_SESSION['cart'][$key] = $value;
			}
		}
		$arrId=[];
		foreach($_SESSION['cart'] as $key => $value){
			$arrId[]=$key;
		}
		$strId=implode(',',$arrId);
		$sql = "SELECT * FROM sanpham WHERE id_sp IN ($strId) ORDER BY id_sp DESC";
		$query = mysqli_query($dbConnect,$sql);
	}
?>
<div class="prd-block">
                	<h2>giỏ hàng của bạn</h2>
                    <div class="cart">
					<form method="post" id="UpdateCart">
					<?php
						$totalAll = 0;
						while($product = mysqli_fetch_array($query)){
						$totalPrice=$_SESSION['cart'][$product['id_sp']] * $product['gia_sp'];
					?>
                    	<table width="100%">
                        	<tr>
                            	<td class="cart-item-img" width="25%" rowspan="4"><img width="80" height="144" src="quantri/anh/<?php echo $product['anh_sp']?>" /></td>
                                <td width="25%">Sản phẩm:</td>
                                <td class="cart-item-title" width="50%"><?php echo $product['ten_sp']?></td>
                            </tr>
                            <tr>
                                <td>Giá:</td> 
                                <td><span><?php echo number_format($product['gia_sp'],0,',','.')?> VND</span></td>
                            </tr>
                            <tr>
                            	<td>Số lượng:</td>
                                <td><input type="text" name="num[<?php echo $product['id_sp']?>]" value="<?php echo $_SESSION['cart'][$product['id_sp']]?>" /> (Bỏ mặt hàng này) <a href="chucnang/giohang/xoahang.php?id_sp=<?php echo $product['id_sp']?>">X</a></td>
                            </tr>
                            <tr>
                            	<td>Tổng tiền:</td>
                                <td><span><?php echo number_format($totalPrice,0,',','.')?> VND</span></td>
                            </tr>
                        </table>
						
                    <?php
						$totalAll += $totalPrice;
						}
					?>
					</form>
					<p>Tong gia tri cua gio hang la:<span><?php echo number_format($totalAll,0,',','.')?>VND</span></p>
					<p	 class = update-cart"><a href="#" onclick="document.getElementById('UpdateCart').submit()"><span>cap nhat gio hang</span></a><a href="index.php?page_layout=muahang">dung mua va thanh toan</a></p>
					<p><a href="#">Bo sung san pham</a><span>.</span><a href="chucnang/giohang/xoahang.php?id_sp=all">xoa het san pham</a><span>.</span></p>
					
                </div>
				</div>
				<?php
					
					
				?>
