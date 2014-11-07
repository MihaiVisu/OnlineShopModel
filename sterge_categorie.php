<?php
	require 'module.php';
	
	if($_POST['nume'] == NULL)
	{
		$_SESSION['mesaj'] = "Numele categoriei nu e valid";
		header('Location: editeaza_categorii.php');
		die();
	}
	
	//iau categoria
	$cat = mysql_fetch_array(mysql_query("SELECT * FROM categorie WHERE NUME = '$_POST[nume]' "));
	
	//iau subcategoriile cu id de categorie
	
	$res1 = mysql_query("SELECT * FROM subcategorie WHERE CATEGORIE_ID = '$cat[ID]' ");
	while($row1 = mysql_fetch_array($res1))
	{
		$result = mysql_query("SELECT * FROM obiect WHERE SUBCATEGORIE_ID = '$row1[ID]' ");
		while($row2 = mysql_fetch_array($result))
		{
			unlink("Upload_Imagini/".$row2['IMAGINI']);
			mysql_query("DELETE FROM cos WHERE OBIECT_ID='$row2[ID]' ");
			//sterg cosu
			//sterg imaginile
		}
		// in row 1 am subcategoria
		//sterg obiectele cu priCIna
		
		mysql_query("DELETE FROM obiect WHERE SUBCATEGORIE_ID = '$row1[ID]' ");	
	}
	//sterg subcategoriile
	$res = mysql_query("DELETE FROM subcategorie WHERE CATEGORIE_ID = '$cat[ID]' ");
	if(!res)
		die("die hard");
	//sterg categoria
	$res = mysql_query("DELETE FROM categorie WHERE NUME = '$_POST[nume]' ");
	if(!res)
	{
		$_SESSION['mesaj'] = "Eroare mysql";
		header('Location: editeaza_categorii.php');
		die();
	}
	
		
	$_SESSION['introdus'] = "Categorie stearsa";
	header('Location: editeaza_categorii.php');
	die();
?>
