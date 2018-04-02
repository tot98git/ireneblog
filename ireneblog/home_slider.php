<?php
	include('dbconfig.php');
	if(!isset($_GET['page'])){
						$page=1;
	}
	else{		
		$page=$_GET['page'];
	}
	$txt = "Select posts.pid,posts.pname,posts.excerpt,posts.pdate,images.iname,users.uuser from posts left join images on posts.pid=images.pid left join users on posts.pauthor = users.uid where ptag like '%featured%' group by posts.pid DESC";
	$res_num=mysqli_num_rows(mysqli_query($conn,$txt));
	$res_page = 1;
	$page_first_res=($page-1)*$res_page;
	$res = "";
	$txt.=" LIMIT ".$page_first_res.",".$res_page;
	$query = mysqli_query($conn,$txt);
	$num_page=ceil($res_num/$res_page);
	while($row=mysqli_fetch_array($query)){
		$date = explode(" ",$row['pdate']);
		echo "<div class='slider-block'>
				<img src='images/".$row['iname']."'>
				<div class='content-block'>
					<h1>".$row['pname']."</h1>
					<div>".$row['excerpt']."</div>
					<span>By ".$row['uuser']."<i class='fa fa-ellipsis-h'></i>  ".$date[0]." </span>
				</div>
			</div>	";
	}
?>