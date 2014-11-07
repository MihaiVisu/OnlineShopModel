<?php
/*------------Afisare Obiecte din dropdown-menu----------*/

require "test.php";
$ob_id = $_GET["ob"];
$_SESSION["pg"]="afis_obiecte.php?ob=".$ob_id;
$thispage = 0;
// scot obiectele respective din DB...
$object = mysql_query("SELECT *FROM subcategorie WHERE ID='$ob_id'");
if ( $obname = mysql_fetch_array($object) )
{
	$name = $obname["NUME"];
	$cat_id = $obname["CATEGORIE_ID"];
}
if ( isset($_SESSION["connected"]) )
{
	$user_id=$_SESSION["id"];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Afisare obiecte</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.22" />
</head>

<body>
	<div class="main_shadow">
		<div class="main_div">
			<div id="leftdiv_title">
				<h2 align="center" style="color:white; font-family:Helvetica; line-height:50%;"><?php echo $name; ?> </h2>
				<hr>
			</div>
			<?php
			require "sortare.php";
			$q = mysql_query("SELECT *FROM obiect WHERE SUBCATEGORIE_ID='$ob_id' ORDER BY $sortare $ordine");
			$cat = mysql_query("SELECT *FROM categorie WHERE ID='$cat_id'");
			if ( $obcat=mysql_fetch_array($cat) )
			{
				$catname=$obcat["NUME"];
			}
			if ( mysql_num_rows($q) == 0 )
			{
				echo '<h1 align="center">';
				die("Nu exista obiecte in aceasta subcategorie!");
				echo '</h1>';
			}
			else
			{
					$nr = mysql_num_rows($q) ;
					$nrpagini = (int)($nr/10) + ( $nr%10 != 0);
					$skipob = $_GET['pag'] * 10;
			}
			?>
			<br>
			<table width="90%" align="center">
				<tr align="center">
					<td width="30">
				<?php
					if($_GET['pag']>0)
					{
						?>
						
							<a href="afis_obiecte.php?ob=<?php echo $_GET['ob'];?>&pag=<?php echo  ($_GET['pag']-1);?>">Prev</a>
						
						<?php
					}
				?>
				</td>
				<td>		
			<?php
			
			for($i = 0; $i < $nrpagini ; $i++)
			{
				?>
				<a href = "afis_obiecte.php?ob=<?php echo $_GET['ob'];?>&pag=<?php echo $i;?>"><?php 
				
				if($_GET['pag']==$i)
					echo "<b><u>".($i+1)."</u></b>";
				else 
					echo ($i+1);
				
				?></a>
				<?php
			}
			?>
			</td>			<td width="30">
				<?php
					if($_GET['pag']<$nrpagini-1)
					{
						?>
						
							<a href="afis_obiecte.php?ob=<?php echo $_GET['ob'];?>&pag=<?php echo ($_GET['pag']+1);?>">Next</a>
						
						<?php
					}
				?>
			</td>
			</tr>
			<?
			echo "</table><br>";
			while ( $res = mysql_fetch_array($q) )
			{
				
				if($skipob>0)
				{
					$skipob--;
				}
				else if($thispage<10)
				{
					$thispage++;
				// verific daca userul are obiecte din cos
				$obid=$res["ID"];
				$cos=mysql_query("SELECT *FROM cos WHERE OBIECT_ID='$obid' AND USER_ID='$user_id'");
				$check = mysql_num_rows($cos);
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
							<td><?php echo $catname; ?></td>
						</tr>
						<tr>
							<td>Subcategorie:</td>
							<td><?php echo $name; ?></td>
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
									<input type="hidden" name= "page" value="afis_obiecte.php?ob=<?php echo $ob_id; ?>">
									<button type="submit">Adauga in cos</button>
								</form>
							</td><?php } 
							if ( !isset($_SESSION["connected"]) )
							{
								echo'<td>Autentifica-te pentru a adauga produse in cos</td>';
							}?>
							<?php if ( $_SESSION["statut"] == 2 ){?>
							<td><a href="stergere_obiect.php?obid=<?php echo $res["ID"];?>&page=afis_obiecte.php?ob=<?php echo $ob_id; ?>" style="text-decoration:none;">Sterge obiect</a></td>
							<?php } ?>
						</tr>
					</table><hr>
					<p style="margin-bottom:5px; margin-left:10px;"><b>Specificatie</b>:<?php echo substr($res["SPECIFICATIE"],0,50); if ( strlen($res["SPECIFICATIE"])>50 ){echo "...";} ?></p>
				</div>
	  <?php } }?>
		</div>
	</div>
	<script>
		$(".main_shadow,.main_div,#leftdiv_title").corner("top");
		$("h3, .main_div a").corner();
	</script>
</body>

</html>
