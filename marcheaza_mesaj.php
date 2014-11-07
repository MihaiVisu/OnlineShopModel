<?php
	require 'module.php';
	
	$res = mysql_query("DELETE FROM mesaj WHERE ID = '$_GET[id]' ");
	if(!$res)
	{
		$_SESSION['mesaj'] = "Eroare la stergerea mesajului";
		header('Location: mesaje_clienti.php');
		die();
	} 
	$_SESSION['introdus'] = "Mesaj marcat";
	header('Location: mesaje_clienti.php');
?>
