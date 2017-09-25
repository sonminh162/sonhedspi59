<?php
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$id_sp= $_GET['id_sp'];
	
	
	$sqlbl = "SELECT * FROM blsanpham WHERE id_sp = $id_sp";
	$querybl = mysqli_query($dbConnect,$sqlbl);
	
	
	$sql= "SELECT * FROM sanpham WHERE id_sp = $id_sp";
	$query = mysqli_query($dbConnect,$sql);
	$product = mysqli_fetch_array($query);
	
	if(isset($_POST['submit'])){
		$name = $_POST['ten'];
		$phone = $_POST['dien_thoai'];
		$comment = $_POST['binh_luan'];
		$date = date('Y/m/d H:i:s');
		$sql = "INSERT INTO blsanpham(id_sp, ten, dien_thoai, binh_luan, ngay_gio) VALUES ($id_sp,'$name','$phone','$comment','$date')";
		mysqli_query($dbConnect, $sql);
		header("location:index.php?page_layout=chitietsp&id_sp=$id_sp");
	}
?>
            	<div class="prd-block">
                    <div class="prd-only">
                    	<div class="prd-img"><img width="50%" src="quantri/anh/<?php echo $product['anh_sp']?>" /></div>	
                        <div class="prd-intro">
                        	<h3>HTC One X 32GB</h3>
                            <p>Giá sản phẩm: <span><?php echo number_format($product['gia_sp'],0,',','.')?> VNĐ</span></p>
                        	<table>
                            	<tr>
                                	<td width="30%"><span>Bảo hành:</span></td>
                                    <td>• <?php echo $product['bao_hanh']?></td>
                                </tr>
                                <tr>
                                	<td><span>Đi kèm:</span></td>
                                    <td>• Hộp, sách , sạc , cáp , tai nghe</td>
                                </tr>
                                <tr>
                                	<td><span>Tình trạng:</span></td>
                                    <td>• <?php echo $product['tinh_trang']?></td>
                                </tr>
                                <tr>
                                	<td><span>Khuyến Mại:</span></td>
                                    <td>• <?php echo $product['khuyen_mai']?></td>
                                </tr>
                                <tr>
                                	<td><span>Còn hàng:</span></td>
                                    <td>• <?php echo $product['trang_thai']?></td>
                                </tr>
                            </table>
                            <p class="add-cart"><a href="chucnang/giohang/themmoisp.php?id_sp=<?php echo $product['id_sp']?>"><span>đặt mua</span></a></p>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <div class="prd-details">
                        <p>HTC One X 32GB chiếc điện thoại nổi bật từ HTC, với cấu hình cao và chất lượng thiết kế tốt đem lại thành công cho hãng điện thoại này.</p>
                        </div>
                    </div>
                    
                    <div class="prd-comment">
                    <h3>Bình luận sản phẩm</h3>
                    <form method="post">
                    	<ul>
                        	<li class="required">Tên <br /><input type="text" name="ten" /> <span>(*)</span></li>
                            <li class="required">Số điện thoại <br /><input type="text" name="dien_thoai" /> <span>(*)</span></li>
                            <li class="required">Nội dung <br /><textarea name="binh_luan"></textarea> <span>(*)</span></li>
                            <li><input type="submit" name="submit" value="Bình luận" /></li>
                        </ul>
                    </form>
                    </div>
                    
                    <div class="comment-list">
					<?php
						while($com = mysqli_fetch_array($querybl)){
					?>
                    	<ul>
                        	<li class="com-title"><?php echo $com['ten']?><br /><span><?php echo $com['ngay_gio']?></span></li>
                            <li class="com-details"><?php echo $com['binh_luan']?></li>
                        </ul>
						<?php } ?>
                    </div>
                    
                    <div class="com-pagination"><span>1</span> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a></div>
                    
                </div>               
           