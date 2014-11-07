<?php
require 'test.php';?>
<div class="main_shadow">
	<div class="main_div">
		<div id="leftdiv_title">
			<h2 style="color:white; font-family:Helvetica; line-height:50%;" align="center">Conectare</h2>
			<hr>
		</div>
		<br>
		<table style="margin-left:10px; margin-bottom:20px;">
			<form method="post" action="login.php">
				<tr>
					<td>Nume Utilizator:</td>
					<td><input type="text" name="user" id="User"></td>
				</tr>
				<tr>
					<td>Parola:</td>
					<td><input type="password" name="password" id="Pw"></td>
				</tr>
				<tr>
					<td colspan="2" align="right">
						<button type="submit" value="Conecteaza-te">Conecteaza-te</button>
					</td>
				</tr>
			</form>
		</table>
	</div>
</div>
<script>
		$(".main_shadow,.main_div,#leftdiv_title").corner("top");
		$("h3, .main_div a").corner();
</script>
