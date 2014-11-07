<?php 
	require "Jscripts.php";
	$pagina=$_SESSION["pg"];
	$user = trim($_POST["user"]);
	$parola=$_POST["password"];
	$pw = SHA1($_POST["password"]);
	if ( !preg_match('/^[A-Za-z$*!_.0-9]+$/', $user) && $user != NULL )
	{
		$_SESSION['mesaj']="Numele utilizatorului contine caractere invalide!";
		header('location:'.$pagina);
		die();
	}
	else
	{
		$user = mysql_real_escape_string($user);
	}
	$q = mysql_query("SELECT *FROM user WHERE USERNAME='$user' AND PAROLA='$pw'");
	$count = mysql_num_rows($q);
	if ( $user == "" OR $parola == "" )
	{
		$_SESSION["mesaj"]= "Toate spatiile trebuie completate!";
		if ( $user=="" )
		{
			$_SESSION["mesaj"] .='<style>#User{border:1px solid red;}</style>';
		}
		if ( $parola=="" )
		{
			$_SESSION["mesaj"] .= '<style>#Pw{border:1px solid red;}</style>';
		}
		header('location:'.$pagina);
	}
	else if ( !$count )
	{
		$_SESSION["mesaj"]="Numele utilizatorului sau parola gresite!";
		header('location:'.$pagina);
	}
	else if ( isset($_SESSION["connected"] ) )
	{
		$_SESSION["mesaj"]= "Esti deja conectat!";
		header('location:'.$pagina);
	}
	else if ( $count == 1 )
	{
		while ( $res=mysql_fetch_array($q) )
		{
			$_SESSION["user"]=$user;
			$_SESSION["statut"]=$res["STATUT"];
			$_SESSION["email"]=$res["EMAIL"];
			$_SESSION["user_id"]=$res["ID"];
			$_SESSION["adresa"]=$res["ADRESA"];
			$_SESSION["nr_tel"]=$res["NUMAR_TELEFON"];
			$_SESSION["cod_postal"]=$res["COD_POSTAL"];
			$_SESSION["nume"]=$res["NUME"];
			$_SESSION["prenume"]=$res["PRENUME"];
			$_SESSION["image"]=$res["IMAGINE"];
		}
		$_SESSION["introdus"]="Te-ai conectat cu succes!";
		$_SESSION["connected"]="Te-ai conectat cu succes!";
		header('location:'.$pagina);
	}?>
