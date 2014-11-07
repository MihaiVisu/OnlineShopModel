<?php
	require 'module.php';
	
	$ob = mysql_fetch_array(mysql_query("SELECT * FROM obiect WHERE ID='$_POST[obid]' "));
	if ( !is_numeric($_POST['cant']) )
	{
		$_SESSION["mesaj"] = "Cantitate invalida!";
		header('Location:'.$_POST['page']);
		exit;
	}
	$cantitate = $ob['CANTITATE'] + $_POST['cant'];
	if ( $cantitate < 0 )
	{
		$_SESSION["mesaj"]="Nu poate exista stoc negativ!";
		header('Location:'.$_POST['page']);
		exit;
	}
	$res = mysql_query("UPDATE obiect SET CANTITATE = '$cantitate' WHERE ID = '$ob[ID]' ");
	if(!res)
	{
		die("Eroare mysql:".mysql_error());
		header('Location: '.$_POST['page']);
		exit;
	}
	$_SESSION['introdus'] = "Stoc reinnoit";
	header('Location: '.$_POST['page']);
?>
