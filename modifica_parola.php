<?php
	require 'module.php';
	
	$oldpass = $_POST['parola_veche'];
	$newpass = $_POST['parola_noua'];
	$conf = $_POST['confirmare'];
	
	if($oldpass == NULL || $newpass == NULL || $conf == NULL)
	{
		$_SESSION['mesaj'] = "Campurile sunt obligatorii";
		header('Location: account.php');
		die();
	}
	
	$res = mysql_fetch_array(mysql_query(" SELECT * FROM user WHERE USERNAME = '$_SESSION[user]' "));
	if($res['PAROLA'] != SHA1 ($oldpass))
	{
		$_SESSION['mesaj'] = "Parola incorecta";
		header('Location: account.php');
		die();
	}
	
	if($newpass != $conf)
	{
		$_SESSION['mesaj'] = "Parola nu a fost confirmata";
		header('Location: account.php');
		die();
	}
	$newpass = SHA1($newpass);
	
	$res = mysql_query("UPDATE user SET PAROLA='$newpass' WHERE USERNAME = '$_SESSION[user]' ");
	if(!res)
	{
		$_SESSION['mesaj'] = "Eroare mysql";
		header('Location: account.php');
		die();
	}
	$_SESSION['introdus'] = "Parola schimbata cu succes";
	header('Location: account.php');
		
	
?>
