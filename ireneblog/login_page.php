<?php 
include('dbconfig.php');
if(isset($_SESSION['uprivilege'])){
	$_SESSION['uprivilege']="0";
}
if($_SERVER['REQUEST_METHOD']=='POST')
{
	session_start();
	$user = mysqli_escape_string($conn,$_POST['username']);
	$pass=mysqli_escape_string($conn,$_POST['fjalekalimi']);
	$query="Select * from users where uuser='$user' and upass='$pass'";
	$run=mysqli_query($conn,$query);
	$check=mysqli_num_rows($run);
	$row=mysqli_fetch_array($run);
	if($check>0){
				$_SESSION['uuser']=$_POST['username'];
		$_SESSION['uid']=$row['uid'];
		$_SESSION['uprivilege']=$row['uprivilege'];
		echo "Jeni lidhur me sukses :)";
	}
	else{
		echo "Keni shkruar konfidencialet gabim!";
	}
}



?>