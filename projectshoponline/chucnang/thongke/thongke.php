<?php 
	$url = 'chucnang/thongke/count_view.txt';
	$fo = fopen($url, 'r');
	$fread = fread($fo, filesize($url));
	fclose($fo);
	$fo = fopen($url, 'w+');
	fwrite($fo, ++$fread);
	fclose($fo);
	
?>
				<h2>thống kê truy cập</h2>
                <div id="counter">
                	<p>Hiện có <span><?php echo $fread?></span> người đang xem</p>
                </div>