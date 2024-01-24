<!DOCTYPE HTML>

<head>
</head>

<body>
<?php
	$conn = mysqli_connect("localhost", "root", "widenius") or die("connect");
	mysqli_query($conn, "use musei") or die("use");
	$queryAttori = "select nome,id from artisti";
	$queryMusei = "select nome,id from musei";
	$risAttori = mysqli_query($conn,$queryAttori) or die("select attori");
	$risMusei = mysqli_query($conn,$queryMusei) or die("select musei");
	$i=0;
	while($riga=mysqli_fetch_array($risAttori, MYSQLI_ASSOC)){
		$nomiAttori[$i]=$riga["nome"];
		$idAttori[$i]=$riga["id"];
		//echo $nomiAttori[$i];
		$i++;
	}
	mysqli_free_result($risAttori);
	$i=0;
	while($riga=mysqli_fetch_array($risMusei, MYSQLI_ASSOC)){
		$nomiMusei[$i]=$riga["nome"];
		$idMusei[$i]=$riga["id"];
		//echo $nomiMusei[$i];
		$i++;
	}
	mysqli_free_result($risMusei);
	if(isset($_GET["nomeOpera"]) && isset($_GET["idAttore"]) && isset($_GET["idMuseo"]) && !empty($_GET["nomeOpera"]) && !empty($_GET["idAttore"]) && !empty($_GET["idMuseo"])){
		$nomeOpera=$_GET["nomeOpera"];
		$idAttore=$_GET["idAttore"];
		$idMuseo=$_GET["idMuseo"];
		$query='insert into opere(titolo,museo,autore) values("'.$nomeOpera.'","'.$idMuseo.'","'.$idAttore.'")';
		//echo $query;
		mysqli_query($conn,$query) or die("query");
	}else{
		echo "<form method='GET' action='aggiungiopera.php'>";
		echo "Nome opera: <input type='text' name='nomeOpera' /><br />";
		echo "<select name='idAttore'>";
		for($i=0;$i<sizeof($idAttori);$i++){
			echo "<option value=".$idAttori[$i].">".$nomiAttori[$i]."<br/>";

		}
		echo "</select>";
		echo "<select name='idMuseo'>";
		for($i=0;$i<sizeof($idMusei);$i++){
			echo "<option value=".$idMusei[$i].">".$nomiMusei[$i]."<br/>";

		}
		echo "</select>";

		echo "<input type='submit' value='Submit' />";
		echo "</form>";
	}
	mysqli_close($conn);
	/*
	 * struttura form
	<form method="GET" action="aggiungiopera.php">
        Nome opera: <input type="text" name="nome" /><br />

    </form>
	*/

?>

</body>
