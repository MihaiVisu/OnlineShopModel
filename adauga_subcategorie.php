<?php
	require 'module.php';
	
	if($_POST['nume'] == NULL)
	{
		$_SESSION['mesaj'] = "Numele subcategoriei nu e valid";
		header('Location: editeaza_subcategorii.php');
		die();
	}
	if (!preg_match("#^[a-zA-Z0-9 \.,;\?_/'!£\$%&*()+=\r\n-]+$#",$_POST['nume']))
	{
		$_SESSION['mesaj'] = "Numele subcategoriei nu e valid";
		header('Location: editeaza_subcategorii.php');
		die();
	}
	else
	{
		$_POST["nume"] = mysql_real_escape_string(trim($_POST["nume"]));
	}
	//luam idul de categorie
	$row = mysql_fetch_array(mysql_query("SELECT * FROM categorie WHERE NUME = '$_POST[categorie]' ") );
	$id = $row['ID'];
	$result = mysql_query("SELECT * FROM subcategorie WHERE NUME='$_POST[nume]' AND CATEGORIE_ID='$id' ");
	if(mysql_num_rows($result))
	{
		$_SESSION['mesaj'] = "Mai exista o subcategorie cu acelasi nume si in aceeasi categorie";
		header('Location: editeaza_subcategorii.php');
		die();
	}
	
	$result = mysql_query("INSERT INTO subcategorie (NUME,CATEGORIE_ID) VALUES ('$_POST[nume]', $id)");
	if(!$result)
	{
		$_SESSION['mesaj'] = "Categorie invalida!";
		header('Location: editeaza_subcategorii.php');
		die();
	} 
	$_SESSION['introdus'] = "Subcategorie adaugata";
	header('Location: editeaza_subcategorii.php');
		
?>
