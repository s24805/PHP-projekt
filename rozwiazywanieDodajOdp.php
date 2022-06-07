<?php
session_start();
include('funkcje.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>quiz</title>
</head>
<body>

<?php
$typPytania=$_GET['typPytania'];
$poprawnaOdpowiedz=$_GET['poprawnaOdpowiedz'];
$punktyZaPytanie=intval($_GET['punkty']);
$czyUjemne=$_GET['czyUjemne'];
if(!isset($_SESSION['stringWybranychOdpowiedzi'])) {
    $_SESSION['stringWybranychOdpowiedzi'] = "";
    $_SESSION['aktualnePunkty'] = 0;
}
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
    foreach ($_GET['odp'] as $odpowiedz){
        $_SESSION['stringWybranychOdpowiedzi'].="$odpowiedz ";
    }
        $poprawnaOdpowiedz=rtrim($poprawnaOdpowiedz);
        $pieces = explode(" ", $poprawnaOdpowiedz);
        $_SESSION['stringWybranychOdpowiedzi']=rtrim($_SESSION['stringWybranychOdpowiedzi']);
        $_SESSION['stringWybranychOdpowiedzi'].="<br>";
    break;
    case "dziury":
        $dlgOdp=$_GET['dlgOdp'];
        $nazwyZmiennychWpisanych=$_GET['nazwyZmiennychWpisanych'];
        $arrNrowZmiennychWpisanych=explode(" ",$nazwyZmiennychWpisanych);
        foreach ($arrNrowZmiennychWpisanych as $value)
            $value=intval($value);
        for($i=0;$i<$dlgOdp;$i++) {
            if (in_array($i, $arrNrowZmiennychWpisanych)) {
                $nazwaZmiennej="odp$i";
                $termp=$_GET["$nazwaZmiennej"];
                $_SESSION['stringWybranychOdpowiedzi'].="$termp";
            }
        }
        $_SESSION['stringWybranychOdpowiedzi'].="<br>";
        break;
        case "koniec";
        echo $_SESSION['stringWybranychOdpowiedzi'];
        unset($_SESSION['stringWybranychOdpowiedzi']);
        ?>
            <div>
                <form action="listaquizow.php" style='text-align:left'>
                    <button type="submit"  value="powrot">
                </form>
            </div>
        <?php
        break;
}
?>
<div>
    <form style='text-align:left'>
        <input type="button" value="wroc"  onclick="history.back()" >
    </form>
</div>
</body>
</html>
