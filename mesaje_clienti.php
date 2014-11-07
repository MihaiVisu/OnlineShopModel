<?php
	require 'test.php';
	if ( $_SESSION["statut"]!=2 && $_SESSION["statut"]!=3 )
	{
		echo '<div class="main_shadow"><div class="main_div" align="center">';
		die("<h1>Nu ai destule permisiuni pentru a accesa aceasta pagina!</h1>");
		echo '</div></div>';
	}
?>
<style>
	.over_message:hover
	{
		background:#CCFFCC;
	}
</style>
	<div class="main_shadow">
		<div class="main_div">
			<div id="leftdiv_title">
				<h2 align="center" style="color:white; font-family:Helvetica; line-height:50%;">Mesaje clienti </h2>
				<hr>
			</div>
		<?php
			
			$result1 = mysql_query("SELECT * FROM mesaj WHERE VAZUT='0' ORDER BY ID DESC");
			if(!mysql_num_rows($result1))
			{
				?>
				<h3 align="center">Nu exista mesaje noi!</h3>
				<?php
			}
			else
			{
				while($row = mysql_fetch_array($result1))
				{
					?>
					
					<br><div class = 'over_message'>
					Nume: <?php echo $row['NUME']; ?> <br>
					Data: <?php echo $row['DATETIME']; ?><br>
					Email: <?php echo $row['EMAIL']; ?><br>
					Telefon: <?php echo $row['TELEFON']; ?><br><br>
					<b>Mesaj:</b> <?php echo $row['MESAJ']; ?>
					<span style="display:block;" align="right"><a href="marcheaza_mesaj.php?id=<?php echo $row['ID']; ?>">Marcheaza mesajul ca citit</a></span>
					<hr>
					</div>
					<?php				
				}			
			}
			?>
			
		</div>
	</div>
	<script>
		$(".main_shadow,.main_div,#leftdiv_title").corner("top");
		$("h3").corner();
	</script>
</body>
</html>
