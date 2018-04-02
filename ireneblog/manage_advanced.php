	<?php 
			include('dbconfig.php');
			if (session_status() == PHP_SESSION_NONE) {
			    session_start();
			}
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
					$res_page = 5;
					$page_first_res=($page-1)*$res_page;
					$res = "";
					$txt.=" LIMIT ".$page_first_res.",".$res_page;
					$query = mysqli_query($conn,$txt);
					$num_page=ceil($res_num/$res_page);
					$pub="<h4 style='color:maroon'>Not published!</h4>";
					while($row=mysqli_fetch_array($query)){
						if($row['pauthor']==$_SESSION['uid'] OR $_SESSION['uprivilege']=='1'){
							$res="<i class='fa fa-trash fa-4x enabled-del' title='Fshij postimin'></i>
									<a href='edit.php?id=".$row['pid']."'><i class='fa fa-pencil fa-4x enabled' title='Ndrysho postimin'></i></a>";
						}
						else{
							$res="<i class='fa fa-trash fa-4x'></i>
							<i class='fa fa-pencil fa-4x'></i>";
						}
						if($row['published']==1){
							$pub="<h4 style='color:green'>Published!</h4>";
						}
						$date = explode(" ",$row['pdate']);
						echo "<div class='post'>
							<h1>".$row['pid']."</h1>
							<div class='post-wrapper'>
								<h1>".$row['pname']."</h1>
								<div class='post-info'>
									<h4><i class='fa fa-user'></i> ".$row['uuser']."</h4>
									<h4><i class='fa fa-tag'></i> ".$row['ptag']."</h4>
									<h4><i class='fa fa-calendar'></i> ".$date[0]."</h4>
									".$pub."
								</div>
							</div>
							".$res."
						</div>";
					}
					echo "<div id='pages'>
			<ul>";
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
				echo "
			</ul>
		</div>";
				
?>