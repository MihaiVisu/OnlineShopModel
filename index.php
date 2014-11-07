<?php
require 'test.php';
$_SESSION["pg"]="index.php";
?>
<div class="main_shadow">
	<div class="main_div">
		<div id="leftdiv_title">
			<h2 style="color:white; font-family:Helvetica; line-height:50%;" align="center">Noutati</h2>
			<hr>
		</div>
		<?php
		$product = mysql_query("SELECT *FROM obiect ORDER BY ID DESC");
		$k = 0;
		while( $res = mysql_fetch_array($product) )
		{
			$k++;
			if ( $k > 10 )
			{
				break;
			}
			$obid=$res["ID"];
			$subid=$res["SUBCATEGORIE_ID"];
			$subc= mysql_query("SELECT *FROM subcategorie WHERE ID='$subid'"); // PREIAU SUBCATEGORIA
			$subcres= mysql_fetch_array($subc);
			$cat_id = $subcres["CATEGORIE_ID"];
			$categ= mysql_query("SELECT *FROM categorie WHERE ID='$cat_id'"); // PREIAU CATEGORIA
			$categres = mysql_fetch_array($categ);
			 ?><h3 align="left" id="data_h3"><a href="detalii_obiect.php?obid=<?php echo $res["ID"];?>" style="text-decoration:none;"><?php echo $res["NUME"];?></a>
				<span style="position:absolute; right:10px;"><?php echo "PRET:".$res["PRET"]."LEI"; ?></span>
			   </h3>
			   <div class="over">
					<table style="margin-left:10px;">
						<tr><td rowspan="5" valign="top"><img href="detalii_obiect.php?obid=<?php echo $res["ID"];?>" src="Upload_Imagini/<?php if ( $res["IMAGINI"] == "" ){echo "NoImage.png";}else{echo $res["IMAGINI"];} ?>" width="80" height="80"></td>
						<tr>
							<td>Denumire:</td>
							<td><a href="detalii_obiect.php?obid=<?php echo $res["ID"];?>" style="text-decoration:none;"><?php echo $res["NUME"]; ?></a></td>
						</tr>
						<tr>
							<td>Categorie:</td>
							<td><?php echo $categres["NUME"]; ?></td>
						</tr>
						<tr>
							<td>Subcategorie:</td>
							<td><?php echo $subcres["NUME"]; ?></td>
						</tr>
						<tr>
							<?php if ( $res["CANTITATE"] != 0 ){?>
							<td style="color:green" colspan="2"><b>VALABIL PE STOC</b></td>
							<?php } else { ?>
							<td style="color:red" colspan="2"><b>STOC EPUIZAT</b></td><?php } ?>
						</tr></tr>
					</table>
					<table class="cos" style="margin-top:-70px; margin-right:10px;">
						<tr><?php if ( $res["CANTITATE"] != 0 && isset($_SESSION["connected"]) && $_SESSION["statut"]==1){ ?>
							<td>
								<form action="adauga_in_cos.php" method="POST">
									Cantitate:
									<input type="text" name="cant" size="3" maxlength="5">
									<input type="hidden" name= "obid" value="<?php echo $res['ID']; ?>">
									<input type="hidden" name= "page" value="index.php">
									<button type="submit">Adauga in cos</button>
								</form>
							</td><?php } 
							if ( !isset($_SESSION["connected"]) )
							{
								echo'<td>Autentifica-te pentru a adauga produse in cos</td>';
							}?>
							<?php if ( $_SESSION["statut"] == 2 ){?>
							<td><a href="stergere_obiect.php?obid=<?php echo $res["ID"];?>&page=index.php" style="text-decoration:none;">Sterge obiect</a></td>
							<?php } ?>
						</tr>
					</table><hr>
					<p style="margin-bottom:5px; margin-left:10px;"><b>Specificatie</b>:<?php echo substr($res["SPECIFICATIE"],0,50); if ( strlen($res["SPECIFICATIE"])>50 ){echo "...";} ?></p>
				</div>
		<?php } ?>
	</div>
</div>
<script>
		$(".main_shadow,.main_div,#leftdiv_title").corner("top");
		$("h3, .main_div a").corner();
</script>
