<?php echo "
	<div class='gradient'>
	</div>";
	 include('dbconfig.php');
	 if(isset($_GET['name'])){
	 	$name=$_GET['name'];
	 	$query = mysqli_query($conn,"Select posts.pname,posts.ppost,posts.excerpt,images.iname from posts inner join images on posts.pid=images.pid where posts.pname='$name'");
	 	while($row=mysqli_fetch_array($query)){
	 		echo "
	<div id='content'>
		<span> Art </span>
		<img id='img-select' src='images/".$row['iname']."'>
		<h1>".$row['pname']."</h1>
		<span><i class='fa fa-ellipsis-h fa-3x'></i></span>
		<div class='art-info'>	
			<span><i class='fa fa-arrows-alt'></i>70x90</span>
			<span><i class='fa fa-paint-brush'></i>Acrylico</span>
			<ul>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
		<p>".$row['excerpt']." </p>
		<div class='post'>".$row['ppost']."
		</div>
		
	</div>";
}
}
?>
