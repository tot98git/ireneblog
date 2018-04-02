<?php 
include('dbconfig.php');
$id ="";
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$query = mysqli_query($conn,"Delete from posts where pid='$id'");
	mysqli_query($conn,"Delete from images where pid='$id'");
}
?>