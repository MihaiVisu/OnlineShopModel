<?php 
	require 'module.php';
	$_POST["nume"]=trim($_POST["nume"]);
	if($_POST['nume'] == NULL)
	{
		$_SESSION['mesaj'] = "Numele nu este valid";
		header('Location: '.$_POST['page']);
		die();
	}
	if (!preg_match("#^[a-zA-Z0-9 \.,;\?_/'!£\$%&*()+=\r\n-]+$#",$_POST['nume']))
	{
		$_SESSION['mesaj']="Numele obiectului nu este valid!";
		header('Location: '.$_POST['page']);
		die();
	}
	else
	{
		$_POST["nume"]=mysql_real_escape_string($_POST["nume"]);
	}
	$res = mysql_query("SELECT * FROM obiect WHERE NUME = '$_POST[nume]' ");
	if(mysql_num_rows($res)>0)
	{
		$_SESSION['mesaj'] = "Mai exista un obiect cu acelasi nume";
		header('Location: '.$_POST['page']);
		die();
	}
	
	$res = mysql_query("UPDATE obiect SET NUME = '$_POST[nume]' WHERE ID='$_POST[obid]' ");
	if(!$res)
	{
		$_SESSION['mesaj'] = "Eroare mysql";
		header('Location: '.$_POST['page']);
		die();
	}
	$_SESSION['introdus'] = "Modificare efectuata cu succes";
	header('Location: '.$_POST['page']);
	?>
