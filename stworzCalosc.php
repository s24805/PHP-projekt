<?php
session_start();
include('funkcje.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>stwórz pytanie</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>

<body >
    <?php
    //ciecie odpowiedzi z "]"
    $trescpytania=trim($_SESSION['trescPytania'],"\n");
    $trescpytania=trim($trescpytania,"]");
    $typPyt=$_SESSION['typPytania'];
    $pkty=$_SESSION['pktZaPyt'];
    $wynik="$typPyt]$pkty]$trescpytania]";

    if($typPyt=="jednokrotne"){
        $a=str_replace("]", "",$_GET['odp1'] );
        $b=str_replace("]", "",$_GET['odp2'] );
        $c=str_replace("]", "",$_GET['odp3'] );
        $d=str_replace("]", "",$_GET['odp4'] );
        $poprawnaodp=$_GET['poprawnaodp'];

        switch ($poprawnaodp) {
            case 1:
                $poprawnaodp=$a;
                break;
            case 2:
                $poprawnaodp=$b;
                break;
            case 3:
                $poprawnaodp=$c;
                break;
            case 4:
                $poprawnaodp=$d;
                break;
        }

        $wynik.="$a]$b]$c]$d]$poprawnaodp"; //poprawnaodp to dokladna kopia odpowiedzi
    }

    else if($typPyt=="wielokrotne"){
        $a=str_replace("]", "",$_GET['odp1'] );
        $b=str_replace("]", "",$_GET['odp2'] );
        $c=str_replace("]", "",$_GET['odp3'] );
        $d=str_replace("]", "",$_GET['odp4'] );
        $wynik.="$a]$b]$c]$d]";
        $odpWarrayu=array();
        $odpWarrayu[1] = str_replace(" ", "",$a );
        $odpWarrayu[2] = str_replace(" ", "",$b );
        $odpWarrayu[3] = str_replace(" ", "",$c );
        $odpWarrayu[4] = str_replace(" ", "",$d );
        $poprodp = $_GET['odp'];

        foreach ($poprodp as $litera){
            $litera=intval($litera);
        }

        for($i=1;$i<5;$i++){
            if (in_array($i, $poprodp))
                $wynik.="$odpWarrayu[$i] ";
        }

        $wynik=rtrim($wynik);

    }

    else if($typPyt=="wpisz"){
        $a=str_replace("]", "",$_GET['odp1'] );
        $wynik.="$a";
    }

    else if($typPyt=="lista"){
        $a=str_replace("]", "",$_GET['odp1'] );
        $b=str_replace("]", "",$_GET['odp2'] );
        $c=str_replace("]", "",$_GET['odp3'] );
        $d=str_replace("]", "",$_GET['odp4'] );
        $poprawnaodp=$_GET['poprawnaodp'];

        switch ($poprawnaodp) {
            case 1:
                $poprawnaodp=$a;
                break;
            case 2:
                $poprawnaodp=$b;
                break;
            case 3:
                $poprawnaodp=$c;
                break;
            case 4:
                $poprawnaodp=$d;
                break;
        }

        $wynik.="$a]$b]$c]$d]$poprawnaodp"; //poprawnaodp to dokladna kopia odpowiedzi
    }

    else if($typPyt=="dziury"){
        $a=str_replace("]", "",$_GET['odp1'] );
        $a=str_replace("_", "",$a );
        $b=str_replace("]", "",$_GET['cyfry'] );
        $wynik.="$a]$b";// da 1 odpowiedz np K__ica

    }

    else if($typPyt=="sortuj"){
        $a=str_replace("]", "",$_GET['odp1'] );
        $b=str_replace("]", "",$_GET['odp2'] );
        $c=str_replace("]", "",$_GET['odp3'] );
        $d=str_replace("]", "",$_GET['odp4'] );
        $wynik.="$a]$b]$c]$d";
    }

    else if($typPyt=="polacz"){
        $a1=str_replace("]", "",$_GET['odp1a'] );
        $a2=str_replace("]", "",$_GET['odp1b'] );
        $b1=str_replace("]", "",$_GET['odp2a'] );
        $b2=str_replace("]", "",$_GET['odp2b'] );
        $c1=str_replace("]", "",$_GET['odp3a'] );
        $c2=str_replace("]", "",$_GET['odp3b'] );
        $d1=str_replace("]", "",$_GET['odp4a'] );
        $d2=str_replace("]", "",$_GET['odp4b'] );
        $wynik.="$a1]$a2]$b1]$b2]$c1]$c2]$d1]$d2";
    }

    else if($typPyt=="prawda"){
        $a=$_GET['poprawnaodp'];
        $wynik.="$a";
    }

    else {
        Napisz("Podany typ pytania jest niepoprawny: $typPyt. Skontaktuj sie z adminem pozdrawiam");
    }

    //echo $wynik;
    $_SESSION['1wszePytZrob']="jest";
    $wynik=trim($wynik, "\n");
    chdir("pytania");
    $nazwaQuizu=$_SESSION['nazwaQuizu'];
    $nazwaQuizutxt="$nazwaQuizu.txt";
    touch($nazwaQuizutxt);
    $handle = fopen($nazwaQuizutxt, "r+");
    $wsrodku = file_get_contents($nazwaQuizutxt);

    if($wsrodku!=""){
        $dodaj="$wsrodku\n$wynik";
    }

    else
        $dodaj=$wynik;

    file_put_contents($nazwaQuizutxt, $dodaj);
    fclose($handle);

    /*
    $trescpliku = file_get_contents("_lista.txt");
    $wsrodku = file_get_contents("_lista.txt");
    $wsrodku.="\n$nazwaQuizu "

    */

    ?>

    <div>
        <form method="get" action="stworzPytania.php" style='text-align:center'>
            <button type="submit" class="button">Stworz kolejne pytanie</button>
        </form><br>
    </div>

    <div>
        <form method="get" action="stworzeniaPotwierdzenie.php" style='text-align:center'>
            <button name="koncztoturku" type="submit"  class="button">Zakoncz tworzenie quizu</button>

        </form><br>
    </div>

</body>
</html>
