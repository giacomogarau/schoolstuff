<?php
$conn = mysqli_connect("localhost", "root", "widenius") or die("connect");
mysqli_query($conn, "use cibo") or die("use");
$query = "select id,descrizione from pietanze";
$ris = mysqli_query($conn, $query) or die("select");
$i=0;
while($ln=mysqli_fetch_row($ris)){
	$idmatch[$i]=$ln[0];
	$namematch[$i]=$ln[1];
}
echo "possibili corrispondenze:<br>"
for($i=0;$i<sizeof($namematch);$i++){
	echo $namematch[$i]."<br>";
}
$query="select ingrediente from utilizza where pietanza=".$idmatch[$i];
for($i=0;$i<sizeof($idmatch);$i++){
	$ris[$i] = mysqli_query($conn, $query[$i]) or die("select");
	$ris[$i]=mysqli_fetch_row($ris[$i]);
}

for($i=0;$i<sizeof($ris);$i++){

}
?>
