<?php
session_start();
require 'module.php';
$ob_id=$_POST["obiect"];
if ( $_POST["specificatie"] == NULL )
{
	$_SESSION["mesaj"] = "Campul trebuie completat!";
	header('location:detalii_obiect.php?obid='.$ob_id);
	die();
}
$specificatie = trim($_POST['specificatie']);
if ( !preg_match("#^[a-zA-Z0-9 \.,;:\?_/'!£\$%&*()+=\r\n-]+$#",$specificatie))
{
	$_SESSION["mesaj"] = "Campul este invalid!";
	header('location:detalii_obiect.php?obid='.$ob_id);
	die();
}
else
{
	$specificatie = mysql_real_escape_string($specificatie);
}
$update = mysql_query("UPDATE obiect SET SPECIFICATIE='$specificatie'  WHERE ID='$ob_id'");
if ( !$update )
{
	die("EROARE MYSQL:".mysql_error());
}
else
{
	$_SESSION["introdus"] = "Specificatia a fost modificata!";
	header('location:detalii_obiect.php?obid='.$ob_id);
}
