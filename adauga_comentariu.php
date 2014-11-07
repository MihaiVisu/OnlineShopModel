<?php
	require 'module.php';
	
	if($_POST['comment'] == NULL)
	{
		$_SESSION['mesaj'] = "Formularul trebuie completat";
		header('Location: detalii_obiect.php?obid='.$_POST['obiect_id']);
		die();
	}
	if ( !preg_match("#^[a-zA-Z0-9 \.,:;\?_/'!£\$%&*()+=\r\n-]+$#",trim($_POST['comment'])) )
	{
		$_SESSION['mesaj'] = "Mesajul e invalid!";
		header('Location: detalii_obiect.php?obid='.$_POST['obiect_id']);
		die();
	}
	else
	{
		$_POST['comment'] = mysql_real_escape_string(trim($_POST['comment']));
	}
	$result = mysql_query("INSERT INTO comentariu (COMENTARIU,USER_ID,OBIECT_ID,DATETIME) VALUES ('$_POST[comment]','$_POST[user_id]','$_POST[obiect_id]',NOW() ) ");
	if(!$result)
	{
		$_SESSION['mesaj'] = "Eroare mysql";
		header('Location: detalii_obiect.php?obid='.$_POST['obiect_id']);
		die();
	}
	$_SESSION['introdus'] = "Mesaj trimis";
	header('Location: detalii_obiect.php?obid='.$_POST['obiect_id']);
	
?>
