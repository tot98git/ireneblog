<html>
	<head>
		<title>This is irene's blog</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name='description' content="Irene Borinca, also known by twitter handle cliterally and in instagram ireneboringca, shares personal art in this blog">
		<link rel="stylesheet" href="irenestili.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans|Source+Sans+Pro|Indie+Flower|Shadows+Into+Light|Lora|Bellefair|Playfair+Display+SC|Arapey|Bad+Script|Great+Vibes|Satisfy" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	</head>
	<body>
	<script type="text/javascript">
	window.onload=function(){
		$(".footer-menu > form > input").keyup(function(){
			$("#search").css('display','block');
			$("#search > form >input").val($(this).val());
			$("#search > form >input").focus();
			var q = $(this).val();
			$.ajax({
				type:'GET',
				url:'search.php?q='+q,
				dataType: 'html',
				success:function(response){
					$(".result-grid	").html(response);
				}
			})
			$(this).fadeOut(200);
		});
		var activated = false;
		$("#search > form > input").keyup(function(){
			var q = $(this).val();
			$("#loading-bar").css('display','block');
			$("#loading-bar").animate({width:"80%"});
			$("#search > form > input").css('height',"80px");
			$("#search > form > input").css('font-size',"220%");
			$(".result-grid").css('top',"100px");
			$.ajax({
				type:'GET',
				url:'search.php?q='+q,
				dataType: 'html',
				success:function(response){
					$(".result-grid	").html(response);
				}	,
				complete:function(){
					$("#loading-bar").animate({width:"100%"});
					$("#loading-bar").delay(200).fadeOut(100);
				}
				
			});
		});
		$("#search > form > input").hover(function(){
			$("#search > form > input").animate({height:"80px"});
			$("#search > form > input").animate({fontSize:"220%"});
			$(".result-grid").animate({top:"100px"});
		});
		$("#search > .result-grid").delay(1000).hover(function(){
			$("#search > form > input").animate({height:"20px"});
			$("#search > form > input").animate({fontSize:"100%"});
			$(".result-grid").animate({top:"25px"});
		});
		var page = 1;
		$("#btnprev").click(function(){
			slideCall(-1);
			console.log(page);
		});
		$("#btnnext").click(function(){
			slideCall(+1);
		})
		function slideCall(m){

			page=page>5||(page==1&&m==-1)?1:page+m;
				$.ajax({
				type:'GET',
				url:'home_slider.php?page='+page,
				dataType: 'html',
				success:function(response){
					$(".slider-block").remove();
					$(".slider").append(response);
				}
			})
		}

	}
	</script>
		<header>
			<?php include('dbconfig.php');
	?>
			<div id="gradient">
			</div>
			<nav>
				<ul>
					<li><a href="index.php">Home</a>	
					</li>
					<li><a href="work.php">Work</a></li>
					<li><a href="me.html">Me</a></li>
				</ul>
			</nav>
		</header>

		<section>	
			<div id='search'>
				<div id='loading-bar'>
				</div>
				<form>
					<input type="text" name='search' placeholder="Search">
				</form>
				<div class='result-grid'>
				</div>	
				<div class='search-pages'>
					<ul>
						<li>1</li>
						<li id="selected">2</li>
						<li>3</li>
						<li>4</li>	
					</ul>
				</div>
				
			</div>
			<div class="slider">
			<div class='slide-nav'>
				<button id='btnprev'>
					<i class="fa fa-long-arrow-left fa-2x"></i>
				</button>
				<button id='btnnext'>
					<i class="fa fa-long-arrow-right fa-2x"></i>
				</button>
			</div>
			<div class='share-coll'>
				<span>
					<i class="fa fa-facebook fa-2x"></i>
					<i class='fa fa-twitter fa-2x'></i>
				</span>
			</div>
				<?php include('home_slider.php'); ?>
			</div>

			<div class='art-section'>
			<?php 
			$query = (mysqli_query($conn,"Select iname,pname from images inner join posts on images.pid=posts.pid where ptag='art' LIMIT 3"));
			while($row=mysqli_fetch_array($query)){
				echo "
				<div class='img-container'>
					<h1>".$row['pname']."</h1>
					<img src='images/".$row['iname']."'>
				</div>";
			}
			?>
			</div>	
			<div id='instagram-section'>			
				<img src="https://pbs.twimg.com/media/DFhblZfXYAA92zO.jpg">
				<img src="https://pbs.twimg.com/media/DFhblZfXYAA92zO.jpg">
				<div class="text-content">
					<h1> My insta feed </h1>
					<h3> Be yourself! Everyone else is already taken! </h3>
				</div>
				<div class='grid'>
					<img src="https://pbs.twimg.com/media/DFhblZfXYAA92zO.jpg">
					<img src="https://pbs.twimg.com/media/DFhblZfXYAA92zO.jpg">
					<img src="https://pbs.twimg.com/media/DFhblZfXYAA92zO.jpg">
				</div>
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
				<div class='copyright'>
					Made with <span>  </span> by <strong>Toti</strong>
				</div>
				<ul class='soc-list'>
					<li><i class="fa fa-facebook fa-2x"></i></li>
					<li><i class="fa fa-twitter fa-2x"></i></li>
					<li><i class="fa fa-instagram fa-2x"></i></li>
				</ul>
			</footer>
	</body>
</html>