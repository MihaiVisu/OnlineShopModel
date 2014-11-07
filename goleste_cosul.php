<?php
	require 'module.php';
	
	if(!isset($_SESSION['user']) || $_SESSION["statut"] != 1)
	{
		//trebe sa se logheze baiatu
		$_SESSION["mesaj"]="Nu poti accesa aceasta pagina!";
		header('Location: cosul_meu.php');
		exit;
	}
	$user = $_SESSION['user']; //luam idu de user
	$id = $_SESSION["user_id"];
	$sel = mysql_query("SELECT *FROM cos WHERE USER_ID='$id'");
	while ( $g = mysql_fetch_array($sel) )
	{
		$qnt=$g["CANTITATE"];
		$object = $g["OBIECT_ID"];
		$get_ob=mysql_fetch_array(mysql_query("SELECT *FROM obiect WHERE ID='$object'"));
		$new_quantity = $get_ob["CANTITATE"] + $qnt;
		$update = mysql_query("UPDATE obiect SET CANTITATE = $new_quantity WHERE ID='$object'");
		if ( !$update )
		{
			die("EROARE MYSQL:".mysql_error());
		}
		$goleste=mysql_query("DELETE FROM cos WHERE USER_ID='$id'");
		if( !$goleste )
		{
			die("EROARE MYSQL:".mysql_error());
		}
		else
		{
			$_SESSION["introdus"] = "Cosul a fost golit!";
			header("location: cosul_meu.php");
		}
	}
?>
