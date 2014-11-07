<?php
	require 'module.php';
	$page = $_GET["page"];
	$id = $_GET['obid'];
	$ver = mysql_query("SELECT * FROM obiect WHERE ID = '$id' ");
	$row = mysql_fetch_array($ver);
	$cos = mysql_query("SELECT *FROM cos WHERE OBIECT_ID='$id'");
	if ( $_SESSION["statut"] != 2 && $page != 'cosul_meu.php')
	{
		$_SESSION["mesaj"] = "Nu ai destule permisiuni pentru a accesa aceasta pagina!";
		header('Location: '.$page);
	}
	else if ( mysql_num_rows($ver) == 0 && mysql_num_rows($cos)==0 )
	{
		$_SESSION["mesaj"] = "Nu exista acest obiect!";
		header('Location: '.$page);
	}
	else
	{
		$file = $row['IMAGINI'];
		if ( $page != 'cosul_meu.php' )
		{
			unlink('Upload_Imagini/'.$file);
			$del = mysql_query("DELETE FROM obiect WHERE ID = '$id'");
			if ( !$del )
			{
				die("EROARE MYSQL:".mysql_error());
			}
			$delcos= mysql_query("DELETE FROM cos WHERE OBIECT_ID = '$id'");
			if ( !$delcos )
			{
				die("EROARE MYSQL:".mysql_error());
			}
			$_SESSION["introdus"]="Produsul a fost sters!";
		}
		else
		{
			$cant = mysql_fetch_array($cos);
			$qnt = $row["CANTITATE"]+$cant["CANTITATE"];
			$update=mysql_query("UPDATE obiect SET CANTITATE='$qnt' WHERE ID='$id'");
			if ( !$update )
			{
				die("EROARE MYSQL:".mysql_error());
			}
			$delete = mysql_query("DELETE FROM cos WHERE OBIECT_ID = '$id'");
			if ( !$delete)
			{
				die("EROARE MYSQL:".mysql_error());
			}
			$_SESSION["introdus"]="Produsul a fost sters!";
		}
		header('Location:'.$page);
	}	
?>
