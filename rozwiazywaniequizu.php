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
<script>
    function unhide() {
        var hid = document.getElementsByClassName("exp");
        if(hid[0].offsetWidth > 0 && hid[0].offsetHeight > 0) {
            hid[0].style.visibility = "visible";
        }
    }
</script>
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
        <button type="submit">Pokaz wynik</button>
        <input type="hidden" name="typPytania" value="koniec">
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
        Napisz("Pytanie numer $numerPytaniaDlaWidza z $iloscPytan. Do zdobycia: $iloscPktDoZdobycia punkt/ów");
        echo "<br>";
        Napisz($Pytanie->getPytanie());
        $typPytania=$Pytanie->getTyp();
        echo "<br>";
        $odpowiedzi=$Pytanie->getOdpowiedzi();
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
                echo "do zrobienia z JS";
                break;
            case "prawda":
                ?>
                <input type="radio" name="odp" value="prawda"> <?php Napisz("prawda");?><br>
                <input type="radio" name="odp" value="falsz"> <?php Napisz("fałsz");?><br>
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
            <button type="submit">przeslij odpowiedz</button>
        </div>
        <br>
        <?php
    }
    ?>
</form>
</body>
</html>