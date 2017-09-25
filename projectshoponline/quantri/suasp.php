<?php
// Lấy Tham số id_sp trên URL
$id_sp = $_GET['id_sp'];

// Lấy Thông tin của ản phẩm trong CSDL
$sql = "SELECT * FROM sanpham WHERE id_sp = $id_sp";
$query = mysqli_query($dbConnect,$sql);
$row = mysqli_fetch_array($query);

// Lấy thông tin Danh mục Sản phẩm Selectbox
$sqlDm = "SELECT * FROM dmsanpham";
$queryDm = mysqli_query($dbConnect,$sqlDm);

// Bẫy lỗi để trống trường dữ liệu trong Form
if(isset($_POST['submit'])){
	// Tên Sản phẩm
	if($_POST['ten_sp'] == ''){
		$error_ten_sp = '<span style="color:red;">(*)<span>';	
	}
	else{
		$ten_sp = $_POST['ten_sp'];	
	}	
	// Giá Sản phẩm
	if($_POST['gia_sp'] == ''){
		$error_gia_sp = '<span style="color:red;">(*)<span>';	
	}
	else{
		$gia_sp = $_POST['gia_sp'];	
	}
	// Bảo hành
	if($_POST['bao_hanh'] == ''){
		$error_bao_hanh = '<span style="color:red;">(*)<span>';	
	}
	else{
		$bao_hanh = $_POST['bao_hanh'];	
	}
	// Phụ kiện
	if($_POST['phu_kien'] == ''){
		$error_phu_kien = '<span style="color:red;">(*)<span>';	
	}
	else{
		$phu_kien = $_POST['phu_kien'];	
	}
	// Tình trạng
	if($_POST['tinh_trang'] == ''){
		$error_tinh_trang = '<span style="color:red;">(*)<span>';	
	}
	else{
		$tinh_trang = $_POST['tinh_trang'];	
	}
	// Khuyến mãi
	if($_POST['khuyen_mai'] == ''){
		$error_khuyen_mai = '<span style="color:red;">(*)<span>';	
	}
	else{
		$khuyen_mai = $_POST['khuyen_mai'];	
	}
	// Trạng thái
	if($_POST['trang_thai'] == ''){
		$error_trang_thai = '<span style="color:red;">(*)<span>';	
	}
	else{
		$trang_thai = $_POST['trang_thai'];	
	}
	// Chi tiết Sản phẩm
	if($_POST['chi_tiet_sp'] == ''){
		$error_chi_tiet_sp = '<span style="color:red;">(*)<span>';	
	}
	else{
		$chi_tiet_sp = $_POST['chi_tiet_sp'];	
	}
	// Ảnh mô tả Sản phẩm
	// Lấy ra ảnh hiện tại
	$anh_hien_tai = $_POST['anh_sp'];
	//Kiểm tra xem có upload ảnh mới hay không? 
	if($_FILES['anh_moi']['name']== ''){
		$anh_sp=$anh_hien_tai;
		
	}
	else {
		//kiểm tra định dạng file ảnh
		if($_FILES['anh_moi']['type'] == 'image/png' || $_FILES['anh_moi']['type'] == 'image/jpg' || $_FILES['anh_moi']['type']= 'image/gif')
		{
			$anh_sp = $_FILES['anh_moi']['name'];
			$tmp = 	$_FILES['anh_moi']['tmp_name'];
			//kiểm tra sự tồn tại của file ảnh
			if(file_exists("anh/anh_sp")){
				$anh_sp= rand(100,1000).'-'.$anh_sp;
			}
			//upload file mới vào thư mục ảnh
			move_uploaded_file($tmp,'anh/'.$anh_sp);
			//xóa ảnh cũ của sản phẩm
			unlink("anh/$anh_hien_tai");
		}
		
		else{
			$error_anh_sp='<span style ="color:red;">vui long nhap file anh<span>';
		}
	}
	
	// Danh mục Sản phẩm
	$id_dm = $_POST['id_dm'];
	// Sản phẩm Đặc biệt
	$dac_biet = $_POST['dac_biet'];
	
	// Xử lý Sửa Thông tin Sản phẩm
	if(isset($ten_sp) && isset($gia_sp) && isset($bao_hanh) && isset($phu_kien) && isset($tinh_trang) && isset($khuyen_mai) && isset($trang_thai) && isset($chi_tiet_sp)){	
		// Xử lý Upload nếu Ảnh Mô Tả được thay đổi
		
		// Xử lý Upload Thông tin Sản phẩm vào CSDL
		$sql = "UPDATE sanpham SET id_dm = $id_dm, ten_sp = '$ten_sp', anh_sp = '$anh_sp', gia_sp = '$gia_sp', bao_hanh = '$bao_hanh', phu_kien = '$phu_kien', tinh_trang = '$tinh_trang', khuyen_mai = '$khuyen_mai', trang_thai = '$trang_thai', dac_biet = '$dac_biet', chi_tiet_sp = '$chi_tiet_sp' WHERE id_sp = $id_sp";
		$query = mysqli_query($dbConnect,$sql);
		header('location:quantri.php?page_layout=danhsachsp');	
	}	
	
}
?>
<h2>sửa thông tin sản phẩm</h2>
<div id="main">
    <form method="post" enctype="multipart/form-data">
    <table id="add-prd" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td><label>Tên sản phẩm</label><br /><input type="text" name="ten_sp" value="<?php if(isset($_POST['ten_sp'])){echo $_POST['ten_sp'];}else{echo $row['ten_sp'];}?>" /> <?php if(isset($error_ten_sp)){echo $error_ten_sp;}?></td>
        </tr>
        <tr>
            <td><label>Ảnh mô tả</label><br /><input type="file" name="anh_moi" /> <input type="hidden" name="anh_sp" value="<?php echo $row['anh_sp'];?>" /></td>
        </tr>
        <tr>
            <td><label>Nhà cung cấp</label><br />
                <select name="id_dm">
                	<?php while($rowDm = mysqli_fetch_array($queryDm)){?>
                    <option <?php if($rowDm['id_dm'] == $row['id_dm']){echo "selected='selected'";}?> value=<?php echo $rowDm['id_dm'];?>><?php echo $rowDm['ten_dm']?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Giá sản phẩm</label><br /><input type="text" name="gia_sp" value="<?php if(isset($_POST['gia_sp'])){echo $_POST['gia_sp'];}else{echo $row['gia_sp'];}?>" /> VNĐ <?php if(isset($error_gian_sp)){echo $error_gia_sp;}?></td>
        </tr>
        <tr>
            <td><label>Bảo hành</label><br /><input type="text" name="bao_hanh" value="<?php if(isset($_POST['bao_hanh'])){echo $_POST['bao_hanh'];}else{echo $row['bao_hanh'];}?>" /> <?php if(isset($error_bao_hanh)){echo $error_bao_hanh;}?></td>
        </tr>
        <tr>
            <td><label>Đi kèm</label><br /><input type="text" name="phu_kien" value="<?php if(isset($_POST['phu_kien'])){echo $_POST['phu_kien'];}else{echo $row['phu_kien'];}?>" /> <?php if(isset($error_phu_kien)){echo $error_phu_kien;}?></td>
        </tr>
        <tr>
            <td><label>Tình trạng</label><br /><input type="text" name="tinh_trang" value="<?php if(isset($_POST['tinh_trang'])){echo $_POST['tinh_trang'];}else{echo $row['tinh_trang'];}?>" /> <?php if(isset($error_tinh_trang)){echo $error_tinh_trang;}?></td>
        </tr>
        <tr>
            <td><label>Khuyến mại</label><br /><input type="text" name="khuyen_mai" value="<?php if(isset($_POST['khuyen_mai'])){echo $_POST['khuyen_mai'];}else{echo $row['khuyen_mai'];}?>" /> <?php if(isset($error_khuyen_mai)){echo $error_khuyen_mai;}?></td>
        </tr>
        <tr>
            <td><label>Còn hàng</label><br /><input type="text" name="trang_thai" value="<?php if(isset($_POST['trang_thai'])){echo $_POST['trang_thai'];}else{echo $row['trang_thai'];}?>" /> <?php if(isset($error_trang_thai)){echo $error_trang_thai;}?></td>
        </tr>
        <tr>
            <td><label>Sản phẩm đặc biệt</label><br />Có <input type="radio" name="dac_biet" value=1 <?php if($row['dac_biet'] == 1){echo "checked=checked";}?> /> Không <input type="radio" name="dac_biet" value=0 <?php if($row['dac_biet'] == 0){echo "checked=checked";}?> /></td>
        </tr>
        <tr>
            <td><label>Thông tin chi tiết sản phẩm</label><br /><textarea cols="60" rows="12" name="chi_tiet_sp"><?php if(isset($_POST['chi_tiet_sp'])){echo $_POST['chi_tiet_sp'];}else{echo $row['chi_tiet_sp'];}?></textarea> <?php if(isset($error_chi_tiet_sp)){echo $error_chi_tiet_sp;}?></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Cập nhật" /> <input type="reset" name="reset" value="Làm mới" /></td>
        </tr>
    </table>
    </form>
</div>