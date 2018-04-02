	<!DOCTYPE html>
<html>
<head>
	<title>Menaxho permbajtjen</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	<link rel="stylesheet" href="manage.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Slabo+27px|Open+Sans" rel="stylesheet">
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
</head>
<?php include('dbconfig.php');
session_start();
if($_SESSION['uprivilege']==''){
	header("Location:login.php");
}
$txt="Select posts.published,posts.pid,posts.pname,posts.pauthor,posts.ptag,posts.pdate,users.uuser from posts inner join users on posts.pauthor=users.uid";
if(isset($_GET['Kerko'])){
	if($_GET['lloji']!="all"){
		$txt.=" WHERE ptag='".$_GET['lloji']."'";
	}
	if($_GET['autori']!="Te gjithe"){
		$txt.=" AND uuser='".$_GET['autori']."'";
	} 

	if($_GET['gjendja']=="Publikuara"){
		$txt.=" AND posts.published=1";
	}
	if($_GET['gjendja']=="Te Papublikuara"){
		$txt.=" AND posts.published=0";
	}
	if($_GET['Koha']=='Me te vjetrat'){
		$txt.=" ORDER BY posts.pid ASC";
	}
	if($_GET['Koha']=='Me te rejat'){
		$txt.=" ORDER BY posts.pid DESC";
	}
}
?>
<body>
	<header>
		<h1 style="font-family: 'Roboto',sans-serif;">Irene blog</h1>
		<i class="fa fa-user-o fa-2x"></i>
		<div id="user-info">
			<h1>Pershendetje, <?php echo $_SESSION['uuser'];?></h1>
			<h1>Menaxho llogarine</h1>
			<h1><a href="logout.php"> C kycuni</a></h1>
		</div>
	</header>
	<div class="admin">
		<ul>
			<li class="active"><i class="fa fa-file-text fa-2x"></i></li>
			<li><i class="fa fa-picture-o fa-2x"></i></li>
			<li><a href="manage_users.php"><i class="fa fa-users fa-2x"></i></a></li>
			<li><a href="settings.php"><i class="fa fa-sliders fa-2x"></i></a></li>
		</ul>
	</div>
	<section>
		<form action="" method="GET"> 
			<label>Lloji i artikullit:</label>
			<select name="lloji">
				<option value="all">
					Te gjitha
				</option>
				<?php $query = mysqli_query($conn,"Select DISTINCT ptag from posts Group by ptag");
				while($row=mysqli_fetch_array($query)){
					echo "<option>".$row['ptag']."</option>";
				}

				?>
			</select>
			<label>Autori:</label>
			<select name="autori">
			<option>Te gjithe</option>
				<?php 
				$query3 = mysqli_query($conn,"Select uuser from users");
				while($row=mysqli_fetch_array($query3)){
					echo "<option>".$row['uuser']."</option>";
				}
				?>
			</select>
			<label>Koha: </label>
			<select name="Koha">

				<option>Me te rejat</option>
				<option>Me te vjetrat</option>
			</select>
			<label>Gjendja:</label>
			<select name="gjendja">
				<option>Te gjitha</option>
				<option>Publikuara</option>
				<option>Te papublikuara</option>
			</select>
			<input type="submit" name="Kerko" value="Kerko">
			<a href="new_post.php"><i class="fa fa-pencil-square-o fa-2x"></i><span>Postim i ri</span></a>
			</form>
		<div class="post-container">
			<?php include('manage_advanced.php');?>
		</div>
		<div id="mode">
			<form>
				<input type="radio" name="mode" value="Classic"><label for="mode"> Classic</label>
				<input type="radio" name="mode" value="Modern" selected><label for="mode"> Modern</label>
			</form>
		</div>
	</section>
	<script>
		window.onload=function(){
			$("#mode form input").click(function(){
				var mode = $(this).attr('value');
				if(mode=='Classic'){
				$.ajax({
					type:'GET',
				url:'manage_classic.php',
				dataType:"html",
				success:function(response){
					$(".post-container").html(response);
				}

				})
			}
			else if(mode=='Modern'){
				$.ajax({
					type:'GET',
				url:'manage_advanced.php?',
				dataType:"html",
				success:function(response){
					$(".post-container").html(response);
				}

				})
			}
			});
				function callAjax(id){
				if(confirm("A jeni te sigurt per kete veprim?")){				
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange=function(){
					if(xhttp.readyState==4&&xhttp.status==200){
						alert("Postimi u fshi!");
						location.reload();
					}	
				};
				xhttp.open("GET","delete.php?id="+id,true);
				xhttp.send();
			}
			}
			$("header>i").click(function(){
				$("#user-info").toggle(200);
			});
			$(".enabled-del").click(function(){
				var pid=$(this).siblings('h1').html();
				callAjax(pid);

			});
			$(".delete-col").click(function(){
				pid=$(this).siblings('.id-col').html();
				callAjax(pid);	
			});
		
	}
	</script>
</body>
</html>