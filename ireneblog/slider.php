<?php
	include('dbconfig.php');
	if(!isset($_GET['page'])){
						$page=1;
	}
	else{		
		$page=$_GET['page'];
	}
	$txt = "Select posts.pid,posts.pname,posts.excerpt,images.iname from posts inner join images on posts.pid=images.pid where ptag LIKE '%art%'";
	$res_num=mysqli_num_rows(mysqli_query($conn,$txt));
	$res_page = 6;
	$page_first_res=($page-1)*$res_page;
	$res = "";
	$txt.=" LIMIT ".$page_first_res.",".$res_page;
	$query = mysqli_query($conn,$txt);
	$num_page=ceil($res_num/$res_page);
	echo "<div id='grid'>";
	while($row=mysqli_fetch_array($query)){

		echo "<div class='grid-tile'>
				<img src='images/".$row['iname']."'>
					<div class='content'>				
						<h1>".$row['pname']."</h1>
						<h3 class='art-link'>View art</h3>
					</div>
			</div>	";
	}

	echo "</div>
	<div class='pages'>
	<ul>";
	for($i=1;$i<=$num_page;$i++){
		if($i==$page){
		echo "<li class='active'><span>".$i."</span></li>";
		}
		else{
			echo "<li><span>".$i."</span></li>";
		}
		
	}
	echo "</ul>
	</div>
	";
?>