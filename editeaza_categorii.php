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
			<h2 align="center" style="color:white; font-family:Helvetica; line-height:50%;">Editare categorii</h2>
			<hr>
		</div>
		<br>
		<form action = "adauga_categorie.php" method = "POST">
			Adauga categorie: <input type = "text" name = "nume">
			<button type="submit">Adauga</button>
		</form>
		<br>
		<hr>
		<br>
		<form action="modificare_nume_categorie.php" method="post">
			Modifica Numele categoriei:
			<select name="nume"><?php
				$result = mysql_query("SELECT * FROM categorie ORDER BY NUME");	
			while($row = mysql_fetch_array($result))
			{
				echo "<option>".$row['NUME']."</option>";
		}?>
			</select>
			in:<input type="text" name="nume_nou">
			<button type="submit">Modifica</button>
		</form>
		<br>
		<hr>
		<br>
		<form action ="sterge_categorie.php" method = "POST">
			Sterge categorie: 
			<select name = "nume">
				<option></option>
		<?php
		$result = mysql_query("SELECT * FROM categorie ORDER BY NUME");	
		while($row = mysql_fetch_array($result))
		{
			echo "<option>".$row['NUME']."</option>";
		}?>
			</select>
			<button type="submit">Sterge</button>
		</form>
		<br>
	</div>
</div>
<script>
	$(".main_shadow,.main_div,#leftdiv_title").corner("top");
</script>
