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
$conn=mysqli_connect("localhost","root","widenius") or die("connect");
mysqli_query($conn,"use cinema");
$query1="select * from attori";
$query2="describe attori";
$listquery1=mysqli_query($conn,$query1) or die("query1");
$listquery2=mysqli_query($conn,$query2) or die("query2");
echo "<table>";
echo "<tr>";
	while($riga=mysqli_fetch_row($listquery2)){
		echo "<th>";
		echo $riga[0];
		echo "</th>";
	}
	echo "</tr>";
	while($riga=mysqli_fetch_row($listquery1)){
		echo "<tr>";
		for($i=0;$i<sizeof($riga);$i++){
			echo "<td>";
			echo $riga[$i];
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
?>
</html>
