<?php

require 'module.php';
session_start();
//Variabile------------------------------

$_SESSION["enume"]=$nume = $_POST["nume"];
$_SESSION["eprenume"]=$prenume = $_POST["prenume"];
$_SESSION["eemail"]=$email = $_POST["email"];
$_SESSION["eusername"]=$username= $_POST["username"];
$_SESSION["eparola"]=$parola = $_POST["parola"];
$hashed_pw = SHA1($parola);
$_SESSION["everif_parola"]=$verif_parola = $_POST["verif_parola"];
$_SESSION["eadresa"]=$adresa = $_POST["adresa"];
$_SESSION["epostal"]=$postal = $_POST["postal"];
$_SESSION["enrtel"]=$nrtel = $_POST["nrtel"];


if ( !$nume || !$prenume || !$email || !$username || !$parola || !$verif_parola )
{
	$_SESSION["mesaj"] .= "Toate spatiile sunt obligatorii! <br>";
	header('location:operator_telefonic.php');
	die();
}
if (!preg_match('/^[A-Za-z]+$/', trim($nume)) )
{
	$_SESSION['mesaj'] .="Numele este invalid! <style>#nume{border:1px solid red;}</style> <br>";
	header('location:operator_telefonic.php');
}
if (!preg_match('/^[A-Za-z]+$/', trim($prenume)) )
{
	$_SESSION['mesaj'] .="Prenumele este invalid! <style>#prenume{border:1px solid red;}</style> <br>";
	header('location:operator_telefonic.php');
}
if ( !preg_match('/^[A-Za-z$_!*.0-9]+$/', trim($username)) )
{
	$_SESSION['mesaj'] .="Nume de utilizator invalid! <style>#username{border:1px solid red;}</style> <br>";
	header('location:operator_telefonic.php');
}
if ( $parola != $verif_parola )
{
	$_SESSION["mesaj"] .= "Parola nu coincide cu verificarea! <style>#parola,#verif_parola {border:1px solid red;}</style> <br>";
	header('location:operator_telefonic.php');
}

if ( !filter_var($email,FILTER_VALIDATE_EMAIL) )
{
	$_SESSION["mesaj"] .= "Adresa de email  nu e valida!<style>#email {border:1px solid red;}</style> <br>";
	header('location:operator_telefonic.php');
}
if ( !isset($_SESSION["mesaj"]) )
{
	//----------------------------------------
	$verif_email = mysql_query("SELECT *FROM user WHERE EMAIL ='$email'");
	$verif_user = mysql_query("SELECT *FROM user WHERE USERNAME='$username'");
	//----------------------------------------
	if ( mysql_num_rows($verif_user) > 0)
	{
		$_SESSION["mesaj"] .= "Numele de utilizator ales exista deja in baza de date! <style>#username {border:1px solid red;}</style> <br>";
		header('location:operator_telefonic.php');
	}

	if ( mysql_num_rows($verif_email) > 0 )
	{
		$_SESSION["mesaj"] .= "Adresa de email aleasa exista deja in baza de date! <style>#email {border:1px solid red;}</style> <br>";
		header('location:operator_telefonic.php');
	}
}
if ( !isset($_SESSION["mesaj"]) )
{
	$statut = 3;
	$q = mysql_query("INSERT INTO user(NUME,PRENUME,USERNAME,PAROLA,EMAIL,ADRESA,COD_POSTAL,NUMAR_TELEFON,STATUT,IMAGINE) 
					  VALUES('$nume','$prenume','$username','$hashed_pw','$email','$adresa','$postal','$nrtel','$statut','NoImage.png')");
	if ( !$q )
	{
		die("EROARE MYSQL:".mysql_error());
	}
	else
	{
		$_SESSION["introdus"] = "Contul a fost creat cu succes!";
		unset($_SESSION["enume"]);
		unset($_SESSION["eprenume"]);
		unset($_SESSION["eemail"]);
		unset($_SESSION["eusername"]);
		unset($_SESSION["eparola"]);
		unset($_SESSION["everif_parola"]);
		header('location:operator_telefonic.php');
		exit;
	}
}
