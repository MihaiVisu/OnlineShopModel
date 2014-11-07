<?php
	require 'module.php';
	$res = mysql_query("DELETE FROM comentariu WHERE ID = '$_GET[id]' ");
	if(!res)
	{
		$_SESSION['mesaj'] = "Eroare mysql";
		header('Location: detalii_obiect.php?obid='.$_GET['obid']);
		die();
	}
	$_SESSION['introdus'] = "Comentariu sters";
	
	header('Location: detalii_obiect.php?obid='.$_GET['obid']);
	
	?>
