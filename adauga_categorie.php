<?php
	require 'module.php';
	
	if($_POST['nume'] == NULL )
	{
		$_SESSION['mesaj'] = "Numele categoriei nu e valid";
		header('Location: editeaza_categorii.php');
		die();
	}
	if (!preg_match("#^[a-zA-Z0-9 \.,;\?_/'!£\$%&*()+=\r\n-]+$#",$_POST['nume']))
	{
		$_SESSION['mesaj'] = "Numele categoriei nu e valid";
		header('Location: editeaza_categorii.php');
		die();
	}
	else
	{
		$_POST["nume"] = mysql_real_escape_string(trim($_POST["nume"]));
	}
	$result  = mysql_query("SELECT * FROM categorie WHERE NUME = '$_POST[nume]' ");
	if(mysql_num_rows($result))
	{
		$_SESSION['mesaj'] = "Mai exista o categorie cu acelasi nume";
		header('Location: editeaza_categorii.php');
		die();
	}
	
	$result = mysql_query("INSERT INTO categorie (NUME) VALUES ('$_POST[nume]')");
	if(!$result)
	{
		$_SESSION['mesaj'] = "Eroare mysql".mysql_error();
		header('Location: editeaza_categorii.php');
		die();
	} 
	$_SESSION['introdus'] = "Categorie adaugata";
	header('Location: editeaza_categorii.php');
		
?>
