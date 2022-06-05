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
<label>Żyjemy</label>
<?php

//$_SESSION['NrPytania']=0;
$arrayPytan=$_GET['Pytania'];
$quiz=$_SESSION['Quiz'];
//$_SESSION['liczbaPktow']=0;
$iloscPytan=count($arrayPytan);
foreach ($arrayPytan as $pytankohej){
   echo $pytankohej->getPytanie();
}
if(!isset($numerPytania)){
    $numerPytania=0;
}
if($numerPytania==$iloscPytan-1){
    //napisz pkty i takie tam
    Napisz("koeniec essa");
    Napisz($numerPytania);
    echo "<br>";
    Napisz($iloscPytan);
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
        echo $Pytanie->getPytanie();
        echo "<br>";
        $odpowiedzi=$Pytanie->getOdpowiedzi();
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
    <input type="checkbox" name="odp[]" value="<?php echo$odpowiedz ?>"> <?php Napisz($odpowiedz);?><br>
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
                $brakujaceLitery=$Pytanie->getPoprawnaodpowiedz();
                $ileInputow=strlen($brakujaceLitery);
                for($i=0;$i<$ileInputow;$i++){
                    $nazwaZmiennej="odp$i";
                    ?>
                    <input type="text" name="<?php echo$nazwaZmiennej?>" value="<?php echo$odpowiedzi ?>"> <?php Napisz($odpowiedzi);?><br>
    <?php
                }
                break;
            case "polacz":
            case "sortuj":
                echo "do zrobienia z JS";

                echo "do zrobienia z JS";
            case "prawda":
                ?>
            <input type="radio" name="odp" value="prawda"> <?php Napisz("prawda");?><br>
            <input type="radio" name="odp" value="falsz"> <?php Napisz("fałsz");?><br>
    <?php
        }
        ?>
    <div>

            <button name="kolejne" onclick=" refresh <?php $numerPytania++;?>" >nastepne pytanie</button>
            <?php
            $numerPytania++;
            echo "<a href=\"rozwiazywaniequizu.php?StringQuizu=$string&NazwaQuizu=$NazwaQuizu&NrPytania=$numerPytania\">Ostatni</a> ";
            /*
            if(isset($_GET['kolejne'])){
                $numerPytania++;
                ?>
                <meta http-equiv="refresh" content="0.1" />
            <?php
                unset($_GET['kolejne']);
            }*/
            ?>
        <br>
    </div>
    <?php
    }
?>
</body>
</html>