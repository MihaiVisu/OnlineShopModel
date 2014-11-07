<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.22" />
	<?php require "Jscripts.php";
	?>
</head>
<body>
	
	
<div id="popBox" onclick="ClosePops()"></div>



<div id="loginBox">
	<h1 align="center">Conectare</h1>
	<hr>
	<table id="loginTable" align="center">
		<form method="POST">
		<tr>
			<td align="left">Nume Utilizator:</td>
			<td><input type="text" name="username" onkeypress="return validate(onlyUserNames)" id="User" onpaste="return false;"></td>
		</tr>
		<tr>
			<td align="left">Parola:</td>
			<td><input type="password" name="pw" onkeypress="return validate(onlyUserNames)" id="Pw" onpaste="return false;"></td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				<span id="registerButton" onclick="Login(location.href)">Conecteaza-te</span></form>
			</td>
		</tr>
		<tr>
			<td id="errors" colspan="2"></td>
		</tr>
		<tr><td colspan="2"><hr></td></tr>
		<tr></tr>
			<td colspan="2">Nu ai cont? Creeaza-ti unul <span id="registerButton" onclick="ShowRegister()"><b>aici</b></span>!</td>
		</tr>
	</table>
</div>

<!--REGISTER BOX-->

<div id="registerBox">
	<h1 align="center">Inregistrare</h1>
	<hr>
	<form method="POST">
		<table id="registerTable" align="center">
			<tr>
				<td align="left">Nume:</td>
				<td><input type="text" name="NUME" onblur='Register("NUME")' onkeypress="return validate(onlyNames)" id="NUME" onpaste="return false;"></td>
				<td id="errorsNUME" style="color:red"></td>
			</tr>
			<tr>
				<td align="left">Prenume:</td>
				<td><input type="text" name="PRENUME" onblur='Register("PRENUME")' onkeypress="return validate(onlyNames)" id="PRENUME" onpaste="return false;"></td>
				<td id="errorsPRENUME" style="color:red"></td>
			</tr>
			<tr>
				<td align="left">Nume Utilizator:</td>
				<td><input type="text" name="USERNAME" onblur='Register("USERNAME")' onkeypress="return validate(onlyUserNames)" id="USERNAME" onpaste="return false;"></td>
				<td id="errorsUSERNAME" style="color:red"></td>
			</tr>
			<tr>
				<td align="left">E-mail:</td>
				<td><input type="text" name="EMAIL" onblur='Register("EMAIL") 'onkeypress="return validate(onlyEmails)" id="EMAIL" onpaste="return false;"></td>
				<td id="errorsEMAIL" style="color:red"></td>
			</tr>
			<tr>
				<td align="left">Parola:</td>
				<td><input type="password" name="PAROLA" onblur='Register("PAROLA")' onkeypress="return validate(onlyUserNames)" id="PAROLA" onpaste="return false;"></td>
				<td id="errorsPAROLA" style="color:red"></td>
			</tr>
			<tr>
				<td align="left">Verificare parola:</td>
				<td><input type="password" name="VERIF_PAROLA" onblur='Register("VERIF_PAROLA")' onkeypress="return validate(onlyUserNames)" id="VERIF_PAROLA" onpaste="return false;"></td>
				<td id="errorsVERIF_PAROLA" style="color:red"></td>
			</tr>
			<tr>
				<td align="left">Adresa:</td>
				<td><input type="text" name="ADRESA" onblur='Register("ADRESA")' onkeypress="return validate(onlyAddresses)" id="ADRESA" onpaste="return false"></td>
				<td id="errorsADRESA" style="color:red"></td>
			</tr>
			<tr>
				<td align="left">Cod Postal:</td>
				<td><input type="text" name="COD_POSTAL" onblur='Register("COD_POSTAL")' onkeypress="return validate(onlyNumbers)" id="COD_POSTAL" onpaste="return false;"></td>
				<td id="errorsCOD_POSTAL" style="color:red"></td>
			</tr>
			<tr>
				<td align="left">*Numar de telefon:</td>
				<td><input type="text" name="NUMAR_TELEFON" onblur='Register("NUMAR_TELEFON")' onkeypress="return validate(onlyNumbers)" id="NUMAR_TELEFON" onpaste="return false;"></td>
				<td id="errorsNUMAR_TELEFON" style="color:red"></td>
			</tr>
			<tr>
				<td align="right" colspan="2"><span id="registerButton" onclick="EndRegister()">Inregistreaza-te</span></td>
			</tr>
			<tr>
				<td id="success" colspan="2"></td>
			</tr>
			<tr>
				<td colspan="2" style="border:1px solid green"><b>ATENTIE:</b>Inputurile marcate cu (*) sunt optionale!</td>
			</tr>
			<tr><td colspan="2"><hr></td></tr>
			<tr>
				<td colspan="2">Ai deja un cont? Autentifica-te <span id="registerButton" onclick="ShowLogin()"><b>aici</b></span>!</td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>
