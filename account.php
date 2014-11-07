<?php
	require 'test.php';
	$persoana  = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE USERNAME='$_SESSION[user]' "));
?>
	<div class="main_shadow">
		<div class="main_div">
			<div id="leftdiv_title">
				<h2 align="center" style="color:white; font-family:Helvetica; line-height:50%;">Contul meu </h2>
				<hr>
			</div>
			<br>
			<?php 
					if ( !isset($_SESSION["connected"]) )
					{
						echo '<h1 align="center">';
						die("Nu poti accesa aceasta pagina!");
						echo '</h1>';
					}
				?>
			<table width="90%" border = "0" align = "center">
			<tr>
			<td>
			<form action = "modifica_parola.php" method="POST">
				<b>Schimbare parola:</b><br>
				<br>
				Parola veche:<br>
				<input type = "password" name="parola_veche"><br><br>
				Parola noua:<br>
				 <input type = "password" name="parola_noua"><br><br>
				Confirmare parola noua:<br>
				<input type = "password" name="confirmare"><br><br>
				<button type="submit">Schimba parola</button>
			</form>
			<form action = "modifica_cont.php" method = "POST">
				<br><br>
				<hr>
				<br><br>
				<b>Date personale:</b><br><br>
				<br>
				Nume:<br>
				<input type="text" name = "nume" value="<?php echo $persoana['NUME']  ?>"><br><br>
				Prenume:<br>
				<input type="text" name = "prenume" value="<?php echo $persoana['PRENUME']  ?>"><br><br>
				Adresa:<br>
				<input type="text" name = "adresa" value="<?php echo $persoana['ADRESA']  ?>"><br><br>
				Cod postal:<br>
				<input name = "cod_postal" value="<?php echo $persoana['COD_POSTAL']  ?>"><br><br>
				Numar de telefon:<br>
				<input name = "telefon" value="<?php echo $persoana['NUMAR_TELEFON']  ?>"><br><br>
				Email:<br>
				<input name = "email" value="<?php echo $persoana['EMAIL']  ?>"><br><br>
				<br><br>
				<button type="submit">Salveaza modificarile</button>
			</form>
			</td>
			</tr>
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
