<?php 
include('dbconfig.php');
$txt="Select posts.pid,posts.pname,posts.pauthor,posts.ptag,posts.pdate,users.uuser from posts inner join users on posts.pauthor=users.uid";
if(isset($_SERVER['REQUEST_METHOD']=='GET'){
	if($_GET['lloji']=="featured"){
		$txt.=" WHERE ptag='featured'";
	}
	else if($_GET['lloji']=='blog'){
		$txt.=" WHERE ptag='blog'";
	}
	if($_GET['autori']!="Te gjithe"){
		$txt.=" AND uuser='".$_GET['autori']."'";
	}
}
?>