<?php
if (isset($_GET["nome"]) && isset($_GET["citta"]) && !empty($_GET["nome"]) && !empty($_GET["citta"])) {
    $nome = mysqli_real_escape_string($conn,$_GET["nome"]);
    $citta = mysqli_real_escape_string($conn,$_GET["citta"]);
    $conn = mysqli_connect("localhost", "root", "") or die("connect");
    mysqli_query($conn, "use musei") or die("use");
    $query = "insert into musei(nome,citta) values('".$nome."','".$citta."')";
    mysqli_query($conn, "$query") or die("insert");
    echo "successo";
    mysqli_close($conn);
}
?>
