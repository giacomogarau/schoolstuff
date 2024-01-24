<html>
<head>
<style>
td, th{
	border-width:1px;
	border-style:solid;
	border-color:black;
}
</style>
</head>
<?php
if(isset($_POST["nomedb"]) && !empty($_POST["nomedb"]) && isset($_POST["tabella"]) && !empty($_POST["tabella"])){
	$nomedb=$_POST["nomedb"];
	$tabella=$_POST["tabella"];
	$conn=mysqli_connect("localhost","root","widenius") or die("connect");
	$query="use ".$nomedb;
	mysqli_query($conn,$query) or die("query1");
	$query2="select * from ".$tabella;
	$query3="describe ".$tabella;
	$listquery2=mysqli_query($conn,$query2) or die("query2");
	$listquery3=mysqli_query($conn,$query3) or die("query3");
	echo "<table>";
	echo "<tr>";
	while($riga=mysqli_fetch_row($listquery3)){
		echo "<th>";
		echo $riga[0];
		echo "</th>";
	}
	echo "</tr>";
	while($riga=mysqli_fetch_row($listquery2)){
		echo "<tr>";
		for($i=0;$i<sizeof($riga);$i++){
			echo "<td>";
			echo $riga[$i];
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}
else echo "chiamami dalla <a href='index.php'>pagina principale</a>";
?>
</html>
