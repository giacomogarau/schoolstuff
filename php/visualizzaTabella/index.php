<!DOCTYPE html>
<html lang="">
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<?php
echo "Seleziona un database<br>";
$conn=mysqli_connect("localhost","root","widenius") or die("connect");
$list=mysqli_query($conn,"show databases") or die("query");
echo '<form method="POST" action="tabella.php">';
echo '<select name="database">';
while($nome=mysqli_fetch_row($list)){
	echo '<option value="'.$nome[0].'">'.$nome[0];
}
echo '</select>';
echo '<input type="submit" value="Submit" />';
echo '</form>';
?>
</body>
</html>
