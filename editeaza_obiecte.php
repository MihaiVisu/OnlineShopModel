<?php
	require 'test.php';
	if ( $_SESSION["statut"]!=2 )
	{
		echo '<div class="main_shadow"><div class="main_div" align="center">';
		die("<h1>Nu ai destule permisiuni pentru a accesa aceasta pagina!</h1>");
		echo '</div></div>';
	}
?>
	<div class="main_shadow">
		<div class="main_div" align="center">
			<div id="leftdiv_title">
				<h2 align="center" style="color:white; font-family:Helvetica; line-height:50%;">Adauga obiect </h2>
				<hr>
			</div>
			<form action = "adauga_obiect.php" method = "POST" enctype="multipart/form-data">
				<table>
					<tr>
						<td>Subcategorie:</td>
						<td><select name = "subcategorie">
				<option></option>
				<?php
				//luam categoriile
				$result1 = mysql_query("SELECT * FROM categorie ORDER BY NUME");
				while($row1 = mysql_fetch_array($result1))
				{
					//si luam si subategoriile
					$result2 = mysql_query("SELECT * FROM subcategorie WHERE CATEGORIE_ID = '$row1[ID]' ");
					while($row2 = mysql_fetch_array($result2))
					{
						echo "<option value='".$row2['NUME']."'>".$row1['NUME']."-".$row2['NUME']."</option>";
					}
			
				}
	?>
			</select></td>
					</tr>
					<tr>
						<td>Nume obiect:</td>
						<td><input name="nume" type="text"></td>
					</tr>
					<tr>
						<td>Pret:</td>
						<td><input name="pret" type="text">LEI</td>
					</tr>
					<tr>
						<td><label for="file">Imagine:</label></td>
						<td><input type="file" name="file" id="file"></td>
					</tr>
					<tr>
						<td>Cantitate:</td>
						<td><input type="text" name="cantitate"></td>
					</tr>
					<tr>
						<td>Specificatii:</td>
					</tr>
					<tr>
						<td colspan="3"><textarea name="specificatie" rows="10" cols="40"></textarea></td>
					</tr>
					<tr>
						<td colspan="3"><button type="submit" name="submit" value="Adauga obiectul">Adauga obiectul</button></td>
					</tr>
					<tr>
						<td colspan="3" style="color:green; font-size:16; font-family:Helvetica"><?php echo$_SESSION["adaugare_succes"];
						unset($_SESSION["adaugare_succes"]);?></td>
					</tr>
	</form>
</div>
</div>
<script>
		$(".main_shadow,.main_div,#leftdiv_title").corner("top");
		$("h3").corner();
</script>
