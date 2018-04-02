<!DOCTYPE html>
<html>
<head>
	<title>Me</title>
	<meta charset="utf-8">
	 <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
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
					<li><a href='me.php'>Me</a></li>
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
						<a href='https://facebook.com'><i class="fa fa-facebook"></i></a>
						<a href='https://twitter.com/otixj'><i class="fa fa-twitter"></i></a>
						<a href='https://instagram.com/tot98i'><i class="fa fa-instagram"></i></a>
					</div>
					<img src="https://pbs.twimg.com/profile_images/3625177108/6cdc82d7b02d46a4ca38d1a842ffa939.jpeg">
					<img src="https://media.licdn.com/mpr/mpr/shrinknp_200_200/AAEAAQAAAAAAAALTAAAAJDM4MWM0MGMwLWExMzctNDZjNS1hNmQzLTRmYTZlYzExNTViOA.jpg">
					<img src="https://scontent-sjc2-1.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/c0.134.1080.1080/14241088_304323546607567_124220859_n.jpg?ig_cache_key=MTMzMzM4MDM4Mzg1MjY4MzU3MQ%3D%3D.2.c">
				</div>
			</div>
		</section>
</body>
</html>