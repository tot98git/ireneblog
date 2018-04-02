<!DOCTYPE html>
<html>
<head>
	<title>Menaxho permbajtjen</title>
	<link rel="stylesheet" href="manage_post.css" type="text/css">
	<script src="ckeditor/ckeditor.js"></script>
</head>
<?php include('dbconfig.php');
		$id = $_GET['id'];
		session_start();
		$rowquery = mysqli_query($conn,"Select pauthor from posts where pid='$id'");
		$row=mysqli_fetch_array($rowquery);
		if($row['pauthor']!=$_SESSION['uid'] AND $_SESSION['uprivilege']=='0' ){
			header("Location:manage.php");
		}
		else if($_SESSION['uprivilege']==''){
			header("Location:index.php");
		}
if(isset($_POST['posto']))
{
	if(!$_FILES['image']['size']==0)
	{
		$target='images/'.basename($_FILES['image']['name']);
	
	$file=$_FILES['image'];
	$fileName=$_FILES['image']['name'];
	$fileTmpName=$_FILES['image']['tmp_name'];
	$fileSize=$_FILES['image']['size'];
	$fileError=$_FILES['image']['error'];
			if($fileError==0){
				
				if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
					echo "Imazhi u ngarkua me sukses.";
					$sql= "INSERT INTO images(iname,isize,pid) values('$fileName','$fileSize','$id')";
				mysqli_query($conn,$sql);
				}
				else{
					echo "Ndodhi nje problem";
				}
 		}
 		else{
 			echo "Nuk mund te uploadoni fajlle te tipit rrespektiv!!";
 		}
 	}
	$titulli=$_POST['titulli'];
	$tags=$_POST['tag'];
	$content=$_POST['editor'];
		if(empty($titulli) || empty($tags) || empty($content)) {	
			if(empty($titulli)) {
			echo "<script>alert('Titulli nuk duhet te jete i zbrazet');</script>";
			}
		
		if(empty($tags)) {
			echo "<script>alert('Ju lutem etiketoni postimin tuaj.')";
		}
		
		if(empty($content)) {
			echo "<script>alert('Postimi duhet te kete permbajtje.')";
		}		
		}
		else {
			$update = mysqli_query($conn,"UPDATE posts SET pname='$titulli',ptag='$tags',ppost='$content' where pid='$id'");

		}

}?>
<body>
	<header>
		<h1>Irene blog</h1>
	</header>
	<div class="admin">
		<ul>
			<li>Postimet</li>
			<li>Imazhet</li>
			<li>Menaxhuesit e permbajtjes</li>
			<li>Te tjera</li>
		</ul>
	</div>
	<section>

	<form action="<?php echo "edit.php?id=".$id;?>" method="POST" enctype="multipart/form-data">
		<?php 
		$data = "";
		$query=mysqli_query($conn,"Select * from posts where pid='".$id."'");
		while($row=mysqli_fetch_array($query)){
			$data=$row['ppost']; 
			echo "
		<label>Titulli i artikullit: </label>
		<input type='text' name='titulli' value='".$row['pname']."'><br>
		<label>Tag: </label>
		<input type='text' name='tag' style='width:20%;padding:2px;' value='".$row['ptag']."'>
		<label>Koha e postimit:</label>
		<input type='date' name='koha' style='width:20%;padding:2px;'>
		<input type='file' name='image'><br>
		<textarea class='ckeditor' style='width:95%;' name='editor'>".$row['ppost']."</textarea>
		<input type='submit' name='posto' value='Posto!'>";}?>
	</form>
	</section>
	<script type="text/javascript">
		CKEDITOR.replace('editor');

	</script>
	</body>
	</html>