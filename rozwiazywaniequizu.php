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
chdir("pytania");
$string=$_GET['StringQuizu'];
$NazwaQuizu=$_GET['NazwaQuizu'];
$quiz = new Quiz;
$quiz->Stworz($string);
$email=$_SESSION['email'];
$NazwaQuizutxt="$NazwaQuizu.txt";
$wsrodku = file_get_contents($NazwaQuizutxt);
$arrayPytanStringow= explode("\n", $wsrodku);
$iloscPytan=count($arrayPytanStringow);
$arrayPytan = array();
foreach ($arrayPytanStringow as $PytanieString){
    $pytanieClass = new Pytanie;
    $pytanieClass->stworz($PytanieString);
    $arrayPytan[] = $pytanieClass;
}
if($quiz->getCzylospytania()=="losowepyt"){
    $ilePytan=count($arrayPytan);
    for($i=0;$i<69;$i++){
        $randomLiczba1=rand(0, $ilePytan-1);
        $randomLiczba2=rand(0, $ilePytan-1);
        $temp=$arrayPytan[$randomLiczba1];
        $arrayPytan[$randomLiczba1]=$arrayPytan[$randomLiczba2];
        $arrayPytan[$randomLiczba2]=$temp;
    }
}
if($quiz->getCzylosodp()=="losoweodp"){
    foreach($arrayPytan as $pytanie){
        $ileOdp=$pytanie->getOdpowiedzi();
        if(is_array($ileOdp)){
            $ileOdp=count($ileOdp);
        }
        else
            $ileOdp=1;
        $arrayOdpowiedzi=$pytanie->getOdpowiedzi();
        if($ileOdp!=1) {
            for ($i = 0; $i < 68; $i++) {
                $randomLiczba1 = rand(0, $ileOdp - 1);
                $randomLiczba2 = rand(0, $ileOdp - 1);
                $temp = $arrayOdpowiedzi[$randomLiczba1];
                $arrayOdpowiedzi[$randomLiczba1] = $arrayOdpowiedzi[$randomLiczba2];
                $arrayOdpowiedzi[$randomLiczba2] = $temp;
            }
        }
    }
}
?>
<label>Żyjemy</label>
<?php
$liczbaPktow=0;
if(!isset($numerPytania)){
    $numerPytania=0;
}
if($numerPytania==$iloscPytan){
    //napisz pkty i takie tam
    Napisz("koeniec essa");
    Napisz($numerPytania);
    echo "<br>";
    Napisz($iloscPytan);
}
else{
    If($quiz->getCzas()!=0) {
        $czasNaReset = $quiz->getCzas();
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
        <form method="get" action="" style='text-align:center'>
            <button name="kolejne" type="submit">nastepne pytanie</button>
            <?php
            if(isset($_GET['kolejne'])){
                $numerPytania++;
                ?>
                <meta http-equiv="refresh" content="0.1" />
            <?php
                unset($_GET['kolejne']);
            }
            ?>
        </form><br>
    </div>
    <?php
    }
?>
</body>
</html>