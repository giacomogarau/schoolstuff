<?php
if(!empty($_GET["nome"]) && !empty($_GET["nazione"]) && !empty($_GET["anno"]) && isset($_GET["nome"]) && isset($_GET["nazione"]) && isset($_GET["anno"]) ){
	$conn=mysqli_connect("localhost","root","widenius") or die("connect");
	$nome=mysqli_real_escape_string($conn,$_GET["nome"]);
	$nazione=mysqli_real_escape_string($conn,$_GET["nazione"]);
	$anno=mysqli_real_escape_string($conn,$_GET["anno"]);
	mysqli_query($conn,"use cinema") or die("use");
	//insert into attori (nome,annoNascita,nazione) values ("1","2","3");
	//echo 'insert into attori (nome,annoNascita,nazione) values ("'.$nome.'","'.$anno.'","'.$nazione.'")';
	mysqli_query($conn,'insert into attori (nome,annoNascita,nazione) values ("'.$nome.'","'.$anno.'","'.$nazione.'")') or die("insert");
	echo "Aggiunto<br>";
	echo '<a href="aggiungiAttore.html">Torna indietro</a>';
}
?>
