<?php 
	require 'module.php';    // cam toate functiile intra aici
	
	// ne conectam la DB
	
	$link = mysql_connect('localhost', 'tractorii', 'Pf9XyveMB27M8BU3');
	if (!$link) {
          die("conectare nereusita");
	}
	mysql_select_db("tml_tractorii",$link);
	
?>
<html>
	<head>
		<title>Magazin online</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		
		
	</head>
	<body bgcolor="#EEEEEE">
		<table border="1" width="90%" align = "center" height="90%">
			<tr align="center">
				<td width="15%" height="20%" align = "center" valign="center">
					Magazin Online
				</td>
				<td colspan="4" width="60%">
					cele mai bune oferte
				</td>
				<td width="25%">
					Casuta cu login
				</td>
			</tr>
			<tr align="center" height="10%">
				<td width="15%">
					Produse
				</td>
				<td width="15%">
					Acasa
				</td>
				<td width="15%">
					Cum cumpar?
				</td>
				<td width="15%" >
					Despre Noi
				</td>
				<td width="15%">
					Contact
				</td>
				<td width="25%">
					Mototras de cautare
				</td>
			</tr>
			<tr  align="center">
				<td>
					<table>
						<?php
							// aduc categoriile principale
							$result = mysql_query("SELECT * FROM categorie");
							while($row = mysql_fetch_array($result))
							{
								?>
								<tr>
									<td>
										<?php
											echo $row['NUME'];
										?>
									</td>
								</tr>
							<?php
							}					
						?>
					</table>
				</td>
				<td colspan="5">
					
				
