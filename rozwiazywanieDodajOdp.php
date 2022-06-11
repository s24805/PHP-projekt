<?php
session_start();
include('funkcje.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>quiz</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<?php
$typPytania=$_GET['typPytania'];
$poprawnaOdpowiedz=$_GET['poprawnaOdpowiedz'];
$punktyZaPytanie=intval($_GET['punkty']);
$czyUjemne=$_GET['czyUjemne'];
if(!isset($_SESSION['aktualnePunkty'])) {
    $_SESSION['maxymalnePkty'] = 0;
    $_SESSION['aktualnePunkty'] = 0;
}
    $_SESSION['maxymalnePkty'] +=$punktyZaPytanie;
switch ($typPytania) {
    case "jednokrotne":
    case "lista":
    case "wpisz":
    case "prawda":
        $wybranaOdpowiedz=$_GET['odp'];
        if($wybranaOdpowiedz=="$poprawnaOdpowiedz")
            $_SESSION['aktualnePunkty']+=$punktyZaPytanie;
        else if($czyUjemne=="saujemne")
            $_SESSION['aktualnePunkty']-=$punktyZaPytanie;
        break;
    case "wielokrotne":
        $poprawnaOdpowiedz=rtrim($poprawnaOdpowiedz);
        $arrayWybranaOdpowiedzi=$_GET['odp'];
        $arrayPoprawnaOdpowiedz=explode(" ", $poprawnaOdpowiedz);
        $dzielnikPkt=count($arrayPoprawnaOdpowiedz);
        $punktyZaPytanie=$punktyZaPytanie/$dzielnikPkt;
        foreach($arrayWybranaOdpowiedzi as $odpowiedz){
            if (in_array($odpowiedz, $arrayPoprawnaOdpowiedz)) {
                $_SESSION['aktualnePunkty']+=$punktyZaPytanie;
            }
            else if($czyUjemne=="saujemne")
                $_SESSION['aktualnePunkty']-=$punktyZaPytanie;
        }
        break;
    case "dziury":
        $poprawneLitery=$_GET['poprawneLitery'];
        $nazwyZmiennychWpisanych=$_GET['nazwyZmiennychWpisanych'];
        if($poprawneLitery==$nazwyZmiennychWpisanych)
            $_SESSION['aktualnePunkty']+=$punktyZaPytanie;
        else if($czyUjemne=="saujemne")
            $_SESSION['aktualnePunkty']-=$punktyZaPytanie;
        break;
    case "koniec";

        ?>
        <div>
            <form action="listaquizow.php" style='text-align:left'>
                <button type="submit"  class="button" value="powrot">
            </form>
        </div>
        <?php
        break;
}
?>
<div>
    <meta http-equiv="refresh" content="0;url=rozwiazywaniequizu.php" />
</div>
</body>
</html>