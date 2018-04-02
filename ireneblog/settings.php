<!DOCTYPE html>
<html>
<head>
	<title>Menaxho permbajtjen</title>
	<link rel="stylesheet" href="settings.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Slabo+27px|Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	<script src="ckeditor/ckeditor.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
</head>
<?php include('dbconfig.php');
session_start();
$id="";
if($_SESSION['uprivilege']==''){
			header("Location:index.php");
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
			<li><i class="fa fa-sliders fa-2x"></i></li>
		</ul>
	</div>
	<section>
		<div id="section-header">
			<h5>Settings <i class="fa fa-cog"></i></h5>
			<h1>Menaxho te dhenat</h1>
			</div>	
		<div id="options">
			<form>
				<div class="radio-item">
					<input type="radio" name="settings-option" value="gen-info" checked="checked">
					<label for="settings-option"><i class="fa fa-info-circle fa-3x"></i></label>
				</div>
				<div class="radio-item">
					<input type="radio" name="settings-option" value='soc-info'>
					<label for="settings-option"><i class="fa fa-pencil-square-o fa-3x"></i></label>
				</div>
				<div class="radio-item">
					<input type="radio" name="settings-option">
					<label for="settings-option"><i class="fa fa-info-circle fa-3x"></i></label>
				</div>	
				<div class="radio-item">
					<input type="radio" name="settings-option" value='user'>
					<label for="settings-option"><i class="fa fa-user fa-3x"></i></label>
				</div>
			</form>
		</div>
		<div id="site-cred">	
		</div>
	</section>
</body>
<script>
	window.onload=function(){
		$(".radio-item input").click(function(){
			var name=$(this).attr('value');
			$.ajax({
				type:'GET',
				url:'settings_call.php?settings-option='+name,
				dataType:"html",
				success: function(response){
					$("#site-cred").html(response);
					$("#btn").click(function(){
					var len = $(".file-upload").length;
					$(this).prev().after("<br><input type='file' name='icon"+len+"'><input type='text' name='link' placeholder='Linku'>");

					});
				}
			});

		});
		$("header>i").click(function(){
			$("#user-info").toggle(200);
			});
		}

	
</script>
</html>
