<?php
if(isset($_POST["database"]) && !empty($_POST["database"])){
	echo "Seleziona una tabella<br>";
	$conn=mysqli_connect("localhost","root","widenius") or die("connect");
	$query="use ".mysqli_real_escape_string($conn,$_POST["database"]);
	mysqli_query($conn,$query) or die("query1");
	$list=mysqli_query($conn,"show tables") or die("query2");
	echo '<form method="POST" action="tabella2.php">';
	echo '<select name="tabella">';
	while($nome=mysqli_fetch_row($list)){
		echo '<option value="'.$nome[0].'">'.$nome[0];
	}
	echo '</select>';

	echo '<input type="hidden" name="nomedb" value="'.$_POST["database"].'" />';
	echo '<input type="submit" value="Submit" />';
	echo '</form>';
}
else echo "chiamami dalla <a href='index.php'>pagina principale</a>"
?>
