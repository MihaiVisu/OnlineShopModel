<?php
	error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
	$link = mysql_connect('localhost', 'root', '');
	if (!$link) {
          die("conectare nereusita");
	}
	mysql_select_db("tml_tractorii",$link);
	if (session_status() == PHP_SESSION_NONE) {
    		session_start();
	}
	$sfor = filter_var(trim($_GET['searchingfor']),FILTER_SANITIZE_STRING);
	$_SESSION["pg"]="search.php?searchingfor=".$sfor;
	$no_result=false;
	$thispage = 0;
	if ( $sfor == NULL )
	{
		$_SESSION["mesaj"]="Nu s-a gasit niciun rezultat!";
		$no_result=true;
	}
	else
	{
		$cuvinte = explode(" ",$sfor);
		foreach( $cuvinte as $cuv )
		{
			$search .= "OR NUME LIKE '%$cuv%' ";
		}
		$caut=mysql_query("SELECT *FROM obiect WHERE NUME= '$sfor' $search");
		if ( mysql_num_rows($caut) == 0)
		{
			$_SESSION["mesaj"]="Nu s-a gasit niciun rezultat!";
			$no_result=true;
		}
		else
		{
			$nr = mysql_num_rows($caut) ;
			$nrpagini = (int)($nr/10) + ( $nr%10 != 0);
			
			$skipob = $_GET['pag'] * 10;
		}
	}
	require 'test.php';
	if ( $no_result==true )
	{
		die();
	}
	?>
	<div class="main_shadow">
		<div class="main_div">
			<div id="leftdiv_title">
				<h2 style="color:white; font-family:Helvetica; line-height:50%;" align="center">Rezultatele cautarii</h2>
				<hr>
			</div>
			<br>
			<table width="90%" align="center">
				<tr align="center">
					<td width="30">
				<?php
					if($_GET['pag']>0)
					{
						?>
						
							<a href="search.php?searchingfor=<?php echo $_GET['searchingfor'];?>&pag=<?php echo  ($_GET['pag']-1);?>">Prev</a>
						
						<?php
					}
				?>
				</td>
				<td>		
			<?php
			
			for($i = 0; $i < $nrpagini ; $i++)
			{
				?>
				<a href = "search.php?searchingfor=<?php echo $_GET['searchingfor']?>&pag=<?php echo $i;?>"><?php 
				
				if($_GET['pag']==$i)
					echo "<b><u>".($i+1)."</u></b>";
				else 
					echo ($i+1);
				
				?></a>
				<?php
			}
			?>
			</td>
			<td width="30">
				<?php
					if($_GET['pag']<$nrpagini-1)
					{
						?>
						
							<a href="search.php?searchingfor=<?php echo $_GET['searchingfor'];?>&pag=<?php echo ($_GET['pag']+1);?>">Next</a>
						
						<?php
					}
				?>
			</td>
			</tr>
			<?
			echo "</table><br>";
			while ( $res=mysql_fetch_array($caut) )
			{
				
				if($skipob>0)
				{
					$skipob--;
				}
				else if($thispage<10)
				{
					$thispage++;
				
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
									<input type="hidden" name= "page" value="search.php?searchingfor=<?php echo $sfor; ?>">
									<button type="submit">Adauga in cos</button>
								</form>
							</td><?php } 
							if ( !isset($_SESSION["connected"]) )
							{
								echo'<td>Autentifica-te pentru a adauga produse in cos</td>';
							}?>
							<?php if ( $_SESSION["statut"] == 2 ){?>
							<td><a href="stergere_obiect.php?obid=<?php echo $res["ID"];?>&page=search.php?searchingfor=<?php echo $sfor; ?>" style="text-decoration:none;">Sterge obiect</a></td>
							<?php } ?>
						</tr>
					</table><hr>
					<p style="margin-bottom:5px; margin-left:10px;"><b>Specificatie</b>:<?php echo substr($res["SPECIFICATIE"],0,50); if ( strlen($res["SPECIFICATIE"])>50 ){echo "...";} ?></p>
				</div><?php
				}
			}?>
		</div>
	</div>
	<script>
		$(".main_shadow,.main_div,#leftdiv_title").corner("top");
		$("h3, .main_div a").corner();
	</script>


