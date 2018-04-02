<!DOCTYPE html>
<html>
<head>
	<title>Menaxho permbajtjen</title>
	<link rel="stylesheet" href="manage_users_stili.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Slabo+27px|Open+Sans" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	<script src="jquery.js"></script>
</head>
<?php include('dbconfig.php');
session_start();
if($_SESSION['uprivilege']==''){
	header("Location:login.php");
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
		<div id="modal-container">
			<div id="result">
				<span>Perdoruesi u shtua me sukses!</span>
			</div>
			<div id="modal">
				<span id="modal-title"> Shtoni nje perdorues te ri </span>
				<span id="modal-close"> X</span>			
				<form action="add_users.php" method="POST"><label>Emri i perdoruesit:</label>
					<input type="text" name="emri"><br>
					<label>E-mail:</label>
					<input type="email" name="email"><br>
					<label>Fjalekalimi:</label>
					<input type="password" name="pass"><br>
					<label>Pozita:</label>
					<select name="pozita"><option>Admin</option>
					<option selected="selected">Moderator</option>
					</select><br>
					<input type="submit" name="dergo">
				</form>
			</div>
		</div>

	<section>
		<div id="section-header">
				<h5><a href="manage.php">Perdoruesit <i class="fa fa-pencil-square-o"></i></a></h5>
				<h1>Shtoni nje perdorues te ri</h1>
		</div>	
	<span id="newuser">Shtoni nje perdorues te ri!</span>
		<table>
			<tr><th>Nr</th><th>Emri i perdoruesit</th><th>E-mail</th><th>Pozita</th><th>Terhiq qasjen</th></tr>
			<?php 
								$query = mysqli_query($conn,"Select * from users");
					while($row=mysqli_fetch_array($query)){
						$privilege =$row['uprivilege'];
					switch($privilege){
						case 1: $privilege="admin";break;
						case '0': $privilege="moderator";break;
						default: $privilege="Kemi problem";
					}
						echo "<tr><td class='id-col'>".$row['uid']."</td><td>".$row['uuser']."</td><td>".$row['uemail']."</td><td style='text-align:center'>".$privilege."</td><td class='delete-col'>Fshij</td></tr>";
					}
					
			 ?>
		</table>
	</section>
	<script>
		window.onload=function(){
			var id = "";
			$(".delete-col").click(function(){
				id=$(this).siblings('.id-col').html();
				if(confirm("A jeni te sigurt per kete veprim?")){
				$.ajax({
					type:'GET',
					url:'delete_user.php?id='+id,
					dataType:"html",
					success:function(response){
						alert("Perdoruesit u fshi!");
						Location.reload();
					}
				})
				
		}
		});
		$("#newuser").click(function(){
			$("#modal-container").fadeIn(200);
		});
		$("#modal-close").click(function(){
			$("#modal-container").fadeOut(200);
		});
		var form = $('form');
		$(form).submit(function(event){
			$("#result span").html('');
			var ajaxReq;
			event.preventDefault();
			var values = $(this).serialize();
			ajaxReq = $.ajax({
				url: $(this).attr('action'),
				type:'POST',
				data:values
			})
			ajaxReq.done(function(response){
				$("#result").toggle();
				$("#result span").html(response);
			})
			ajaxReq.fail(function(){
				$("result").toggle();
				$("#result span").html("Something went wrong!");
			})
		});
		$("header>i").click(function(){
				$("#user-info").toggle(200);
			});
}
	</script>
</body>
</html>	