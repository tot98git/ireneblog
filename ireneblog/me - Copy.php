<!DOCTYPE html>
<html>
<head>
	<title>Me</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="mestili.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Source+Sans+Pro|Indie+Flower|Shadows+Into+Light|Lora|Bellefair|Playfair+Display+SC|Arapey" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
</head>
<body>
	<header>
			<nav>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="work.php">Work</a></li>
					<li>Me</li>
				</ul>
			</nav>
		</header>
		<section>
			<div class="main">
				<div class="img-container">
					<?php include('dbconfig.php');
					$row=mysqli_fetch_array(mysqli_query($conn,"Select iname from images inner join posts on images.pid=posts.pid where ptag='me'"));
					echo "<img src='images/".$row['iname']."'>";
					?>
					</div>
				<div class="main-content">
					<h1>This is me</h1>
					<div><?php 
					$row=mysqli_fetch_array(mysqli_query($conn,"Select ppost,excerpt from posts where ptag='me'"));
					echo $row['excerpt'].
					"      ".
					$row['ppost'];

					?></div>
					<div class='soc-list'>
						<i class="fa fa-facebook"></i>
						<i class="fa fa-twitter"></i>
						<i class="fa fa-instagram"></i>
					</div>
					<img src="https://pbs.twimg.com/media/DFhblZfXYAA92zO.jpg">
					<img src="https://pbs.twimg.com/media/DFhblZfXYAA92zO.jpg">
					<img src="https://pbs.twimg.com/media/DFhblZfXYAA92zO.jpg">
				</div>
			</div>
		</section>
		<script>
			window.onload=function(){
				$("#bars").click(function(){
					$("nav ul").toggleClass("menushow");
				});
			}
		</script>
</body>
</html>