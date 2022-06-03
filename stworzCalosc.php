<?php
session_start();
include('funkcje.php');
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>stwórz pytanie</title>
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
    $a=trim($_GET['odp1'], "]");
    $b=trim($_GET['odp2'], "]");
    $c=trim($_GET['odp3'], "]");
    $d=trim($_GET['odp4'], "]");
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
    $a=trim($_GET['odp1'], "]");
    $b=trim($_GET['odp2'], "]");
    $c=trim($_GET['odp3'], "]");
    $d=trim($_GET['odp4'], "]");
    $wynik.="$a]$b]$c]$d]";


    $name = $_GET['odp'];
    foreach ($name as $poprodp){
        $wynik.="$poprodp"; //dla ciag liczb np 124
    }
}
else if($typPyt=="wpisz"){
    $a=trim($_GET['odp1'], "]");
    $wynik.="$a";
}
else if($typPyt=="lista"){
    $a=trim($_GET['odp1'], "]");
    $b=trim($_GET['odp2'], "]");
    $c=trim($_GET['odp3'], "]");
    $d=trim($_GET['odp4'], "]");
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
    $a=trim($_GET['odp1'], "]");
    $a=trim($a, "_");
    $b=trim($_GET['cyfry'], "]");
    $wynik.="$a]$b";// da 1 odpowiedz np K__ica

}
else if($typPyt=="sortuj"){
    $a=trim($_GET['odp1'], "]");
    $b=trim($_GET['odp2'], "]");
    $c=trim($_GET['odp3'], "]");
    $d=trim($_GET['odp4'], "]");
    $wynik.="$a]$b]$c]$d";
}
else if($typPyt=="polacz"){
    $a1=trim($_GET['odp1a'], "]");
    $a2=trim($_GET['odp1b'], "]");
    $b1=trim($_GET['odp2a'], "]");
    $b2=trim($_GET['odp2b'], "]");
    $c1=trim($_GET['odp3a'], "]");
    $c2=trim($_GET['odp3b'], "]");
    $d1=trim($_GET['odp4a'], "]");
    $d2=trim($_GET['odp4b'], "]");
    $wynik.="$a1]$a2]$b1]$b2]$c1]$c2]$d1]$d2";
}
else if($typPyt=="prawda"){
    $a=$_GET['poprawnaodp'];
    $wynik.="$a";
}
else {
    Napisz("Podany typ pytania jest niepoprawny: $typPyt. Skontaktuj sie z adminem pozdrawiam");
}
echo $wynik;
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
        <button type="submit">Stworz kolejne pytanie</button>
    </form><br>
</div>
<div>
    <form method="get" action="stworzeniaPotwierdzenie.php" style='text-align:center'>
        <button name="koncztoturku" type="submit">Zakoncz tworzenie quizu</button>

    </form><br>
</div>
    </body>
</html>
