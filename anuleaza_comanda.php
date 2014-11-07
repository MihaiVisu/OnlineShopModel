<?php
	require 'module.php';
	
	
	$res = mysql_query("UPDATE comanda SET STATUS = '4' WHERE ID = '$_GET[id]' ");
	$res= mysql_query("SELECT * FROM obiect_comanda WHERE COMANDA_ID='$_GET[id]' ");
	while($row = mysql_fetch_array($res))
	{
		$cant = $row['CANTITATE'];
		$ob = mysql_fetch_array(mysql_query(" SELECT * FROM obiect WHERE ID='$row[OBIECT_ID]' "));
		$cant = $cant + $ob['CANTITATE'];
		$update = mysql_query("UPDATE obiect SET CANTITATE = $cant WHERE ID='$row[OBIECT_ID]'");
	}
	
	
	header('Location: comenzi_in_asteptare.php');
?>
