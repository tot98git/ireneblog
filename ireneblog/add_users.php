<?php  include('dbconfig.php');
session_start();
if($_SESSION['uprivilege']==''){
	header("Location:login.php");
}
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$emri = $_POST['emri'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$pozita = $_POST['pozita']=="Admin"?"1":"0";
		if(mysqli_query($conn,"INSERT into users(uuser,uemail,upass,uprivilege) VALUES('".$emri."','".$email."','".$pass."','".$pozita."')")){
			echo "Done";
		}
		else{
			echo "Mhmmm bug";
		}

	}
?>