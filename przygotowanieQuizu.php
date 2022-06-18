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
    <div>

        <form method="get" action="rozwiazywaniequizu.php" style='text-align:center'>

    <?php
    chdir("pytania");
    $stringQuizu=$_GET['StringQuizu'];
    $NazwaQuizu=$_GET['NazwaQuizu'];
    $quiz = new Quiz;
    $quiz->Stworz($stringQuizu);
    $email=$_SESSION['email'];
    $NazwaQuizutxt="$NazwaQuizu.txt";
    $wsrodku = file_get_contents($NazwaQuizutxt);
    $arrayPytanStringow= explode("\n", $wsrodku);
    $iloscPytan=count($arrayPytanStringow);

    if($quiz->getCzylospytania()=="losowepyt"){
        $ilePytan=count($arrayPytanStringow);

        for($i=0;$i<69;$i++){
            $randomLiczba1=rand(0, $ilePytan-1);
            $randomLiczba2=rand(0, $ilePytan-1);
            $temp=$arrayPytanStringow[$randomLiczba1];
            $arrayPytanStringow[$randomLiczba1]=$arrayPytanStringow[$randomLiczba2];
            $arrayPytanStringow[$randomLiczba2]=$temp;
        }

    }

    if($quiz->getCzylosodp()=="losoweodp"){

        foreach($arrayPytanStringow as $pytanie){
            $pytanieClass = new Pytanie;
            $pytanieClass->stworz($pytanie);
            $ileOdp=$pytanieClass->getOdpowiedzi();
            $typPytania=$pytanieClass->getTyp();

            if(is_array($ileOdp)){
                $ileOdp=count($ileOdp);
            }

            else
                $ileOdp=1;

            if($ileOdp==1 || $typPytania=="polacz" || $typPytania=="sortuj"){
                //nic nie rob bo if($ileOdp!=1 || $typPytania!="polacz" || $typPytania!="sortuj")  nie dzialal
            }

            else{
                $arrayPytania= explode("]", $pytanie);
                $ostatni=count($arrayPytania)-1;

                for ($i = 0; $i < 68; $i++) {
                    $randomLiczba1 =3+ rand(0, $ileOdp - 1);
                    $randomLiczba2 =3+ rand(0, $ileOdp - 1);
                    $temp = $arrayPytania[$randomLiczba1];
                    $arrayPytania[$randomLiczba1] = $arrayPytania[$randomLiczba2];
                    $arrayPytania[$randomLiczba2] = $temp;
                }

                $pytanie="$arrayPytania[0]]$arrayPytania[1]]$arrayPytania[2]]";//typ pytania ] ilosc pktow ] tresc pytania zawsze beda na stalym m9ejscu

                for($i=3;$i<$ostatni;$i++){
                    $pytanie.="$arrayPytania[$i]]";
                }

                $pytanie.="$arrayPytania[$ostatni]";
            }?>

            <input type="hidden" name="Pytania[]" value="<?php echo$pytanie?>">

            <?php
        }
    }

    $_SESSION['NrPytania']=-1;
    //$_SESSION['ArrayPytan']=$arrayPytan;
    //$_SESSION['Quiz']=$quiz;
    Napisz("Czy na pewno chcesz rozwiązać podany quiz?");
    echo "<br>";
    WypiszDanyQuiz($NazwaQuizu)

    ?>
            <br>
            <input type="hidden" name="$stringQuizu" value="<?php echo$stringQuizu?>">

            <button type="submit" class="button-chudy">Rozwiąż</button>

        </form>

        <div>

            <form style='text-align:center'>
                <input type="button" value="Anuluj" class="button-chudy" onclick="history.back()" >
            </form>

        </div>

    </div>

</body>
</html>