<?php
if(!empty($_GET["nome"]) && !empty($_GET["nazione"]) && !empty($_GET["anno"]) && isset($_GET["nome"]) && isset($_GET["nazione"]) && isset($_GET["anno"]) ){
	$nome=$_GET["nome"];
	$nazione=$_GET["nazione"];
	$anno=$_GET["anno"];
	$conn=mysqli_connect("localhost","root","widenius") or die("connect");
	mysqli_query($conn,"use cinema") or die("use");
	//insert into attori (nome,annoNascita,nazione) values ("1","2","3");
	//echo 'insert into attori (nome,annoNascita,nazione) values ("'.$nome.'","'.$anno.'","'.$nazione.'")';
	mysqli_query($conn,'insert into attori (nome,annoNascita,nazione) values ("'.$nome.'","'.$anno.'","'.$nazione.'")') or die("insert");
	echo "Aggiunto<br>";
	echo '<a href="aggiungiAttore.html">Torna indietro</a>';
}
?>
