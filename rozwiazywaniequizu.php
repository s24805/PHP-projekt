<?php
session_start();
include('funkcje.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rozwiazywanie quizu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<form method="get" action="rozwiazywanieDodajOdp.php" style='text-align:center'>
    <?php
    if(isset($_GET['Pytania'])) {
        $arrayPytanStringow = $_GET['Pytania'];
        $_SESSION['arrayPytanStringow'] = $arrayPytanStringow;
        $stringQuizu=$_GET['$stringQuizu'];
        $_SESSION['stringQuizu']=$stringQuizu;
    }
    else{
        $stringQuizu=$_SESSION['stringQuizu'];
        $arrayPytanStringow=$_SESSION['arrayPytanStringow'];
    }

    print_r($arrayPytanStringow);
    $quiz=new Quiz();
    $quiz->Stworz($stringQuizu);
    $czyUjemne=$quiz->getCzyujemne();
    $iloscPytan=count($arrayPytanStringow);
    $arrayPytan=array();
    foreach ($arrayPytanStringow as $pytankohej){
        $classPytanie= new Pytanie();
        $classPytanie->stworz($pytankohej);
        $arrayPytan[] = $classPytanie;
    }
    ++$_SESSION['NrPytania'];
    $numerPytania=$_SESSION['NrPytania'];
    if($numerPytania==$iloscPytan){
        //napisz pkty i takie tam
        Napisz("koeniec essa");
        echo "<br>";
        $aktualnePkty=$_SESSION['aktualnePunkty'];
        $zaokraglonePkty=round($aktualnePkty, 2);
        $maxymalnePkty=$_SESSION['maxymalnePkty'];
        $maxymalnePkty=round($maxymalnePkty, 2);
        Napisz("Twój wynik wynosi $zaokraglonePkty z $maxymalnePkty punktów");
        unset($_SESSION['aktualnePunkty']);
        unset($_SESSION['maxymalnePkty']);
        ?>
        <button type="submit"  class="button">Pokaz wynik</button>
        <input type="hidden" name="typPytania" value="koniec">
        <?php
    }
    else if($numerPytania>$iloscPytan){
        ?>
        <meta http-equiv="refresh" content="0;url=listaquizow.php" />

        <?php
    }
    else{
        If($quiz->getCzas()!=0) {
            $czasNaReset = $quiz->getCzas();
            $numerPytania++;
            ?>
            <meta http-equiv="refresh" content="<?php echo$czasNaReset?>" />
            <?php
        }
        $numerPytaniaDlaWidza=$numerPytania+1;
        $Pytanie=$arrayPytan[$numerPytania];
        $iloscPktDoZdobycia=$Pytanie->getPunkty();
        $typPytania=$Pytanie->getTyp();
        switch ($typPytania) {
            case "jednokrotne":
                $typPytaniaDlaWidza="jednokrotnego wyboru";
                break;
            case "wielokrotne":
                $typPytaniaDlaWidza="wielokrotnegoo wyboru";
                break;
            case "wpisz":
                $typPytaniaDlaWidza="wpisz poprawną odpowiedź";
                break;
            case "lista":
                $typPytaniaDlaWidza="wybierz z listy";
                break;
            case "dziury":
                $typPytaniaDlaWidza="wpisz brakujace litery";
                break;
            case "polacz":
                $typPytaniaDlaWidza="połącz pasujące stwierdzenia";
                break;
            case "sortuj":
                $typPytaniaDlaWidza="posortuj w odpowiedniej kolejności";
                break;
            case "prawda":
                $typPytaniaDlaWidza="prawda/fałsz";
                break;
        }
        Napisz("Pytanie numer $numerPytaniaDlaWidza z $iloscPytan. Do zdobycia: $iloscPktDoZdobycia punkt/ów. Typ pytania: $typPytaniaDlaWidza");
        echo "<br>";
        Napisz($Pytanie->getPytanie());
        echo "<br>";
        $odpowiedzi=$Pytanie->getOdpowiedzi();
            if (is_array($odpowiedzi))
                print_r($odpowiedzi);
            echo "<br>";
        $poprawnaOdpowiedz=$Pytanie->getPoprawnaodpowiedz();
        echo "Odpowiedz poprawna wyzej <br>";
        switch ($typPytania) {
            case "jednokrotne":
                //radio
                ?>
                <fieldset>
                    <label>Odpowiedzi (tylko jedna jest dobra):<br>
                        <?php
                        foreach ($odpowiedzi as $odpowiedz) {
                            ?>
                            <input type="radio" name="odp" value="<?php echo$odpowiedz ?>"> <?php Napisz($odpowiedz);?><br>
                            <?php
                        }
                        ?>

                    </label>
                </fieldset><br>
                <?php

                break;
            case "wielokrotne":
                //checkbox
                ?>
                <fieldset>
                    <label>Odpowiedzi (tylko jedna jest dobra):<br>
                        <?php
                        foreach ($odpowiedzi as $odpowiedz) {
                            ?>
                            <input type="checkbox" name="odp[]" value="<?php echo$odpowiedz?>"> <?php Napisz($odpowiedz);?><br>
                            <?php
                        }
                        ?>

                    </label>
                </fieldset><br>
                <?php
                break;
            case "wpisz":
                ?>
                <label>
                    <input type="text" name="odp" value="<?php echo$odpowiedzi ?>"> <?php Napisz($odpowiedzi);?><br>
                </label>
                <?php
                break;
            case "lista":
                ?>
                <label>Wybierz która odpowiedź jest poprawna
                    <select name="odp" required><?php
                        foreach ($odpowiedzi as $odpowiedz) {
                            ?>
                            <option value="<?php echo$odpowiedz ?>"><?php Napisz($odpowiedz);?></option>
                            <?php
                        }
                        ?>
                    </select>
                </label>
                <?php
                break;
            case "dziury":
                $odpowiedz=$Pytanie->getOdpowiedzi();
                $dlgOdp=strlen($odpowiedz);
                $stringLiczbMiejscDoWymazania=$Pytanie->getPoprawnaodpowiedz();
                $arrayLiczboliter=explode(" ",$stringLiczbMiejscDoWymazania);
                $nazwyZmiennychWpisanych="";
                $poprawneLitery="";
                foreach ($arrayLiczboliter as $literka)
                    $literka=intval($literka);
                for($i=0;$i<$dlgOdp;$i++){
                    $nazwaZmiennej="odp$i";
                    if (in_array($i, $arrayLiczboliter)) {
                        if($odpowiedz[$i]!=" "){
                        $nazwyZmiennychWpisanych.="$i ";
                        $poprawneLitery.="$odpowiedz[$i] "
                        ?>
                        <input type="text" name="<?php echo$nazwaZmiennej?>" size="1" maxlength="1" required>
                        <?php
                        }
                        else
                            Napisz($odpowiedz[$i]);
                    }
                    else
                        Napisz($odpowiedz[$i]);
                }
                $nazwyZmiennychWpisanych=rtrim($nazwyZmiennychWpisanych);
                $poprawneLitery=rtrim($poprawneLitery);
                break;
            case "polacz":
            case "sortuj":
                        $odpowiedz=$Pytanie->getOdpowiedzi();
                        $poprawneOdpowiedi=$Pytanie->getPoprawnaodpowiedz();
                        echo "<br>";
                        $ileOdp=count($odpowiedz);
                        for ($i = 0; $i < 4; $i++) {
                            switch ($poprawneOdpowiedi[$i]) {
                                case "$odpowiedz[0]":
                                    $poprawneOdpowiediKolor[$i] = "pomarancz";
                                    break;
                                case "$odpowiedz[1]":
                                    $poprawneOdpowiediKolor[$i] = "roz";
                                    break;
                                case "$odpowiedz[2]":
                                    $poprawneOdpowiediKolor[$i] = "niebieski";
                                    break;
                                case "$odpowiedz[3]":
                                    $poprawneOdpowiediKolor[$i] = "czerwony";
                                    break;
                            }
                        }
                        $poprawnaOdpowiedz="$poprawneOdpowiediKolor[0] $poprawneOdpowiediKolor[1] $poprawneOdpowiediKolor[2] $poprawneOdpowiediKolor[3]";

                        //mieszam poprawne odpowiedzi
                        for ($i = 0; $i < 68; $i++) {
                            $randomLiczba1 =rand(0, $ileOdp - 1);
                            $randomLiczba2 =rand(0, $ileOdp - 1);
                            $temp = $odpowiedz[$randomLiczba1];
                            if($typPytania=="polacz"){
                                //pierwsze rzeczy do dopasowania beda mialy stala kolejnosc, zmieni sie kolejnosc odpowiedzi do dopasowania
                                $odpowiedz[$randomLiczba1] = $odpowiedz[$randomLiczba2];
                                $odpowiedz[$randomLiczba2] = $temp;
                            }
                            else {
                                $odpowiedz[$randomLiczba1] = $odpowiedz[$randomLiczba2];
                                $odpowiedz[$randomLiczba2] = $temp;
                            }
                        }
                        if($typPytania=="sortuj"){
                            $pomarancz=$odpowiedz[0];
                            $roz=$odpowiedz[1];
                            $niebieski=$odpowiedz[2];
                            $czerwony=$odpowiedz[3];
                        }

                        echo "<br>";
                        NapiszPom("Pomarańczowy ");
                        Napisz("prostokąt odpowiada odpowiedzi: ");
                        NapiszPom("$odpowiedz[0]");
                        echo "<br>";

                        NapiszRoz("Różowy ");
                        Napisz("prostokąt odpowiada odpowiedzi: ");
                        NapiszRoz("$odpowiedz[1]");
                        echo "<br>";

                        NapiszNieb("Niebieski ");
                        Napisz("prostokąt odpowiada odpowiedzi: ");
                        NapiszNieb("$odpowiedz[2]");
                        echo "<br>";

                        NapiszCzerw("Czerwony ");
                        Napisz("prostokąt odpowiada odpowiedzi: ");
                        NapiszCzerw("$odpowiedz[3]");
                        echo "<br>";

                        echo "<br>";
                        Napisz("Ustaw prostokąty w odpowiedniej kolejności od lewej do prawej");

                        ?>

                <div class="wrapperczerwony">
                    <div class="moveczerwony"></div>
                </div>
                <script src="js/czerwony.js" type="text/javascript"></script>

                <div class="wrapperniebieski">
                    <div class="moveniebieski"></div>
                </div>
                <script src="js/niebieski.js" type="text/javascript"></script>


                <div class="wrapperroz">
                    <div class="moveroz"></div>
                </div>
                <script src="js/roz.js" type="text/javascript"></script>

                <div class="wrapperpomarancz" id="pomarancz">
                    <div class="movepomarancz">
                    </div>
                </div >
                <script src="js/pomarancz.js" type="text/javascript"></script>
        <?php
                break;

            case "prawda":
                ?>
                <input type="radio" name="odp" value="prawda"> <?php echo"prawda";?><br>
                <input type="radio" name="odp" value="falsz"> <?php echo"fałsz";?><br>
                <?php
                break;
        }
        ?>

        <div>
            <?php
            if($typPytania=="dziury"){
                ?>
                <input type="hidden" name="nazwyZmiennychWpisanych" value="<?php echo$nazwyZmiennychWpisanych?>">
                <input type="hidden" name="poprawneLitery" value="<?php echo$poprawneLitery?>">
                <?php
            }
            ?>
            <input type="hidden" name="typPytania" value="<?php echo$typPytania?>">
            <input type="hidden" name="poprawnaOdpowiedz" value="<?php echo$poprawnaOdpowiedz?>">
            <input type="hidden" name="punkty" value="<?php echo$iloscPktDoZdobycia?>">
            <input type="hidden" name="czyUjemne" value="<?php echo$czyUjemne?>">
            <button type="submit"  class="button">przeslij odpowiedz</button>
        </div>
        <br>
        <?php
    }
    ?>
</form>
</body>
</html>