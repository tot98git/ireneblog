<!DOCTYPE html>
<html>
<head>
	<title>Menaxho permbajtjen</title>
	<link rel="stylesheet" href="manage_post.css" type="text/css">
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
if(isset($_POST['posto'])||isset($_POST['ruaj']))
{
	$pub = 0;
	if(isset($_POST['posto']))
	{
		$pub=1;
	}
	else if(isset($_POST['ruaj'])){
		$pub=0;
	}
	$titulli=$_POST['titulli'];
	$tags=$_POST['tag'];
	$content=$_POST['editor'];
	$excerpt = $_POST['excerpt'];
	$date = date("Y-m-d", strtotime($_POST['koha']));

		
	if(!$_FILES['image']['size']==0)
	{
	$target="images/".basename($_FILES['image']['name']);
	$file=$_FILES['image'];
	$fileName=$_FILES['image']['name'];
	$fileTmpName=$_FILES['image']['tmp_name'];
	$fileSize=$_FILES['image']['size'];
	$fileError=$_FILES['image']['error'];
			if($fileError==0){
				
				if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
					
					echo "Imazhi u ngarkua me sukses.";
						if(mysqli_query($conn,"INSERT INTO posts(pname,ppost,ptag,pauthor,pdate,excerpt,published) VALUES('".$titulli."','".$content."','".$tags."','".$_SESSION['uid']."','".$date."','".$excerpt."',".$pub.")")){
								$id=mysqli_insert_id($conn);
								$sql= "INSERT INTO images(iname,isize,pid) values('$fileName','$fileSize','$id')";
								mysqli_query($conn,$sql);
								if(!empty($_POST['Permasat'])||!empty($_POST['Materiali'])){
									echo "Not empty";
									mysqli_query($conn,"INSERT INTO art(aid,materiali,permasat) VALUES('".$id."','".$_POST['Materiali']."','".$_POST['Permasat']."')");
								}

						}

				}
				else{
					if(!is_writable($target)){
						echo "Nuk eshte writable!";
					}
					echo $_FILES['image']['tmp_name']." ".$target;
				}
 		}
 		else{
 			echo "Nuk mund te uploadoni fajlle te tipit rrespektiv!!";
 		}
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
			<li><i class="fa fa-sliders fa-2x"></i></li>
		</ul>
	</div>
	<section>
		<div id="section-header">
				<h5><a href="manage.php">Postimet <i class="fa fa-pencil-square-o"></i></a></h5>
				<h1>Postimi i ri</h1>
		</div>	
		<form action="" method="POST" enctype="multipart/form-data">
			<input type='text' name='titulli' placeholder="Titulli i artikullit"><br>
			<input type='text' name='tag' style='width:20%;padding:2px;' placeholder="Tag:">
			<input type='date' name='koha' style='width:20%;padding:2px;'><br>
			<input type='file' name='image'><br>
			<textarea name="excerpt" maxlength="500" placeholder="Pershkrimi i shkurter i artikullit"></textarea>
			<h5 id='char-count'>Edhe 500 karaktere te mbetura</h5>
			<textarea class='ckeditor' style='width:95%;' name='editor'></textarea>
			<input type='submit' name='posto' value='Publiko!'><input type="submit" name="ruaj" value="Ruaj">
		</form>
	</section>
	<script>
		window.onload=function(){
			var cnt = 500;

			$("form textarea[name='excerpt']").keyup(function(){
				$("#char-count").html(cnt-$(this).val().length +" karaktere te mbetura");
				if(cnt==0){
					$(this).attr('disabled');
					$("#charAtPosition-count").css('color:red');
				}
			});
				$("header>i").click(function(){
				$("#user-info").toggle(200);
			});
			var checkTitle=false;
			$("form input[name='titulli']").keyup(function(){
				if(checkTitle==false && $(this).val().length>'45'){
					$(this).css('border-bottom-color','maroon');
					$(this).after("<p class='title-error'>Titulli tejkalon numrin e karaktereve te lejuara");
					checkTitle=true;
				}
				else if(checkTitle==true && $(this).val().length<'45'){
					$("p").remove(".title-error");
					$(this).css('border-bottom-color','gray');
					checkTitle=false;

				}
			});
			var checkTag = false;
			var shown = false;
			$("form input[name='tag']").keyup(function(){
				if(checkTag==false && $(this).val().length>'20'){
					$(this).css('border-bottom-color','maroon');
					$(this).after("<p class='title-error'>Tag-u tejkalon numrin e karaktereve te lejuara");
					checkTag=true;
				}
				else if(checkTag==true && $(this).val().length<'20'){
					$(this).css('border-bottom-color','gray');
					$("p").remove(".title-error");
					checkTag=false;

				}
				if($(this).val().toLowerCase().match('art') && shown==false){
					$(this).after("<input type='text' name='Permasat' placeholder='Permasat' style='width:10%;margin-left:10px;'/> <input type='text' name='Materiali' placeholder='Materiali' style='width:10%;margin-left:10px;'>");
					shown=true;
				}
				if(!($(this).val().toLowerCase().match('art'))){
					$("form input[name='Permasat']").remove();
					$("form input[name='Materiali']").remove();
					shown=false;
					}
				if(!$(this).val().toLowerCase().match('instagram'))	{
						$("form textarea[name='excerpt']").attr("placeholder","Pershkrimi i shkurter i artikullit.");
							$("#cke_editor").fadeIn(50);
				}
				if($(this).val().toLowerCase().match('instagram') && shown==false){
					$("form textarea[name='excerpt']").attr("placeholder","Shto linkun e fotos ne instagram");
					$("#cke_editor").fadeOut(50);
				}
			});


		}
	</script>
</body>
</html>
