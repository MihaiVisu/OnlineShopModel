<?php
	require 'test.php';
	
	$id = $_GET['id'];
	
	$result = mysql_query("SELECT * FROM user WHERE ID = '$id' ");
	if(!mysql_num_rows($result))
	{
		$_SESSION['mesaj'] = "Nu exista acest user";
		header('Location: comenzi_in_asteptare.php');
		die();
	}
	
	$user = mysql_fetch_array($result);
	
?>
	

<div class="main_shadow">
		<div class="main_div">
			<div id="leftdiv_title">
				<h2 align="center" style="color:white; font-family:Helvetica; line-height:50%;"><?php echo $user['USERNAME'];?></h2>
				<hr>
			</div>
			
			<table width="90%" border="0" align="center">
				<tr>
					<td>
						Nume:
					</td>
					<td>
						<?php echo $user['NUME'];?>
					</td>
				</tr>
				<tr>
					<td>
						Prenume:
					</td>
					<td>
						<?php echo $user['PRENUME'];?>
					</td>
				</tr>
				<tr>
					<td>
						Email:
					</td>
					<td>
						<?php echo $user['EMAIL'];?>
					</td>
				</tr>
				<tr>
					<td>
						Telefon:
					</td>
					<td>
						<?php echo $user['NUMAR_TELEFON'];?>
					</td>
				</tr>
				<tr>
					<td>
						Adresa:
					</td>
					<td>
						<?php echo $user['ADRESA'];?>
					</td>
				</tr>
				<tr>
					<td>
						Cod postal:
					</td>
					<td>
						<?php echo $user['COD_POSTAL'];?>
					</td>
				</tr>
				
			
			
			
			</table>
			<br>
			<br>
</div>
	</div>
	<script>
		$(".main_shadow,.main_div,#leftdiv_title").corner("top");
		$("h3").corner();
	</script>
</body>

</html>	
