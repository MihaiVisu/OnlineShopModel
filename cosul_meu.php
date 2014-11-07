<?php
require 'test.php';
$suma =0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>fără titlu</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.22" />
	<style>
		#plata
		{
			background-image: -webkit-linear-gradient(#14A714, #005200);
			background-image: -moz-linear-gradient(top,#14A714, #005200);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#14A714', endColorstr='#005200');
			-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#14A714', endColorstr='#005200')";
			background-image: -ms-linear-gradient(#14A714, #005200);
			background-image: -o-linear-gradient(#14A714, #005200);
			background-image: linear-gradient(#14A714, #005200);
		}
	</style>
</head>
<body>
	<div class="main_shadow">
		<div class="main_div">
			<div id="leftdiv_title">
				<h2 style="color:white; font-family:Helvetica; line-height:50%;" align="center">Cosul meu</h2>
				<hr>
			</div>
			<?php 
			require 'sortare.php';
			if ( !isset($_SESSION["connected"]) || $_SESSION["statut"] != 1 )
			{
				echo '<h1 align="center">';
				die("Nu poti accesa aceasta pagina!");
				echo '</h1>';
			}
			$user_id=$_SESSION["user_id"];
			$list=mysql_query("SELECT *FROM cos WHERE USER_ID='$user_id' ORDER BY $sortare $ordine");
			if ( mysql_num_rows($list)==0 )
			{
				echo '<h2 align="center">';
				die("Nu ai produse in cos!");
				echo '</h2>';
			}
			while ( $ob=mysql_fetch_array($list))
			{
				$obj=$ob["OBIECT_ID"];
			
				$res=mysql_fetch_array(mysql_query("SELECT *FROM obiect WHERE ID='$obj'"));
				$subid=$res["SUBCATEGORIE_ID"];
				
				$suma+= $res['PRET']*$ob['CANTITATE'];
				$subcres=mysql_fetch_array(mysql_query("SELECT *FROM subcategorie WHERE ID='$subid'"));
				$catid=$subcres["CATEGORIE_ID"];
				$categres=mysql_fetch_array(mysql_query("SELECT *FROM categorie WHERE ID='$catid'"));
				?>
				<h3 align="left" id="data_h3"><a href="detalii_obiect.php?obid=<?php echo $res["ID"];?>" style="text-decoration:none;"><?php echo $res["NUME"];?></a>
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
							<td>Cantitate:</td>
							<td><?php echo $ob["CANTITATE"]; ?></td>
						</tr>
					</table>
					<table class="cos" style="margin-top:-70px; margin-right:10px;">
						<tr>
							<?php if ( $_SESSION["statut"] == 1 ){?>
							<td><a href="stergere_obiect.php?obid=<?php echo $res["ID"];?>&page=cosul_meu.php" style="text-decoration:none;">Sterge obiect</a></td>
							<?php } ?>
						</tr>
					</table>
					<hr>
					<p style="margin-bottom:5px; margin-left:10px;"><b>Specificatie</b>:<?php echo substr($res["SPECIFICATIE"],0,50); if ( strlen($res["SPECIFICATIE"])>50 ){echo "...";} ?></p>
				</div><?php
			} ?>
				<div id="plata" align="center">
					<hr>
					<h3 style="font-family:Helvetica; color:white;">
					Plata Totala: <?php echo $suma; ?> LEI
					</h3>
					<hr>
				</div>
			<p style="display:block;" align="right">
				<a href="finalizeaza_comanda.php?suma=<?php echo $suma; ?>" style="margin-right:21%;">Finalizeaza comanda</a>
				<a href="goleste_cosul.php" style="margin-right:12px;">Goleste cosul</a>
			</p>
		</div>
	</div>
	<script>
		$(".main_shadow,.main_div,#leftdiv_title").corner("top");
		$("h3, .main_div a").corner();
	</script>
</body>
</html>
