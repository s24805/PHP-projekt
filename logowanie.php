<?php
session_start();
include('funkcje.php');
$myfile = fopen("loginy.txt", "r") or die("Unable to open file!");
$logihasl= file_get_contents("loginy.txt");
$linie = explode("\n", $logihasl);
$email = $_GET['email'];
$haslo = $_GET['haslo'];
$lines = count(file("loginy.txt"));
$ok="niepoprawne logowanie";
for($i=0;$i<$lines;$i++){
    $linia = explode(" ", $linie[$i]);
    if($linia[0]==$email && $linia[1]==$haslo){
        $ok="siadlo";
        $nick=$linia[2];
        $_SESSION['admin']=$linia[3];
        break;
    }
}
if($ok=="siadlo"){
    napisz("$nick - zalogowano poprawnie");
    echo "<br>";
     $okeika="<a href='stronaglowna.php' title='powrut'> wroc do strony</a>";
     napisz($okeika);
    $_SESSION['email']=$email;
    $_SESSION['nick']=$nick;
}
else{
    echo "login lub haslo niepoprawne<br>";
    echo "<a href='logowanie.html' title='powrut'>wroc do strony</a>";

}

