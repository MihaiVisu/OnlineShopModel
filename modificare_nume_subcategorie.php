<?php 
	require 'module.php';
	
	if($_POST['nume_nou'] == NULL)
	{
		$_SESSION['mesaj'] = "Numele nu este valid";
		header('Location: editeaza_subcategorii.php');
		die();
	}
	if (!preg_match("#^[a-zA-Z0-9 \.,;\?_/'!£\$%&*()+=\r\n-]+$#",$_POST['nume_nou']))
	{
		$_SESSION['mesaj'] = "Numele subcategoriei nu e valid";
		header('Location: editeaza_subcategorii.php');
		die();
	}
	else
	{
		$_POST["nume_nou"] = mysql_real_escape_string(trim($_POST["nume_nou"]));
	}
	$catsubcat = explode("-",$_POST['nume']);
	$cat = $catsubcat[0];
	$subcat =  $catsubcat[1];
	
	//getting $cat id
	
	$res = mysql_fetch_array(mysql_query("SELECT * FROM categorie WHERE NUME='$cat' ") );
	$cat_id = $res['ID'];
		
	
	$res = mysql_query("SELECT * FROM subcategorie WHERE NUME = '$_POST[nume_nou]' AND CATEGORIE_ID='$cat_id' ");
	if(mysql_num_rows($res)>0)
	{
		$_SESSION['mesaj'] = "Mai exista o subcategorie cu acelasi nume";
		header('Location: editeaza_subcategorii.php');
		die();
	}
	$subcate = mysql_fetch_array(mysql_query("SELECT * FROM subcategorie WHERE NUME = '$subcat' AND CATEGORIE_ID='$cat_id'"));
	$res = mysql_query("UPDATE subcategorie SET NUME = '$_POST[nume_nou]' WHERE ID ='$subcate[ID]' ");
	if(!$res)
	{
		$_SESSION['mesaj'] = "Eroare mysql";
		header('Location: editeaza_subcategorii.php');
		die();
	}

	$_SESSION['introdus'] = "Modificare efectuata cu succes";
	header('Location: editeaza_subcategorii.php');
	?>
