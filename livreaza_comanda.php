<?php
	require 'module.php';
	
	
	$res = mysql_query("UPDATE comanda SET STATUS = '3' WHERE ID = '$_GET[id]' ");
	
	header('Location: comenzi_in_asteptare.php');
?>

