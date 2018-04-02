<?php
	include('dbconfig.php');
	if(isset($_GET['q'])){
		$search = $_GET['q'];
		$query = mysqli_query($conn,"Select posts.pname,images.iname,posts.pdate,posts.ptag from posts inner join images on posts.pid=images.pid where posts.pname LIKE '%".$search."%' OR posts.ptag LIKE '%".$search."' LIMIT 8");
		while($row=mysqli_fetch_array($query)){
			$date = explode(" ",$row['pdate']);
			echo "<div class='result-tile'>
						<img src='images/".$row['iname']."'>
						<h1>".$row['pname']."</h1>
						<span><i class='fa fa-calendar'></i>      ".$date[0]."    <i class='fa fa-tag'></i>     ".$row['ptag']."</span>
					</div>";
		}
	}
?>