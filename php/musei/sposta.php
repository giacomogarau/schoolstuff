<!DOCTYPE html>
<html>

<body>

    <?php
    $conn = mysqli_connect("localhost", "root", "") or die("connect");
    mysqli_query($conn, "use musei") or die("use");
    $queryOpere = "select * from opere";
    $ris = mysqli_query($conn, "$queryOpere") or die("select opere");
    $i = 0;
    while ($riga = mysqli_fetch_array($ris, MYSQLI_ASSOC)) {
        $titoloOpera[$i] = $riga["titolo"];
        $idOpera[$i] = $riga["id"];
        $i++;
    }
	mysqli_free_result($ris);
    $queryMusei = "select * from musei";
    $ris = mysqli_query($conn, "$queryMusei") or die("select musei");
    $i = 0;
    while ($riga = mysqli_fetch_array($ris, MYSQLI_ASSOC)) {
        $nomeMusei[$i] = $riga["nome"];
        $idMusei[$i] = $riga["id"];
        $cittaMusei[$i] = $riga["citta"];
        $i++;
    }
	mysqli_free_result($ris);

    if ((!empty($_GET["idOpera"]) || !isset($_GET["idMuseo"])) && !empty($_GET["idOpera"]) && !empty($_GET["idMuseo"])) {
        $opera = mysqli_real_escape_string($conn,$_GET["idOpera"]);
        $pos=array_search($opera, $idOpera);
        $museo = mysqli_real_escape_string($conn,$_GET["idMuseo"]);
        $pos2=array_search($museo, $idMusei);
        if ($pos == $pos2) {
            die("Stai spostando l'opera allo stesso museo");
        }
        if ($cittaMusei[$pos] == $cittaMusei[$pos2]) {
            die("Stai spostando l'opera ad un museo nella stessa città");
        }
        $query = "update opere set museo='" . $museo . "' where id='" . $opera . "'";
        mysqli_query($conn,$query) or die("update");

    } else {
        echo "<form method='GET' action='sposta.php'>";
        echo "<select name='idOpera'>";
        for ($i = 0; $i < sizeof($idOpera); $i++) {
            echo "<option value=" . $idOpera[$i] . ">" . $titoloOpera[$i] . "<br/>";
        }
        echo "</select>";
        echo "<select name='idMuseo'>";
        for ($i = 0; $i < sizeof($idOpera); $i++) {
            echo "<option value=" . $idMusei[$i] . ">" . $nomeMusei[$i] . "<br/>";
        }
        echo "</select>";
        echo "<input type='submit' value='Submit' />";
        echo "</form>";
    }
    mysqli_close($conn);
    ?>
</body>

</html>
