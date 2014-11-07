
<?php //*** VARIABILE PT SORTARE ***//

if ( isset($_POST["sortare"]) )
{
	$_SESSION['sortare'] = $_POST["sortare"];
}
else if ( !isset($_SESSION['sortare']) )
{
	$_SESSION['sortare']="ID";
}
if ( isset($_POST["ordine"]) )
{
	$_SESSION['ordine'] = $_POST["ordine"];
}
else if ( !isset($_SESSION['ordine']) )
{
	$_SESSION['ordine']="ASC";
}
$sortare = $_SESSION['sortare'];
$ordine = $_SESSION['ordine'];
?>

<!-- PAGINA DE SORTARE -->
<table align="center">
	<tr>
		<form method="post">
			<td>Sorteaza dupa:</td>
			<td><select name="sortare">
					<option value="<?php echo $_SESSION['sortare']; ?>"><?php if ( $_SESSION['sortare']=="ID" ){echo "DATA";}else echo $_SESSION['sortare']; ?></option>
					<option value="<?php if ( $_SESSION['sortare']=='NUME' ){echo 'PRET';}else{echo 'NUME';} ?>"><?php if ( $_SESSION['sortare']=='NUME' ){echo 'PRET';}else{echo 'NUME';} ?></option>
					<option value="<?php if ( $_SESSION['sortare']=='ID' ){echo 'PRET';}else{echo 'ID';} ?>"><?php if ( $_SESSION['sortare']=='ID' ){echo 'PRET';}else{echo 'DATA';} ?></option>
					<option value="<?php if ( $_SESSION['sortare']=='CANTITATE' ){echo 'PRET';}else{echo 'CANTITATE';} ?>"><?php if ( $_SESSION['sortare']=='CANTITATE' ){echo 'PRET';}else{echo 'CANTITATE';} ?></option>
				</select>
			</td>
			<td><select name="ordine">
					<option value="<?php echo $_SESSION['ordine']; ?>"><?php if($_SESSION['ordine']=="ASC"){echo 'Ascendent';}else{echo 'Descendent';} ?></option>
					<option value="<?php if ($_SESSION['ordine']=="DESC" ){echo 'ASC';}else{echo 'DESC';}?>"><?php if($_SESSION['ordine']=="ASC"){echo 'Descentent';}else{echo 'Ascendent';} ?></option>
				</select>
			</td>
			<td><button type="submit"> Sorteaza</button></td>
		</form>
	</tr>
</table>
<hr>
