<?php
	require 'module.php';
	$persoana  = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE USERNAME='$_SESSION[user]' "));
	if ( !is_numeric($_POST['cod_postal']) )
	{
		$_SESSION['mesaj']="Codul postal este invalid!";
		header('Location: account.php');
		die();
	}
	if ( !is_numeric($_POST['telefon']) && $_POST['telefon'] != NULL )
	{
		$_SESSION['mesaj']="Numarul de telefon este invalid!";
		header('Location: account.php');
		die();
	}
	if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) )
	{
		$_SESSION['mesaj']="Adresa de email este invalida!";
		header('Location: account.php');
		die();
	}
	if ( !preg_match('/^[A-Za-z]+$/', trim($_POST['nume'])) )
	{
		$_SESSION['mesaj']="Numele este invalid!";
		header('Location: account.php');
		die();
	}
	if ( !preg_match('/^[A-Za-z]+$/', trim($_POST['prenume'])) )
	{
		$_SESSION['mesaj']="Prenumele este invalid!";
		header('Location: account.php');
		die();
	}
	if($_POST['nume'] != NULL && $_POST['nume'] != $persoana['NUME']);
	{
		$res = mysql_query("UPDATE user SET NUME = '$_POST[nume]' WHERE ID = '$persoana[ID]' ");
		if(!res)
		{
			$_SESSION['mesaj'] = "Eroare mysql";
			header('Location: account.php');
			die();
		}
	}
	
	if($_POST['prenume'] != NULL && $_POST['prenume'] != $persoana['PRENUME']);
	{
		$res = mysql_query("UPDATE user SET PRENUME = '$_POST[prenume]' WHERE ID = '$persoana[ID]' ");
		if(!res)
		{
			$_SESSION['mesaj'] = "Eroare mysql";
			header('Location: account.php');
			die();
		}
	}
	
	if($_POST['adresa'] != NULL && $_POST['adresa'] != $persoana['ADRESA']);
	{
		$res = mysql_query("UPDATE user SET ADRESA = '$_POST[adresa]' WHERE ID = '$persoana[ID]' ");
		if(!res)
		{
			$_SESSION['mesaj'] = "Eroare mysql";
			header('Location: account.php');
			die();
		}
	}
	
	if($_POST['telefon'] != NULL && $_POST['telefon'] != $persoana['NUMAR_TELEFON']);
	{
		$res = mysql_query("UPDATE user SET NUMAR_TELEFON = '$_POST[telefon]' WHERE ID = '$persoana[ID]' ");
		if(!res)
		{
			$_SESSION['mesaj'] = "Eroare mysql";
			header('Location: account.php');
			die();
		}
	}
	
	if($_POST['email'] != NULL && $_POST['email'] != $persoana['EMAIL']);
	{
		$res = mysql_query("UPDATE user SET EMAIL = '$_POST[email]' WHERE ID = '$persoana[ID]' ");
		if(!res)
		{
			$_SESSION['mesaj'] = "Eroare mysql";
			header('Location: account.php');
			die();
		}
	}
	
	if($_POST['cod_postal'] != NULL && $_POST['cod_postal'] != $persoana['COD_POSTAL']);
	{
		$res = mysql_query("UPDATE user SET COD_POSTAL = '$_POST[cod_postal]' WHERE ID = '$persoana[ID]' ");
		if(!res)
		{
			$_SESSION['mesaj'] = "Eroare mysql";
			header('Location: account.php');
			die();
		}
	}
	$_SESSION['introdus'] = "Modificarile au fost salvate";
	header('Location: account.php');
	die();
?>
