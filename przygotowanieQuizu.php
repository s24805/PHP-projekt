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
        if(is_array($ileOdp)){
            $ileOdp=count($ileOdp);
        }
        else
            $ileOdp=1;
        if($ileOdp!=1) {
            $arrayPytania= explode("]", $wsrodku);
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
$_SESSION['NrPytania']=0;
$_SESSION['liczbaPktow']=0;
//$_SESSION['ArrayPytan']=$arrayPytan;
$_SESSION['Quiz']=$quiz;
?>
<div>
    <form method="get" action="rozwiazywaniequizu.php" style='text-align:center'>
        <?php
        foreach($arrayPytan as $pytanie)
        {
            ?>
            <input type="hidden" name="Pytania[]" value="<?php echo$pytanie?>">
        <?php
        }
        ?>
        <meta http-equiv="refresh" content="0;url=rozwiazywaniequizu.php" />
    <label>jd dziwke</label>
    </form><br>
</div>
</body>
</html>