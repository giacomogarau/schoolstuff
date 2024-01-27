<!DOCTYPE html>
<html>

<head>
    <style>
        td,
        th {
            border-width: 3px;
            border-style: solid;
            border-color: black;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET["opera"]) && isset($_GET["autore"]) && isset($_GET["museo"])) {
        $conn = mysqli_connect("localhost", "root", "") or die("connect");
        $opera = mysqli_real_escape_string($conn,$_GET["opera"]);
        $autore = mysqli_real_escape_string($conn,$_GET["autore"]);
        $museo = mysqli_real_escape_string($conn,$_GET["museo"]);
        


        mysqli_query($conn, "use musei") or die("use");
        $query = 'select titolo,artisti.nome,musei.nome from opere,artisti,musei where museo=musei.id && autore=artisti.id && titolo like "%'.$opera.'%" && artisti.nome like "%'.$autore.'%" && musei.nome like "%'.$museo.'%"' ;
        //echo $query;
        $ris = mysqli_query($conn, $query) or die("select");
        echo "<table>";
        echo "<tr>";
        echo "<th>titolo</th>";
        echo "<th>nome autore</th>";
        echo "<th>nome museo</th>";
        echo "</tr>";

        while ($riga = mysqli_fetch_row($ris)) {
            echo "<tr>";
            for ($i = 0; $i < 3; $i++)
                echo "<th>" . $riga[$i] . "</th>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_close($conn);
    }
    ?>
</body>

</html>
