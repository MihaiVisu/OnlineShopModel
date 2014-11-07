<?php
require 'test.php';
?>
<div class="main_shadow">
	<div class="main_div">
		<div id="leftdiv_title">
			<h2 style="color:white; font-family:Helvetica; line-height:50%;" align="center">Inregistrare</h2>
			<hr>
		</div>
		<form method="POST" action="register.php">
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
					<td>Adresa:</td>
					<td><input id = "adresa" type="text" name="adresa" value="<?php echo $_SESSION["eadresa"]; unset($_SESSION["eadresa"]); ?>"></td>
				</tr>
				<tr>
					<td>Cod Postal:</td>
					<td><input id="postal" type="text" name="postal" value="<?php echo $_SESSION["epostal"]; unset($_SESSION["epostal"]); ?>"></td>
				</tr>
				<tr>
					<td>*Numar de telefon:</td>
					<td><input id = "nrtel" type="text" name="nrtel" value="<?php echo $_SESSION["enrtel"]; unset($_SESSION["enrtel"]); ?>"></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><button type="submit" value="Inregistrare">Inregistrare</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<script>
		$(".main_shadow,.main_div,#leftdiv_title").corner("top");
		$("h3, .main_div a").corner();
</script>
