<?php
	require 'module.php';
	
	if($_SESSION["statut"]!=1)
	{
		$_SESSION['mesaj'] = "Nu esti logat";
		header('Location: cosul_meu.php');
		
	}
	
	$user = $_SESSION['user'];
	
		//luam idu de user
	$row = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE USERNAME = '$user' ") );
	$user_id = $row['ID'];
	
	//facem comanda
	
	$res = mysql_query("INSERT INTO comanda (USER_ID, DATETIME, SUMA) VALUES ('$user_id', NOW(),'$_GET[suma]' ) ");
	if(!res)
	{
		$_SESSION['mesaj'] = "Eroare mysql";
		header('Location: cosul_meu.php');
	}
	
	//getting idul de comada
	$com_id=1;
	$res = mysql_query("SELECT * FROM comanda WHERE USER_ID='$user_id' ");
	while($row = mysql_fetch_array($res))
	{
		$com_id = $row['ID'];
	}
	
	//facem obiectele
	
	$res = mysql_query("SELECT * FROM cos WHERE USER_ID='$user_id' ");
	while($row=mysql_fetch_array($res))
	{
		//trebe obiectu in sine
		$ob = mysql_fetch_array(mysql_query("SELECT * FROM obiect WHERE ID = '$row[OBIECT_ID]' "));
		
		$result = mysql_query("INSERT INTO obiect_comanda (COMANDA_ID, OBIECT_ID, CANTITATE, NUME) VALUES ('$com_id','$row[OBIECT_ID]','$row[CANTITATE]','$ob[NUME]') ");
		 
	}
	
	
	//golim cosul
	
	$res = mysql_query(" DELETE FROM cos WHERE USER_ID='$user_id' ");
	$_SESSION['introdus'] = "Comanda a fost finalizata";
	header('Location: index.php');
?>
