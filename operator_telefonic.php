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
	<div class="main_div">
		<div id="leftdiv_title">
			<h2 style="color:white; font-family:Helvetica; line-height:50%;" align="center">Creare cont operator</h2>
			<hr>
		</div>
		<form method="POST" action="create_operator.php">
			<table align="center">
				<tr>
					<td>Nume:</td>
					<td><input id="nume" type="text" name="nume" value="<?php echo $_SESSION["enume"]; unset($_SESSION["enume"]); ?>"></td>
				</tr>
				<tr>
					<td>Prenume:</td>
					<td><input id="prenume" type="text" name="prenume" value="<?php echo $_SESSION["eprenume"]; unset($_SESSION["eprenume"]); ?>"></td>
				</tr>
				<tr>
					<td>Adresa de Email:</td>
					<td><input id="email" type="text" name="email" value="<?php echo $_SESSION["eemail"]; unset($_SESSION["eemail"]); ?>"></td>
				</tr>
				<tr>
					<td>Nume Utilizator:</td>
					<td><input id="username" type="text" name="username" value="<?php echo $_SESSION["eusername"]; unset($_SESSION["eusername"]); ?>"></td>
				</tr>
				<tr>
					<td>Parola:</td>
					<td><input id="parola" type="password" name="parola" value="<?php echo $_SESSION["eparola"]; unset($_SESSION["eparola"]); ?>"></td>
				</tr>
				<tr>
					<td>Verificare Parola:</td>
					<td><input id="verif_parola" type="password" name="verif_parola" value="<?php echo $_SESSION["everif_parola"]; unset($_SESSION["everif_parola"]); ?>"></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><button type="submit" value="Inregistrare">Creeaza cont de operator</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<script>
		$(".main_shadow,.main_div,#leftdiv_title").corner("top");
		$("h3, .main_div a").corner();
</script>
