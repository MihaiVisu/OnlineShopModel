<?php 
	require 'module.php';
	if($_POST['nume'] == NULL || $_POST['subcategorie'] == NULL || $_POST['specificatie'] == NULL || $_POST['pret'] == NULL || $_POST['cantitate']==NULL)
	{
		$_SESSION["mesaj"]="Toate campurile trebuie completate";
		header("Location: editeaza_obiecte.php");
		exit;
	}
	if ( !preg_match("#^[a-zA-Z0-9 \.,;\?_/'!£\$%&*()+=\r\n-]+$#",$_POST['nume']) )
	{
		$_SESSION["mesaj"]="Numele este invalid!";
		header("Location: editeaza_obiecte.php");
		exit;
	}
	else
	{
		$_POST["nume"] = mysql_real_escape_string(trim($_POST["nume"]));
	}
	if ( !preg_match("#^[a-zA-Z0-9 \.,:;\?_/'!£\$%&*()+=\r\n-]+$#",$_POST['specificatie']) )
	{
		$_SESSION['mesaj']="Specificatiile sunt invalide!";
		header("Location: editeaza_obiecte.php");
		exit;
	}
	else
	{
		$_POST["specificatie"] = mysql_real_escape_string(trim($_POST["specificatie"]));
	}
	if ( !is_numeric($_POST["pret"]) || $_POST["pret"]<0)
	{
		$_SESSION["mesaj"]="Pretul nu este valid!";
		header("Location: editeaza_obiecte.php");
		exit;
	}
	if ( !is_numeric($_POST["cantitate"]) || $_POST["cantitate"]<0)
	{
		$_SESSION["mesaj"]="Cantitatea nu este valida!";
		header("Location: editeaza_obiecte.php");
		exit;
	}
	//trebe sa luam idul subcategoriei
	$row2 = mysql_fetch_array(mysql_query("SELECT * FROM subcategorie WHERE NUME='$_POST[subcategorie]' "));
	$subcat_id = $row2['ID'];
	$res = mysql_query("SELECT * FROM obiect ORDER BY ID DESC");
	$s = mysql_fetch_array($res);
	$id_nou=$s["ID"]+1;
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/png")
	|| ($_FILES["file"]["type"] == "image/pjpeg"))
	&& ($_FILES["file"]["size"] < 2048*2048) // limita 2 megabytes
	&& in_array(strtolower($extension), $allowedExts) )
	{
		if ($_FILES["file"]["error"] > 0)
		{
			die( $_FILES["file"]["error"]);
		}
		else
		{
			$date=date("Y-m-d");
			$nume = $_POST['nume'];
			$verify = mysql_query("SELECT *FROM obiect WHERE NUME='$nume'");
			if ( mysql_num_rows($verify) > 0 )
			{
				$row = mysql_fetch_array($verify);
				$rid=$row["ID"];
				$verifcos=mysql_fetch_array(mysql_query("SELECT *FROM cos WHERE OBIECT_ID='$rid'") );
				$cosid=$verifcos["ID"];
				$upcos= mysql_query("UPDATE cos SET OBIECT_ID='$id_nou', NUME='$nume', PRET='$_POST[pret]' WHERE ID = '$cosid'");
				if ( !$upcos )
				{
					die("EROARE MYSQL:".mysql_error());
				}
				$del = mysql_query("DELETE FROM obiect WHERE NUME='$nume'");
				if ( !$del )
				{
					die("EROARE MYSQL:".mysql_error());
				}
				unlink('Upload_Imagini/'.$row['IMAGINI']);
			}
			
			$imgname .= ".".$extension;
			$result = mysql_query("INSERT INTO obiect (NUME,SUBCATEGORIE_ID,PRET,CANTITATE,SPECIFICATIE,IMAGINI,DATA) VALUES ('$_POST[nume]', '$subcat_id', '$_POST[pret]','$_POST[cantitate]','$_POST[specificatie]','$imgname','$date')");
				if($result)
				{	
					$res = mysql_query("SELECT * FROM obiect");
					while($r = mysql_fetch_array($res))
					{
						$id_nou = $r['ID'];
					}
					$imgname = $id_nou.".".$extension;
					mysql_query("UPDATE obiect SET IMAGINI  = '$imgname' WHERE ID='$id_nou' ");
					move_uploaded_file($_FILES["file"]["tmp_name"],
					"Upload_Imagini/".$id_nou.".".$extension);
					$_SESSION["introdus"]="Obiectul a fost adaugat cu succes!";//obiectul  a fost adaugat;

					header('Location: editeaza_obiecte.php');
					
				}
				else
				{
					die("EROARE MYSQL:".mysql_error());
				}
	    }
    }
	else
	{
		$_SESSION["mesaj"]="Fisierul trebuie sa contina o imagine!";
		header('Location: editeaza_obiecte.php');
		exit;
	}
 
 ?>
