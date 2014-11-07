<?php
	require "test.php";
	if ( $_SESSION["statut"]!=2 )
	{
		echo '<div class="main_shadow"><div class="main_div" align="center">';
		die("<h1>Nu ai destule permisiuni pentru a accesa aceasta pagina!</h1>");
		echo '</div></div>';
	}
?>
<div class="main_shadow">
		<div class="main_div">
			<div id="leftdiv_title">
				<h2 align="center" style="color:white; font-family:Helvetica; line-height:50%;">Editeaza subcategorii </h2>
				<hr>
			</div>
			<br>
<form action = "adauga_subcategorie.php" method = "POST">
	Adauga subcategoria <input type = "text" name = "nume">
	la categoria 
	<select name = "categorie">
		<option></option>
		<?php
			$result = mysql_query("SELECT * FROM categorie ORDER BY NUME");
		
			while($row = mysql_fetch_array($result))
			{
				echo "<option>".$row['NUME']."</option>";
			}
		?>
	</select>
	<button type="submit">Adauga</button>
</form>
<br>
<hr>
<br>
<form action ="sterge_subcategorie.php" method = "POST">
	Sterge subcategorie: 
	<select name = "nume">
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
				?>
					<option value="<?php echo $row1['NUME']."++|--".$row2['NUME']; ?>"> <?php echo $row1['NUME']."-".$row2['NUME']; ?> </option>
				<?php
					
			}
			
		}
	?>
	
	
	</select>
	<button type="submit">Sterge</button>
</form>
<br>
<hr>
<br>

<form action = "modificare_nume_subcategorie.php" method = "POST">
		
		Modifica numele subcategoriei: 
		<select name = "nume">
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
					echo "<option>".$row1['NUME']."-".$row2['NUME']."</option>";
			}
			
		}
	?>
	
			</select>
		in
		<input type="text" size="20" name="nume_nou">
		<button type="submit">Modifica</button>
		</form>
	<br>

</div>
	</div>
	<script>
		$(".main_shadow,.main_div,#leftdiv_title").corner("top");
		$("h3, .main_div a").corner();
	</script>
</body>

</html>
