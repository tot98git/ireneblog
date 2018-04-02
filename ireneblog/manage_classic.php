<table>
			<tr><th>Nr</th><th>Emri i artikullit</th><th>tags</th><th>Koha</th><th>Autori</th><th>Edit</th><th>Delete</th></tr>
			<?php 
			include('dbconfig.php');
			session_start();
			$txt="Select posts.published,posts.pid,posts.pname,posts.pauthor,posts.ptag,posts.pdate,users.uuser from posts inner join users on posts.pauthor=users.uid";
					if(isset($_GET['Kerko'])){
						if($_GET['lloji']!="all"){
							$txt.=" WHERE ptag='".$_GET['lloji']."'";
						}
						if($_GET['autori']!="Te gjithe"){
							$txt.=" AND uuser='".$_GET['autori']."'";
						} 

						if($_GET['gjendja']=="Publikuara"){
							$txt.=" AND posts.published=1";
						}
						if($_GET['gjendja']=="Te Papublikuara"){
							$txt.=" AND posts.published=0";
						}
						if($_GET['Koha']=='Me te vjetrat'){
							$txt.=" ORDER BY posts.pid ASC";
						}
						if($_GET['Koha']=='Me te rejat'){
							$txt.=" ORDER BY posts.pid DESC";
						}
					}
					$page=1;
					if(!isset($_GET['page'])){
						$page=1;
					}
					else{
						$page=$_GET['page'];
					}
					$res_num=mysqli_num_rows(mysqli_query($conn,$txt));
					$res_page = 20;
					$page_first_res=($page-1)*$res_page;
					$res = "";
					$pub="Not published";
					$txt.=" LIMIT ".$page_first_res.",".$res_page;
					$query = mysqli_query($conn,$txt);
					$num_page=ceil($res_num/$res_page);
					while($row=mysqli_fetch_array($query)){
						if($row['pauthor']==$_SESSION['uid'] OR $_SESSION['uprivilege']=='1'){
							$res="<a href=\"edit.php?id=$row[pid]\">Edit</a></td><td class='delete-col'>Delete</td>";
						}
						else{
							$res="Nuk keni privilegje";
						}

						echo "<tr><td class='id-col'>".$row['pid']."</td><td><b>".$row['pname']."</b></td><td>".$row['ptag']."</td><td style='text-align:center'>".$row['pdate']."</td><td>".$row['uuser']."</td><td class='edit'>".$res."</td></tr>";
					}
			 ?>
		</table>
		<div id="pages">
			<ul>
			<?php
				if(isset($_GET['Kerko'])){
					for($i=1;$i<=$num_page;$i++){
						echo "<li><a href='{$_SERVER['PHP_SELF']}?lloji=".str_replace(" ","+",$_REQUEST['lloji'])."&autori=".str_replace(" ","+",$_REQUEST['autori'])."&Koha=".str_replace(" ","+",$_REQUEST['Koha'])."&gjendja=".str_replace(" ","+",$_REQUEST['gjendja'])."&Kerko=Kerko&page=".$i."'>".$i."</a></li>";
					}
				}
				else{
					for($i=1;$i<=$num_page;$i++){
						echo "<li><a href='?page=".$i."'>".$i."</a></li>";
					}
				}
				?>
			</ul>
		</div>