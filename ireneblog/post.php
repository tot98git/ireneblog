
<html>
	<head>
		<title>This is irene's blog</title>
		<meta charset="utf-8">
		<meta name="viewport" contet="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="poststili.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans|Source+Sans+Pro|Bellefair|Lora" rel="stylesheet">
		    <script src="vibrant.js"></script>

	</head>
	<script type="text/javascript">
		window.onload=function(){
			  'use strict';
    var headerTitle = document.getElementById("titulli");
    var authinfo = document.getElementById("auth-info");
    var img = document.querySelector('img'),
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
        
        for ( var swatch in swatches ) {
            if (swatches.hasOwnProperty(swatch) && swatches[swatch]) { 
                console.log(swatch, swatches[swatch].getHex());
                var li = document.createElement('li'),
                    small = document.createElement('small');
                
                li.style.backgroundColor = swatches[swatch].getHex();
                li.appendChild(small);
                listFragment.appendChild(li);
                headerTitle.style.borderBottom="2px dotted"+swatches[swatch].getHex();
                authinfo.style.color=swatches[swatch].getHex();
            }
        }
        console.log(swatches[Object.keys(swatches)[1]].getHex());	
        list.appendChild(listFragment);
        
    }
		}
	</script>
	<body>
		<header>
			<?php include('dbconfig.php');
			$id=$_GET['id'];

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
		<div id="imgheader">
		<?php $run=mysqli_query($conn,"Select p.pauthor,p.pname,p.ppost,i.iname from posts p INNER JOIN images i on p.pid=i.pid where p.pid='$id' ");
		$row=mysqli_fetch_array($run);
		$run2=mysqli_query($conn,"Select uuser from users where uid='".$row['pauthor']."'");
		$row2=mysqli_fetch_array($run2);
		echo"

			<div id='overlay'></div>
			<img src='images/".$row['iname']."'>".		
			"<h1 id='titulli'>".$row['pname']."</h1>.
			<p id='auth-info'> Written by ".$row2['uuser']."</p>"."
			<div class='colors-section'><ul class='colors'></ul></div>
			".
		"</div>
		<div class='share'><a href='https://twitter.com/share' class='twitter-share-button' data-show-count='false'>Tweet</a><script async src='//platform.twitter.com/widgets.js' charset='utf-8'></script>
		<iframe src='https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button_count&size=small&mobile_iframe=true&width=88&height=20&appId'  style='border:none;overflow:hidden' scrolling='no' frameborder='0' allowTransparency='true'></iframe></div>
		<section>
		".$row['ppost']."
		</section>";
		?>
		<div class="more">
		<h1>More art</h1>
		<?php 
		$morequery = mysqli_query($conn,"Select p.pname,i.iname from posts p INNER JOIN images i on p.pid=i.pid where ptag='art' LIMIT 4");
		while($row=mysqli_fetch_array($morequery)){
			echo "
		<div class='more-item'>
			<h1>".$row['pname']."</h1>
			<img src='images/".$row['iname']."'>
		</div>";
	}
		?>
		</div>
	</body>
</html>