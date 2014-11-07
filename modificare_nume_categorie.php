<?php 
	require 'module.php';
	
	if($_POST['nume_nou'] == NULL || $_POST['nume']==NULL)
	{
		$_SESSION['mesaj'] = "Numele nu este valid";
		header('Location: editeaza_categorii.php');
		die();
	}
	if (!preg_match("#^[a-zA-Z0-9 \.,;\?_/'!£\$%&*()+=\r\n-]+$#",$_POST['nume_nou']))
	{
		$_SESSION['mesaj'] = "Numele categoriei nu e valid";
		header('Location: editeaza_categorii.php');
		die();
	}
	else
	{
		$_POST["nume_nou"] = mysql_real_escape_string(trim($_POST["nume_nou"]));
	}
	$res = mysql_query("SELECT * FROM categorie WHERE NUME = '$_POST[nume_nou]' ");
	if(mysql_num_rows($res)>0)
	{
		$_SESSION['mesaj'] = "Mai exista o categorie cu acelasi nume";
		header('Location: editeaza_categorii.php');
		die();
	}
	$cat = mysql_fetch_array(mysql_query("SELECT * FROM categorie WHERE NUME = '$_POST[nume]'"));
	$res = mysql_query("UPDATE categorie SET NUME = '$_POST[nume_nou]' WHERE ID ='$cat[ID]' ");
	if(!$res)
	{
		$_SESSION['mesaj'] = "Eroare mysql";
		header('Location: editeaza_categorii.php');
		die();
	}

	$_SESSION['introdus'] = "Modificare efectuata cu succes";
	header('Location: editeaza_categorii.php');
	?>
