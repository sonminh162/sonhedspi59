					<?php
						$arrId=[];
						foreach($_SESSION['cart'] as $key => $value){
							$arrId[]=$key;
							
						}
						$strId= implode(',',$arrId);
						$sql = "SELECT * FROM sanpham WHERE id_sp IN ($strId) ORDER BY id_sp DESC";
						$query = mysqli_query($dbConnect,$sql);
					?>
					<div class="prd-block">
                	<h2>xác nhận hóa đơn thanh toán</h2>
                    <div class="payment">
                    	<table border="0px" cellpadding="0px" cellspacing="0px" width="100%">
                        	<tr id="invoice-bar">
                            	<td width="45%">Tên Sản phẩm</td>
                                <td width="20%">Giá</td>
                                <td width="15%">Số lượng</td>
                                <td width="20%">Thành tiền</td>
                            </tr>
							 <?php
							 $totalAll = 0;
							while($product=mysqli_fetch_array($query)){
							$totalPrice = $_SESSION['cart'][$product['id_sp']] * $product['gia_sp'];
							?>
                            <tr>
                            	<td class="prd-name"><?php echo $product['ten_sp']?></td>
                                <td class="prd-price"><?php echo number_format($product['gia_sp'],0,',','.')?> VNĐ</td>
                                <td class="prd-number"><?php echo $product['id_sp']?></td>
                                <td class="prd-total"><?php echo number_format($totalPrice,0,',','.')?> VNĐ</td>
                            </tr>
                            <?php
							$totalAll += $totalPrice;
							}
							?> 
                            <tr>
                            	<td class="prd-name">Tổng giá trị hóa đơn là:</td>
                                <td colspan="2"></td>
                                <td class="prd-total"><span><?php echo number_format($totalAll,0,',','.')?> VNĐ</span></td>
                            </tr>
                        </table>
  
                    </div>
                    
                    <div class="form-payment">
                    	<form method="post">
                    	<ul>
                        	<li class="info-cus"><label>Tên khách hàng</label><br /><input type="text" name="ten" /> <span>(*)</span></li>
                            <li class="info-cus"><label>Địa chỉ Email</label><br /><input type="text" name="mail" /> <span>(*)</span></li>
                            <li class="info-cus"><label>Số Điện thoại</label><br /><input type="text" name="dt" /> <span>(*)</span></li>
                            <li class="info-cus"><label>Địa chỉ nhận hàng</label><br /><input type="text" name="dc" /> <span>(*)</span></li>
                            <li><input type="submit" name="submit" value="Xác nhận mua hàng" /> <input type="reset" name="reset" value="Làm lại" /></li>
                        </ul>
                        </form>
                    </div>
                </div>
				<?php
					if(isset($_POST['submit'])){
						$name = $_POST['ten'];
						$email = $_POST['mail'];
						$phone = $_POST['dt'];
						$address = $_POST['dc'];
						
						$sql = "SELECT * FROM sanpham WHERE id_sp IN ($strId) ORDER BY id_sp DESC";
						$query = mysqli_query($dbConnect,$sql);
						
						$strBody = '';
						
			$strBody .=	'<p>
								<b>Khách hàng:</b>'.$name.'<br />
								<b>Email:</b>'.$email.'<br />
								<b>Điện thoại:</b>'.$phone.'<br />
								<b>Địa chỉ:</b>'.$address.'
						</p>';
						
						
			$strBody .=	'<table border="1px" cellpadding="10px" cellspacing="1px" width="100%">
						<tr>
								<td align="center" bgcolor="#3F3F3F" colspan="4"><font color="white"><b>XÁC NHẬN HÓA ĐƠN THANH TOÁN</b></font></td>
						</tr>';
						
						
	$strBody .=			'<tr id="invoice-bar">
							<td width="45%"><b>Tên Sản phẩm</b></td>
							<td width="20%"><b>Giá</b></td>
							<td width="15%"><b>Số lượng</b></td>
							<td width="20%"><b>Thành tiền</b></td>
						</tr>';
	$totalAll = 0;
	while($product = mysqli_fetch_array($query)){
		$totalPrice = $_SESSION['cart'][$product['id_sp']] * $product['gia_sp'];
	
	$strBody .=			'<tr>
							<td class="prd-name">'.$product['gia_sp'].'</td>
							<td class="prd-price"><font color="#C40000"> '.$product['gia_sp'].'VNĐ</font></td>
							<td class="prd-number">'.$_SESSION['cart'][$product['id_sp']].'</td>
							<td class="prd-total"><font color="#C40000">'.$totalAll.' VNĐ</font></td>
						</tr>';
	
	$totalAll += $totalPrice;
	}
	$strBody .=			'<tr>
							<td class="prd-name">Tổng giá trị hóa đơn là:</td>
							<td colspan="2"></td>
							<td class="prd-total"><b><font color="#C40000">'.$totalAll.' VNĐ</font></b></td>
						</tr>
						</table>';
	$strBody .=		'<p align="justify">
					<b>Quý khách đã đặt hàng thành công!</b><br />
						• Sản phẩm của Quý khách sẽ được chuyển đến Địa chỉ có trong phần Thông tin Khách hàng của chúng Tôi sau thời gian 2 đến 3 ngày, tính từ thời điểm này.<br />
						• Nhân viên giao hàng sẽ liên hệ với Quý khách qua Số Điện thoại trước khi giao hàng 24 tiếng.<br />
					<b><br />Cám ơn Quý khách đã sử dụng Sản phẩm của Công ty chúng Tôi!</b>
					</p>';

	require_once('class.phpmailer.php'); // nạp thư viện mailer
        $mailer = new PHPMailer(); // Khởi tạo đối tượng
        $mailer->IsSMTP(); // gọi class smtp để đăng nhập 
        $mailer->CharSet="utf-8"; // bảng mã unicode

        //Đăng nhập Gmail 
        $mailer->SMTPAuth = true; // Đăng nhập 
        $mailer->SMTPSecure = "ssl"; // Giao thức SSL 
        $mailer->Host = "smtp.gmail.com"; // SMTP của GMAIL 
        $mailer->Port = 465; // cổng SMTP 
         
        // Phải chỉnh sửa lại 
        $mailer->Username = "thaison.a.t.96@gmail.com"; // GMAIL username 
        $mailer->Password = "sonyeuminh"; // GMAIL password 
        $mailer->AddAddress($email, $name); //email người nhận 
        $mailer->AddCC("vietproacademy@gmail.com", "Admin Vietpro Shop"); // gửi thêm một email cho Admin 
          
        // Chuẩn bị gửi thư nào 
        $mailer->FromName = 'VietproShop'; // tên người gửi 
        $mailer->From = 'vietproacademy@gmail.com'; // mail người gửi 
        $mailer->Subject = 'Hóa đơn xác nhận mua hàng từ Vietpro Shop'; 
        $mailer->IsHTML(TRUE); //Bật HTML không thích thì false 
          
        // Nội dung lá thư 
        $mailer->Body = $strBody; 
          
        //Gửi email  
        if(!$mailer->Send()){
            // Gửi không được, đưa ra thông báo lỗi
            echo "Lỗi gửi Email: " . $mailer->ErrorInfo; 
        }
        else{    
            // Gửi thành công
            unset($_SESSION['cart']);
            header('location:index.php?page_layout=hoanthanh');
					
					}
					}			
				?>	