<?php
	require 'module.php';
	
	
	if($_POST['nume'] == NULL)
	{
		$_SESSION['mesaj'] = "Numele subcategoriei nu e valid";
		header('Location: editeaza_subcategorii.php');
		die();
	}
	
	$nume = end(explode("++|--",$_POST['nume']));
	
	$res1 = mysql_query("SELECT * FROM subcategorie WHERE NUME = '$nume' ");
	$row1 = mysql_fetch_array($res1);
	$result = mysql_query("SELECT * FROM obiect WHERE SUBCATEGORIE_ID = '$row1[ID]' ");
	
	while($row2 = mysql_fetch_array($result))
	{
		unlink("Upload_Imagini/".$row2['IMAGINI']);
		mysql_query("DELETE FROM cos WHERE OBIECT_ID='$row2[ID]' ");
		//sterg imaginile
	}
	
		// in row 1 am subcategoria
		//sterg obiectele cu priCIna
	
	mysql_query("DELETE FROM obiect WHERE SUBCATEGORIE_ID = '$row1[ID]' ");	
	
	
	$res = mysql_query("DELETE FROM subcategorie WHERE NUME = '$nume' ");
	if(!res)
	{
		$_SESSION['mesaj'] = "Eroare mysql";
		header('Location: editeaza_subcategorii.php');
		die();
	}
	
	$_SESSION['introdus'] = "Subcategorie stearsa";
	header('Location: editeaza_subcategorii.php');
	

?>
