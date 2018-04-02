<!DOCTYPE html>
<html>
<head>
	<title>Kycu</title>
	 <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	 <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

	<style type="text/css">
	body{
		background-color:white;
		overflow-x: hidden;
		margin:0;
	}
	form {
		position: relative;
		left:40%;
		top:200px;
		background-color: white;
		width:20%;
		border:2px solid #8796a1;
		overflow:hidden;
		text-align: center;
		font-family: 'Montserrat', sans-serif;
		padding:20px;
	}
	form input{
		margin-bottom:10px;
		font-size:140%;
		padding: 10px;
		transition: 1s;
		width: 99%;
		border: none;
		border-top:1px solid gray;
		box-sizing: border-box;
	}
	form h1{
		width: 100%;
		font-size:160%;
		color:#36a7f2;
}
	img{
		border-radius: 150px 150px;
		position: relative;
		top:200px;
		left:40%;
	}
	form input[type=submit]{
		background-color: #36a7f2;
		border:none;
		color: white;
	}
	form input[type=submit]:hover{
	background-color: rgb(67, 79, 99);
	cursor: pointer;
}
#modal-container{
	margin:0;
	position: absolute;
	z-index: 2;
	width:100%;
	height:100%;
	background-color: rgba(0,0,0,0.5);
	display:none;
	}
	@keyframes entr{
		0%{
			transform: scale(0);
		}
		100%{
			transform: scale(1);
		}
	}
	#modal{
		position: absolute;
		z-index: 3;
		top:30%;
		left:30%;
		width:30%;
		height:30%;
		background-color: white;
		animation: entr 0.5s ease-in-out;
	}
	#permbajtja{
		position: absolute;
		left:12%;
		top:50px;
	}
	</style>

</head>
<body>
<script >
	$(document).ready(function(){			
	var user = "";
		var pass = "";
		var form = $('form');
		$(form).submit(function(event){
			event.preventDefault();
			var fdata=$(form).serialize();
			$.ajax({
				type:'POST',
				url: $(form).attr('action'),
				data:fdata
			})
			.done(function(response){
				alert(response);
				if(response=="Jeni lidhur me sukses :)"){
		           window.location="manage.php";
				}
			})
			.fail(function(data){
				$("form input[type=username]").css("border","4px solid red");
			})
		});
	});
</script>
	<div id="modal-container">
		<div id="modal">
			<span style="position: absolute;
		right:4%;
		border:2px solid black;
		padding:2px;
		top:2px;">X</span>
			<span id="permbajtja">Testing</span>
		</div>
	</div>
	<form action="login_page.php" method="POST">
		<h1>Moduli per administrim</h1>
		<input type="username" placeholder="Shkruani emrin e perdoruesit" name="username"><br>
		<input type="password" placeholder="Shkruani fjalekalimin" name="fjalekalimi"><br>
		<input type="submit" value="Kycu!" name="submit" id="btnsubmit">
	</form>
</body>
</html>