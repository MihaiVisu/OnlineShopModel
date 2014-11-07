<?php
	require "test.php";
	$res = mysql_query("SELECT * FROM comanda WHERE ID='$_GET[id]' ");
	if(mysql_num_rows($res)==0)
	{
		echo '<div class="main_shadow"><div class="main_div" align="center">';
		die("<h1>Nu exista aceasta comanda</h1>");
		echo '</div></div>';
	}
	$comanda = mysql_fetch_array($res);
?>
<div class="main_shadow">
		<div class="main_div">
			<div id="leftdiv_title">
				<h2 align="center" style="color:white; font-family:Helvetica; line-height:50%;">Comanda <?php echo $_GET['id'];?> </h2>
				<hr>
			</div>
			<br>
			<table width="90%" cellpadding="5">
				<tr>
					<td align="right" width="40%">
						User:
					</td>
					<td>
						<?php
							$user = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE ID = '$comanda[USER_ID]' "));
						?>
							<a href = "vizualizare_user?id=<?php echo $user['ID']; ?>"> <?php echo $user['USERNAME'] ?></a>							
					</td>
				</tr>			
				<tr>
					<td align="right">
						Data:
					</td>
					<td>
						<?php echo $comanda['DATETIME'];?>					
					</td>
				</tr>
				<tr>
					<td align="right">
						Suma de plata:
					</td>
					<td>
						<?php echo $comanda['SUMA'];?>	
						LEI
					</td>
				</tr>
				<tr>
					<td align="right">
						Status:
					</td>
					<td >
						<?php
						if($comanda['STATUS']==1)
							echo "In curs de procesare";
						if($comanda['STATUS']==2)
							echo "In curs de livrare";
						if($comanda['STATUS']==3)
							echo "Livrata cu succes";
						if($comanda['STATUS']==4)
							echo "Anulata";
						?>
					</td>
				</tr>
				<tr>
					<td align="right">
						Obiecte comandate:
					</td>
					<td>
						<ul>
						<?php
						
						$result2 = mysql_query("SELECT * FROM obiect_comanda WHERE COMANDA_ID = '$comanda[ID]' ");
						while($row2 = mysql_fetch_array($result2))
						{
							echo "<li> ".$row2['CANTITATE']." x ";
							$row3 = mysql_fetch_array(mysql_query("SELECT * FROM obiect WHERE ID = '$row2[OBIECT_ID]' "));
							if($row3['ID']==NULL)
								echo $row2['NUME'];
							else
							{
							?>
							<a href = "detalii_obiect?obid=<?php echo $row2['OBIECT_ID'];?>">
								<?php echo $row3['NUME'];?>
							</a>
							<?php } ?>
							</li>
							<?php
						
						}
					
					?>
						</ul>
					</td>
				</tr>
			</table>
