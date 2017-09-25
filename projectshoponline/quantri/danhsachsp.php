<script language="javascript">
function xoaSanpham(){
	var conf = confirm('Bạn chắc chắn muốn xóa sản phẩm này không?');
	return conf;	
}
</script>
<?php
// Nhận biến Page(Số thứ tự của Trang)
if(isset($_GET['page'])){
	$page = $_GET['page'];	
}
else{
	$page = 1;	
}

// Hiển thị số Sản phẩm trên một trang
$rowsPerPage = 10;

// Tính vị trí mẩu tin đầu tiên của mỗi trang
$firstRow = $page*$rowsPerPage - $rowsPerPage;

// Liệt kê Danh sách dữ liệu trên mỗi trang
$sql = "SELECT * FROM sanpham
				 INNER JOIN dmsanpham
				 ON sanpham.id_dm = dmsanpham.id_dm  
				 ORDER BY id_sp DESC
				 LIMIT $firstRow, $rowsPerPage";
$query = mysqli_query($dbConnect,$sql);

// Tổng số Sản phẩm trong CSDL
$totalRow = mysqli_num_rows(mysqli_query($dbConnect,"SELECT * FROM sanpham"));

// Tính tổng số trang
$totalPage = ceil($totalRow/$rowsPerPage);

// Tạo Thanh phân trang
$listPage = '';
for($i=1; $i <= $totalPage; $i++){
		
		if($i == $page){
			$listPage .= '<span>'.$i.'</span> ';	
		}
		else{
			$listPage .= '<a href="'.$_SERVER['PHP_SELF'].'?page_layout=danhsachsp&page='.$i.'">'.$i.'</a> ';	
		}	
}
?>
<h2>quản lý sản phẩm</h2>
<div id="main">
    <p id="add-prd"><a href="quantri.php?page_layout=themsp"><span>thêm sản phẩm mới</span></a></p>
    <table id="prds" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr id="prd-bar">
            <td width="5%">ID</td>
            <td width="40%">Tên sản phẩm</td>
            <td width="15%">Giá</td>
            <td width="20%">Nhà cung cấp</td>
            <td width="10%">Ảnh mô tả</td>
            <td width="5%">Sửa</td>
            <td width="5%">Xóa</td>
        </tr>
<?php while($row = mysqli_fetch_array($query)){?>        
        <tr>
            <td><span><?php echo $row['id_sp'];?></span></td>
            <td class="l5"><a href="quantri.php?page_layout=suasp&id_sp=<?php echo $row['id_sp'];?>"><?php echo $row['ten_sp'];?></a></td>
            <td class="l5"><span class="price"><?php echo $row['gia_sp'];?></span></td>
            <td class="l5"><?php echo $row['ten_dm'];?></td>
            <td><span class="thumb"><img width="60" src="anh/<?php echo $row['anh_sp'];?>" /></span></td>
            <td><a href="quantri.php?page_layout=suasp&id_sp=<?php echo $row['id_sp'];?>"><span>Sửa</span></a></td>
            <td><a onclick="return xoaSanpham();" href="xoasp.php?id_sp=<?php echo $row['id_sp'];?>"><span>Xóa</span></a></td>
        </tr>
<?php }?>        
    </table>
    <p id="pagination"><?php echo $listPage;?></p>
</div>