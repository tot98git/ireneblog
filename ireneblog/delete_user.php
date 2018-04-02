<?php 
include('dbconfig.php');
$id="";
	if(isset($_GET['id'])){
	$id = $_GET['id'];
	 if(!mysqli_query($conn,"Delete from users where uid='$id'")){
	 	echo "Something went wrong";
	 }
	}
?>