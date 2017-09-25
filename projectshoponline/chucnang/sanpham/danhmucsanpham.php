<?php
	$sql = "SELECT * FROM dmsanpham";
	$query = mysqli_query($dbConnect,$sql);
?>
			<div class="l-sidebar">
            	<h2>hãng điện thoại</h2>
            	<ul id="main-menu">
					<?php
						while($cate = mysqli_fetch_array($query)){
					?>
                	<li><a href="index.php?page_layout=danhmucsp&id_dm=<?php echo $cate['id_dm']?>"><?php echo $cate['ten_dm']?></a></li>
					<?php } ?>
                </ul>
            </div>
