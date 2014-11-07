<?php
	require 'module.php';
	$mail = trim($_POST["EMAIL"]);
	$mesaj = trim($_POST["MESAJ"]);
	$nume=trim($_POST["NUME"]);
	$telefon = trim($_POST["TELEFON"]);
	if($_POST['NUME'] == NULL || $_POST['EMAIL'] == NULL || $_POST['MESAJ'] == NULL)
	{
		$_SESSION['mesaj'] = "Campurile nemarcate cu steluta sunt obligatorii";
		header('Location: contact.php');
		die();
	}
	if(!preg_match('/^[A-Za-z ]+$/', trim($_POST["NUME"])))
	{
		$_SESSION['mesaj'] = "Numele e invalid!";
		header('Location: contact.php');
		die();
	}
	if ( !preg_match("#^[a-zA-Z0-9 \.,;:\?_/'!£\$%&*()+=\r\n-]+$#",trim($_POST['MESAJ'])) )
	{
		$_SESSION['mesaj'] = "Mesajul e invalid!";
		header('Location: contact.php');
		die();
	}
	else
	{
		$mesaj = mysql_real_escape_string($mesaj);
	}
	if ( !is_numeric($telefon) && $telefon != NULL )
	{
		$_SESSION["mesaj"] = "Numarul de telefon este invalid";
		header('location:contact.php');
		die();
	}
	if(!filter_var(trim($_POST['EMAIL']),FILTER_VALIDATE_EMAIL))
	{
		$_SESSION['mesaj'] = "Adresa de email nu este valida";
		header('Location: contact.php');
		die();
	}
	$vazut = 0;
	$res = mysql_query("INSERT INTO mesaj (NUME, EMAIL, MESAJ, DATETIME, TELEFON, VAZUT) VALUES ('$nume','$mail','$mesaj',NOW(),'$telefon','$vazut' ) ");
	if(!$res)
	{
		$_SESSION['mesaj'] = "Eroare la intrducerea mesajului".mysql_error();
		header('Location: contact.php');
		die();
	}
	$_SESSION['introdus'] = "Mesajul a fost trimis";
	
	header('Location: contact.php');
?>
