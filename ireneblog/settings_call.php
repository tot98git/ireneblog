<?php 

if(isset($_GET['settings-option'])){
	if($_GET['settings-option']=='gen-info'){
	echo "<form>
				<label>Titulli i websajtit: </label>
				<input type='text' name='titulli' placeholder='Titulli'><br>
				<label> Ikona: </label>
				<input type='file' name='ikona'><br>
				<label>Pershkrimi i websajtit: </label>
				<input type='text' name='pershkrimi' placeholder='Pershkrimi'><br>				
				<input type='submit' name='ruaj' value='Ruaj'>
			</form>";	
	}
	else if($_GET['settings-option']=='soc-info'){
	echo "		<form>
				<h3>Social icons </h3>
				<input type='file' name='icon1' class='file-upload'><input type='text' name='link' placeholder='Linku'><button id='btn' type='button'><i class='fa fa-plus'></i></button><br>
	</form>";
	}
	else if($_GET['settings-option']=='user'){
		echo "
			<form>
				<label> Emri i perdoruesit: </label>
				<input type='text' name='emri' placeholder='Username'><br>
				<label> E-mail: </label>
				<input type='text' name='email' placeholder='Email'><br>
				<label> Fjalekalimi: </label>
				<input type='password' name='fjalekalimi' placeholder='Fjalekalimi'><br>
				<input type='submit' name='ruaj' value='Ruaj'>

			</form>
		";
	}
}
?>