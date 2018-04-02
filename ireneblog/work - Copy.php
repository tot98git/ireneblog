<!DOCTYPE html>
<html>
<head>
	<title>Ireneblog - Work</title>
	<meta charset="utf-8">
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
			window.onload=function(){
				$(document).on('click','.pages ul li',function(){
					var nr = $(".pages ul li").index(this)+1;
				$.ajax({
					type:'GET',
					url:'slider.php?page='+nr,
					datatype:'html',
					success:function(response){
						$("section").children("div").html(response);
					}
				})
			});
				$("#viewartbtn").click(function(){
					var name = $(this).siblings("h1").html();
					$.ajax({
					type:'GET',
					url:'art.php?name='+name,
					datatype:'html',
					success:function(response){
						$(".modal").children("div").html(response);
						$(".modal").css('display','block');					
						$.getScript("vibrant.js",function(){


						    		  'use strict';
							var nr = 0;
						    var img = document.getElementById('img-select'),
						        list = document.querySelector('.colors'),
						        section = document.querySelector('.colors-section'),
						        paletteReady = false;
						        
						    img.addEventListener('load', function() {
						        if ( !paletteReady )
						            getPalette();
						    });
						    
						    if (!paletteReady)
						        getPalette();
						    function getPalette() {
						        paletteReady = true;
						        var vibrant = new Vibrant(img),
						            swatches = vibrant.swatches(),
						            listFragment = new DocumentFragment();
						        	for(var swatch in swatches){
						        		  if (swatches.hasOwnProperty(swatch) && swatches[swatch]) { 
						        		$('.art-info ul li').eq(nr).css('background-color',swatches[swatch].getHex());
						        		 $('.art-info ul li').eq(nr).attr('title',swatches[swatch].getHex());
						        		nr++;
						        	}
						        	}
						        var gradient = "linear-gradient(to bottom right,"+swatches[Object.keys(swatches)[1]].getHex()+","+swatches[Object.keys(swatches)[2]].getHex()+","+swatches[Object.keys(swatches)[3]].getHex()+","+swatches[Object.keys(swatches)[4]].getHex()+")";

									$(".gradient").css("background-image",gradient);
						    }
						});

					}
				})
				});
				$(document).on('click','.art-link',function(){
						$("#loading-bar").css('display','block');
						$("#loading-bar").animate({width:"80%"});
						var name = $(this).siblings("h1").html();
						$.ajax({
					type:'GET',
					url:'art.php?name='+name,
					datatype:'html',
					success:function(response){
						$(".modal").children("div").html(response);
						$(".modal").css('display','block');					
						$.getScript("vibrant.js",function(){


						    		  'use strict';
							var nr = 0;
						    var img = document.getElementById('img-select'),
						        list = document.querySelector('.colors'),
						        section = document.querySelector('.colors-section'),
						        paletteReady = false;
						        
						    img.addEventListener('load', function() {
						        if ( !paletteReady )
						            getPalette();
						    });
						    
						    if (!paletteReady)
						        getPalette();
						    function getPalette() {
						        paletteReady = true;
						        var vibrant = new Vibrant(img),
						            swatches = vibrant.swatches(),
						            listFragment = new DocumentFragment();
						        	for(var swatch in swatches){
						        		  if (swatches.hasOwnProperty(swatch) && swatches[swatch]) { 
						        		$('.art-info ul li').eq(nr).css('background-color',swatches[swatch].getHex());
						        		 $('.art-info ul li').eq(nr).attr('title',swatches[swatch].getHex());
						        		nr++;
						        	}
						        	}
						        var gradient = "linear-gradient(to bottom right,"+swatches[Object.keys(swatches)[1]].getHex()+","+swatches[Object.keys(swatches)[2]].getHex()+","+swatches[Object.keys(swatches)[3]].getHex()+","+swatches[Object.keys(swatches)[4]].getHex()+")";

									$(".gradient").css("background-image",gradient);
						    }
						});

					},
					complete:function(){
					$("#loading-bar").animate({width:"100%"});
					$("#loading-bar").delay(200).fadeOut(100);
				}
				})

				});
				$("#close").click(function(){
					$('.modal').fadeOut(200);
					$(".modal").children("div").html(" ");
				})
				// Vibrant 


			}
		</script>
</body>
</html>