<?php
	require 'module.php';
	//variabile...
	$user = $_SESSION['user'];
	$obiect_id = $_POST["obid"];
	$cantitate = $_POST["cant"];
	$page = $_POST["page"];
	$id = $_SESSION["user_id"];
	//verificam stocul
	$ob = mysql_fetch_array(mysql_query("SELECT * FROM obiect WHERE ID = '$obiect_id' "));
	if ( !is_numeric($cantitate) )
	{
		$_SESSION["mesaj"]="Cantitatea trebuie sa fie un numar!";
		header('location:'.$page);
	}
	else if($ob['CANTITATE']<$cantitate)
	{
		$_SESSION["mesaj"] = "Nu exista atatea produse pe stoc!";
		header('location:'.$page);
	}
	else if($cantitate<=0)
	{
		$_SESSION["mesaj"] = "Cantitatea trebuie sa fie pozitiva!";
		header('location:'.$page);
	}
	else
	{
		$verify = mysql_query("SELECT *FROM cos WHERE OBIECT_ID='$obiect_id' AND USER_ID='$id'");
		if ( mysql_num_rows($verify) > 0 )
		{
			$q = mysql_fetch_array($verify);
			$new_q=$cantitate+$q["CANTITATE"];
			$up = mysql_query("UPDATE cos SET CANTITATE='$new_q' WHERE OBIECT_ID='$obiect_id' AND USER_ID='$id'");
			if ( !$up )
			{
				die("EROARE MYSQL:".mysql_error());
			}
			else
			{
				$rest = $ob['CANTITATE']-$cantitate;
				$change_q=mysql_query("UPDATE obiect SET CANTITATE='$rest' WHERE ID='$obiect_id'");
				if ( !$change_q )
				{
					die("EROARE MYSQL:".mysql_error());
				}
				$_SESSION["introdus"] = "Produsul a fost adaugat in cos!";
				header('Location:'.$page);
			}
		}
		else
		{
			$data=date("Y-m-d");
			$nume=$ob["NUME"];
			$pret=$ob["PRET"];
			$res = mysql_query("INSERT INTO cos (OBIECT_ID, USER_ID, CANTITATE,NUME,PRET,DATA) VALUES ('$obiect_id','$id','$cantitate','$nume','$pret','$data') ");
			if(!$res)
			{
				die("EROARE MYSQL:".mysql_error());		
			}
			else
			{
				$data = date("Y-m-d");
				$rest = $ob['CANTITATE']-$cantitate;
				$change_q=mysql_query("UPDATE obiect SET CANTITATE='$rest', DATA='$data' WHERE ID='$obiect_id'");
				if ( !$change_q )
				{
					die("EROARE MYSQL:".mysql_error());
				}
				$_SESSION["introdus"] = "Produsul a fost adaugat in cos!";
				header('Location:'.$page);
			}
		}
	}
?>
