<?php
	require 'inceput.php';
?>
<br>
<a href = "editeaza_categorii.php">Editeaza categorii</a>
<br>
<a href = "editeaza_subcategorii.php">Editeaza subcategorii </a>
<br>
<a href = "editeaza_comenzi.php">Editeaza comnezi</a>
<br>
<a href = "editeaza_obiecte.php">Editeaza obiecte</a>

<form action = "search.php" method = "GET">
	<input name="searchingfor">
	<input type="submit" value="SEARCH">

</form>
<?php
	require 'sfarsit.php';
?>
