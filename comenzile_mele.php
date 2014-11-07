<?php
	require 'test.php';
	
	if($_SESSION['user'] == NULL)
	{
		$_SESSION['mesaj'] = "Nu ai destule permisiuni";
		header('Location: index.php');
		die();
	}
	
?>
<style>
	.main_div table
	{
		border: 2px solid black;
		border-collapse:collapse;
	}
	.main_div table td
	{
		border: 2px solid black;
	}
	.main_div table tr:first-child td
	{
		background:gray;
		font-family:arial;
		font-weight:bold;
	}
	.main_div table tr:hover
	{
		background:#CCFFCC;
	}
</style>
	<div class="main_shadow">
		<div class="main_div">
			<div id="leftdiv_title">
				<h2 align="center" style="color:white; font-family:Helvetica; line-height:50%;">Comenzile mele</h2>
				<hr>
			</div>
			<table align="center" width="95%">
		<tr align="center">
			<td>
				ID Comanda
			</td>
			<td>
				Data
			</td>
			<td>
				Obiecte Comandate
			</td>
			<td>
				Total de plata
			</td>
			<td>
				Status
			</td>
		</tr>
		<?php
			$result = mysql_query("SELECT * FROM comanda WHERE USER_ID='$_SESSION[user_id]' ");
			while($row = mysql_fetch_array($result))
		{
			?>
			<tr align="center">
				<td>
					<a href = "vizualizare_comanda.php?id=<?php echo $row['ID']; ?>">
					<?php 
						echo $row['ID']; 
					?>
					</a>
				</td>
				<td>
					<?php echo $row['DATETIME']; ?>
				</td>
				
				<td align="left"> 
					<ul>
					<?php
						
						$result2 = mysql_query("SELECT * FROM obiect_comanda WHERE COMANDA_ID = '$row[ID]' ");
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
				<td>
					<?php echo $row['SUMA']; ?>
				</td>
				<td>
					<?php
						if($row['STATUS']==1)
							echo "In curs de procesare";
						if($row['STATUS']==2)
							echo "In curs de livrare";
						if($row['STATUS']==3)
							echo "Livrata cu succes";
						if($row['STATUS']==4)
							echo "Anulata";
						?>
							
				</td>
							
			</tr>
			
			<?php
		}
		?>
	</table>
	<br>
</div>
	</div>
	<script>
		$(".main_shadow,.main_div,#leftdiv_title").corner("top");
		$("h3").corner();
	</script>
</body>

</html>	
