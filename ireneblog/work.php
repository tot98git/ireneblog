<!DOCTYPE html>
<html>
<head>
	<title>Ireneblog - Work</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/png" href="/favicon.png"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name='description' content="Irene's personal art-sharing blog">
	<link rel="stylesheet" href="ireneworkstili.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans|Source+Sans+Pro|Indie+Flower|Shadows+Into+Light|Lora|Bellefair|Playfair+Display+SC|Arapey" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>

</head>
	<body>
		<div id='loading-bar'>
		</div>
		<div class='modal'>
		<button id='close'>X</button>
			<div>
			</div>
		</div>
		<header>
		<?php include('dbconfig.php');
			?>
			<nav>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="work.php">Work</a></li>
					<li><a href='me.php'>Me</a></li>
				</ul>
			</nav>
			<div id='main-content'>
			<?php 
			$row=mysqli_fetch_array(mysqli_query($conn,"Select iname,pname,excerpt from images inner join posts on images.pid=posts.pid where ptag LIKE '%featured%' AND ptag LIKE '%art%' group by posts.pid DESC"));
					echo "<img src='images/".$row['iname']."'>
				<div>
					<h1>".$row['pname']."</h1>
					<p>".$row['excerpt']."</p>
					<button id='viewartbtn'> <b>View art</b></button>
				</div>";
			?>
			</div>
		</header>
		<section>
			<h1>Other art</h1>
			<div>
				<?php include('slider.php');?>
			</div>
		</section>
		<footer>
				<div class='footer-menu'>
					<ul>
						<li>Home</li>
						<li>Work</li>
						<li>Me</li>						
					</ul>
					<form>
						<input type="text" name="Search" placeholder="Search">
					</form>
				</div>
				
				<ul class='soc-list'>
					<li><i class="fa fa-facebook fa-2x"></i></li>
					<li><i class="fa fa-twitter fa-2x"></i></li>
					<li><i class="fa fa-instagram fa-2x"></i></li>
				</ul>
			</footer>
		<script>
				window.onload=function(){$(document).on("click",".pages ul li",function(){var e=$(".pages ul li").index(this)+1;$.ajax({type:"GET",url:"slider.php?page="+e,datatype:"html",success:function(e){$("section").children("div").html(e)}})}),$("#viewartbtn").click(function(){var e=$(this).siblings("h1").html();$.ajax({type:"GET",url:"art.php?name="+e,datatype:"html",success:function(e){$(".modal").children("div").html(e),$(".modal").css("display","block"),$.getScript("Vibrant.js",function(){"use strict";function e(){a=!0;var e=new Vibrant(n),i=e.swatches();new DocumentFragment;for(var c in i)i.hasOwnProperty(c)&&i[c]&&($(".art-info ul li").eq(t).css("background-color",i[c].getHex()),$(".art-info ul li").eq(t).attr("title",i[c].getHex()),t++);var o="linear-gradient(to bottom right,"+i[Object.keys(i)[1]].getHex()+","+i[Object.keys(i)[2]].getHex()+","+i[Object.keys(i)[3]].getHex()+","+i[Object.keys(i)[4]].getHex()+")";$(".gradient").css("background-image",o)}var t=0,n=document.getElementById("img-select"),a=(document.querySelector(".colors"),document.querySelector(".colors-section"),!1);n.addEventListener("load",function(){a||e()}),a||e()})}})}),$(document).on("click",".art-link",function(){$("#loading-bar").css("display","block"),$("#loading-bar").animate({width:"80%"});var e=$(this).siblings("h1").html();$.ajax({type:"GET",url:"art.php?name="+e,datatype:"html",success:function(e){$(".modal").children("div").html(e),$(".modal").css("display","block"),$.getScript("Vibrant.js",function(){"use strict";function e(){a=!0;var e=new Vibrant(n),i=e.swatches();new DocumentFragment;for(var c in i)i.hasOwnProperty(c)&&i[c]&&($(".art-info ul li").eq(t).css("background-color",i[c].getHex()),$(".art-info ul li").eq(t).attr("title",i[c].getHex()),t++);var o="linear-gradient(to bottom right,"+i[Object.keys(i)[1]].getHex()+","+i[Object.keys(i)[2]].getHex()+","+i[Object.keys(i)[3]].getHex()+","+i[Object.keys(i)[4]].getHex()+")";$(".gradient").css("background-image",o)}var t=0,n=document.getElementById("img-select"),a=(document.querySelector(".colors"),document.querySelector(".colors-section"),!1);n.addEventListener("load",function(){a||e()}),a||e()})},complete:function(){$("#loading-bar").animate({width:"100%"}),$("#loading-bar").delay(200).fadeOut(100)}})}),$("#close").click(function(){$(".modal").fadeOut(200),$(".modal").children("div").html(" ")})};	
		</script>
</body>
</html>