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
    if(!isset($_SESSION['koniecQuizu'])) {
        $typPytania = $_GET['typPytania'];
        $poprawnaOdpowiedz = $_GET['poprawnaOdpowiedz'];
        $punktyZaPytanie = intval($_GET['punkty']);
        $czyUjemne = $_GET['czyUjemne'];
        $_SESSION['ostatnieMaxPkty']=$poprawnaOdpowiedz;
        $_SESSION['ostatnieOtrzymanePkty']=0;
    }

    else
        unset($_SESSION['koniecQuizu']);

    if(!isset($_SESSION['aktualnePunkty'])) {
        $_SESSION['maxymalnePkty'] = 0;
        $_SESSION['aktualnePunkty'] = 0;
    }

    if($_GET['poprawnaOdpowiedz']=="cofaj") {
        $_SESSION['NrPytania'] -= 2;
        $_SESSION['coflemSie']="cofnalem sie";
        $_SESSION['aktualnePunkty']-=$_SESSION['ostatnieOtrzymanePkty'];
        $_SESSION['maxymalnePkty'] -=$_SESSION['ostatnieMaxPkty'];
        ?>
    <?php
    }

    else
        unset($_SESSION['coflemSie']);

    if(isset($typPytania)){
        $_SESSION['maxymalnePkty'] +=$punktyZaPytanie;

        switch ($typPytania) {
            case "jednokrotne":
            case "lista":
            case "wpisz":
            case "prawda":
                $wybranaOdpowiedz=$_GET['odp'];

                if($wybranaOdpowiedz=="$poprawnaOdpowiedz") {
                    $_SESSION['aktualnePunkty'] += $punktyZaPytanie;
                    $_SESSION['ostatnieOtrzymanePkty']+=$punktyZaPytanie;
                }

                else if($czyUjemne=="saujemne"){
                    $_SESSION['aktualnePunkty']-=$punktyZaPytanie;
                    $_SESSION['ostatnieOtrzymanePkty']-=$punktyZaPytanie;
                }

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
                        $_SESSION['ostatnieOtrzymanePkty']+=$punktyZaPytanie;
                    }

                    else if($czyUjemne=="saujemne") {
                        $_SESSION['aktualnePunkty'] -= $punktyZaPytanie;
                        $_SESSION['ostatnieOtrzymanePkty'] -= $punktyZaPytanie;
                    }
                }
                break;


            case "dziury":
                $poprawneLitery=$_GET['poprawneLitery'];
                $nazwyZmiennychWpisanych=$_GET['nazwyZmiennychWpisanych'];

                if($poprawneLitery==$nazwyZmiennychWpisanych) {
                    $_SESSION['aktualnePunkty'] += $punktyZaPytanie;
                    $_SESSION['ostatnieOtrzymanePkty'] += $punktyZaPytanie;
                }

                else if($czyUjemne=="saujemne") {
                    $_SESSION['aktualnePunkty'] -= $punktyZaPytanie;
                    $_SESSION['ostatnieOtrzymanePkty'] -= $punktyZaPytanie;
                }

                break;


            case "sortuj":
            case "polacz":
                $arrayPoprawnaOdpowiedz=(explode(" ",$poprawnaOdpowiedz));
                $czyJestJS=1;

                for($i=0;$i<count($arrayPoprawnaOdpowiedz);$i++) {

                    switch ($arrayPoprawnaOdpowiedz[$i]) {
                        case "pomarancz":
                            if (isset($_COOKIE['pomaranczX']))
                                $getPozycja[$i] = $_COOKIE['pomaranczX'];
                            else
                                $czyJestJS = 0;
                            break;

                        case "roz":
                            if (isset($_COOKIE['rozX']))
                                $getPozycja[$i] = $_COOKIE['rozX'];
                            else
                                $czyJestJS = 0;
                            break;

                        case "niebieski":
                            if (isset($_COOKIE['niebieskiX']))
                                $getPozycja[$i] = $_COOKIE['niebieskiX'];
                            else
                                $czyJestJS = 0;
                            break;

                        case "czerwony":
                            if (isset($_COOKIE['czerwonyX']))
                                $getPozycja[$i] = $_COOKIE['czerwonyX'];
                            else
                                $czyJestJS = 0;
                            break;
                    }
                }

                    if($czyJestJS!=0) {

                        for($i=0;$i<4;$i++) {
                            $getPozycja[$i]=substr($getPozycja[$i], 0, -2);
                            $getPozycja[$i]=intval($getPozycja[$i]);
                            //echo "$arrayPoprawnaOdpowiedz[$i]: $getPozycja[$i] <br>"; <- sprawdzenie
                        }

                        if($getPozycja[0]<=$getPozycja[1] && $getPozycja[1]<=$getPozycja[2] && $getPozycja[2]<=$getPozycja[3]) {
                            $_SESSION['aktualnePunkty'] += $punktyZaPytanie;
                            $_SESSION['ostatnieOtrzymanePkty'] += $punktyZaPytanie;
                        }

                        else if($czyUjemne=="saujemne") {
                            $_SESSION['aktualnePunkty'] -= $punktyZaPytanie;
                            $_SESSION['ostatnieOtrzymanePkty'] -= $punktyZaPytanie;
                        }

                    }

                break;


            case "koniec":
                ?>
                <div>
                    <form action="listaquizow.php" style='text-align:left'>
                        <button type="submit"  class="button" value="powrot">
                    </form>
                </div>
                <?php
                break;

        }
    }

    else{
        //nie przeslano odpowiedzi
            $_SESSION['maxymalnePkty'] +=$punktyZaPytanie;

            if($czyUjemne=="saujemne") {
                $_SESSION['aktualnePunkty'] -= $punktyZaPytanie;
                $_SESSION['ostatnieOtrzymanePkty'] += $punktyZaPytanie;
            }
        }
    ?>

    <div>
        <meta http-equiv="refresh" content="0;url=rozwiazywaniequizu.php" />
    </div>
</body>
</html>