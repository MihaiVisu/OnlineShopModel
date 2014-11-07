<?php
	require 'test.php';
	$_SESSION["pg"]="contact.php";
?>
<div class="main_shadow">
		<div class="main_div">
		<div id="leftdiv_title">
				<h2 align="center" style="color:white; font-family:Helvetica; line-height:50%;">Contact </h2>
				<hr>
			</div>
			<br>
	Pentru orice informatii ne puteti contacta la nr de telefon: 07xx.xxxxxx sau folosind formularul de mai jos:<br>
	<br>
	<form action='formular_contact.php' method = "POST">
	<table>
		<tr>
			<td>
				Nume:
			</td>
			<td>
				<input size="40" name = "NUME">
			</td>
		</tr>
			<td>
				*Telefon:
			</td>
			<td>
				<input size="40" name = "TELEFON">
			</td>	
		</tr>
		<tr>
			<td>
				Email:
			</td>
			<td>
				<input size = "40" name = "EMAIL">
			</td>
		</tr>
		<tr>
			<td>
				Mesaj:
			</td>
			<td>
				<textarea name="MESAJ" rows="10" cols="60"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<button type="submit">Trimite</button>
			</td>
		</tr>
	</table>
	
	
	</form>
	</div>
	</div>
	<script>
		$(".main_shadow,.main_div,#leftdiv_title").corner("top");
		$("h3").corner();
	</script>
</body>
</html>
