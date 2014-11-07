<?
	require 'test.php';
	$object_id = $_GET["obid"];
	$_SESSION["pg"]="detalii_obiect.php?obid=".$object_id;
	$res = mysql_query("SELECT * FROM obiect WHERE ID='$object_id' ");
	$ob = mysql_fetch_array($res);
?>
<style>
#overimg:hover
{
	background-color:none;
}
#plata
{
	background-image: -webkit-linear-gradient(#696969, #000000);
	background-image: -moz-linear-gradient(top,#696969, #000000);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#696969', endColorstr='#000000');
	-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#696969', endColorstr='#000000')";
	background-image: -ms-linear-gradient(#696969, #000000);
	background-image: -o-linear-gradient(#696969, #000000);
	background-image: linear-gradient(#696969, #000000);
}
</style>
	<div class="main_shadow">
		<div class="main_div">
			<?php
				
				if($ob==NULL)
				{
					?>
					<div id="leftdiv_title">
						<h2 align="center" style="color:white; font-family:Helvetica; line-height:50%;">Eroare </h2>
						<hr>
					</div>
					<br>
					<br>
					<h1>Ne pare rau, dar nu avem acest produs in oferta</h1>
					<br>
					<br>
					<?php
				}
				else
				{
					?>
					<div id="leftdiv_title">
						<h2 align="center" style="color:white; font-family:Helvetica; line-height:50%;"><?php echo $ob['NUME']; ?> </h2>
						<hr>
					</div>
					<?php
					//getting categorie
					$subcat = mysql_fetch_array(mysql_query("SELECT * FROM subcategorie WHERE ID ='$ob[SUBCATEGORIE_ID]' "));
					$cat = mysql_fetch_array(mysql_query("SELECT * FROM categorie WHERE ID ='$subcat[CATEGORIE_ID]' "));
					?>
					<br>
					<br>
				<table width="80%" border = "0" align="center">
					<tr>
						<td rowspan = "4">
							<a id="overimg" href="Upload_Imagini/<?php echo $ob['IMAGINI']; ?>"><img src="Upload_Imagini/<?php echo $ob['IMAGINI']; ?>" width="95%"></a>
						</td>
						<td height="25">
							Categorie:
						</td>
						<td>
							<?php echo $cat['NUME']; ?>
						</td>
					</tr>
					<tr>
						<td height="25">
							Subcategorie:							
						</td>
						<td>
							<?php echo $subcat['NUME'];?>
						</td>
					</tr>
					<tr>
						<td height="25">
							<h2>Pret:</h2> 
						</td>
						<td>
							<h2><b><?php echo $ob['PRET']; ?> LEI<b></h2>
						</td>
					</tr>
					<tr>
						<td height="25">
							<b><?php
								if($ob['CANTITATE']>0)
								{
									echo "<span style='color:green;'>Valabil in stoc</span>";
									if($_SESSION['statut']==2)
										echo " [".$ob['CANTITATE']."] ";
								}
								
								else echo "<span style='color:red'>Stoc inexistent</span>";
							?></b>
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<hr>
							<b>Specificatie:</b><br>	
							<?php 
							if ( $_SESSION["statut"]==2 ) 
							{
								echo '<form method="post" action="modifica_specificatie">';
								echo '<input type="hidden" name="obiect" value="'.$object_id.'">';
								echo '<textarea name="specificatie" rows="7" cols="50">'.$ob['SPECIFICATIE'].'</textarea>';
								echo '<button type="submit">Modifica specificatie</button></form>';
							}
							else
							{
								echo $ob['SPECIFICATIE'];
							}?>
							<?php
							
							if ( $ob['CANTITATE'] >0 && isset($_SESSION["connected"]) && $_SESSION["statut"]==1)
							{
								?>
								<br>
								<hr>
								<br>
								<form action="adauga_in_cos.php" method="POST">
									Cantitate:
									<input type="text" name="cant" size="3" maxlength="5">
									<input type="hidden" name= "obid" value="<?php echo $ob['ID']; ?>">
									<input type="hidden" name= "page" value="detalii_obiect.php?obid=<?php echo $ob['ID'];?>">
									<button type="submit">Adauga in cos</button>
								</form>
								<?php
							}
							else if($_SESSION["statut"]==2)
							{
								?>
								<hr>
								<form action="reinnoieste_stoc.php" method="POST">
									Reinnoieste stocul cu:
									<input type="text" name="cant" size="3" maxlength="5">
									<input type="hidden" name= "obid" value="<?php echo $ob['ID']; ?>">
									<input type="hidden" name= "page" value="detalii_obiect.php?obid=<?php echo $ob['ID'];?>">
									unitati
									<button type="submit">OK</button>
								</form>
								<br>
								<hr>
								
								<form action="modificare_nume_obiect.php" method = "POST">
									Modifica numele obiectului:
									<input type="hidden" name= "obid" value="<?php echo $ob['ID']; ?>">
									<input type="hidden" name= "page" value="detalii_obiect.php?obid=<?php echo $ob['ID'];?>">
									<input name = "nume" type="text" value = "<?php echo $ob['NUME']; ?>" size = "20">
									<button type="submit">Modifica</button>
								</form>
								
								<br>
								<hr>
								<a href="stergere_obiect.php?id=<?php echo $ob["ID"];?>&obid=<?php echo $_GET['obid'];?>" style="text-decoration:none;">Sterge obiect</a>
								<?php
							}
								?>				
							<br>						
							<br>						
							<br>						
							<br>						
							<br>						
						</td>
					</tr>
				<?php
				}
				?>
			</table>
			<h2 align="center" style="font-family:Helvetica; color:white;" id="plata">Comentarii</h2>
<br>
<?php 

$res = mysql_query("SELECT * FROM comentariu WHERE OBIECT_ID='$_GET[obid]' ORDER BY ID ASC ");
while($row = mysql_fetch_array($res))
{ 
	$user = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE ID = '$row[USER_ID]' "));
	echo '<h5 id="comment_h3">'.$user['USERNAME'].' a scris:';
	echo '<span style="position:absolute; right:10px;">'.$row['DATETIME'].'</span>';
	echo '</h5>'; ?>
	<p style="margin-left:15px;"><?php echo $row['COMENTARIU'];?></p>
	<?php
	if($_SESSION['statut']==2 || $_SESSION['statut']==3)
	{
		?>
		<hr width="100px" align="left" style="margin-left:10px;">
		<a style="margin-left:10px;" href="sterge_comentariu.php?id=<?php echo $row["ID"];?>&obid=<?php echo $_GET['obid'];?>" style="text-decoration:none;">Sterge comentariu</a>
		<?php
	}
}
?>
			<?php if ( isset($_SESSION["connected"]) )
			{?>
			<hr>
			<h3 align="left" id="add_h3">Adauga un comentariu:</h3>
			<table align="center">
				<form method="POST" action="adauga_comentariu.php">
					<tr>
						<input type="hidden" name="obiect_id" value="<?php echo $object_id; ?>">
						<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
						<td><textarea name="comment" rows="6" cols="40"></textarea></td>
					</tr>
					<tr>
						<td align="right"><button type="submit">Trimite</button></td>
					</tr>
				</form>
			</table>
			<?php } ?>
	</div>
	</div>
	<script>
		$(".main_shadow,.main_div,#leftdiv_title").corner("top");
		$("h3, h5[id='comment_h3']").corner();
	</script>
</body>
</html>
