<?php
session_start();
$trescpliku = file_get_contents("loginy.txt");
$fp = fopen('loginy.txt', 'a');
$linia = explode("\n", $trescpliku);
$_SESSION['email'] = $_GET['email'];
$_SESSION['nick'] = trim($_GET['nick'] , " ");
$_SESSION['haslo'] =$_GET['haslo'];
$lines = count(file("loginy.txt"));
$ok="jeszcze nie ma podanegho maila zarejestrowanego";
for($i=0;$i<$lines;$i++){
    $linia = explode(" ", $linia[$i]);
    if($linia[0]==$_SESSION['email']){
        $ok="juz jest";
        break;
    }
}
if($ok=="juz jest"){
    echo "ten email jest juz zarejestrowany, prosze podac inny<br>";
    echo "<a href='rejestracja.html' title='powrut'>wroc do strony</a>";
}
else if(strlen($_SESSION['nick'])>20 || strlen($_SESSION['nick'])<4){
    echo "nick jest niepoprawny<br>";
    echo "<a href='rejestracja.html' title='powrut'>wroc do strony</a>";
}
else {
    $_SESSION['admin']="0";
    fwrite($fp, "\n");
    fwrite($fp, $_SESSION['email']);
    fwrite($fp, " ");
    fwrite($fp, $_SESSION['haslo']);
    fwrite($fp, " ");
    fwrite($fp, $_SESSION['nick']);
    fwrite($fp, " ");
    fwrite($fp, "0");//0 wskazuje iz podany uzytkownik nie jest administratorem (wartosc 1, gdy jest adminem)
    fclose($fp);
    echo "zarejestrowano<br>";
    echo "<a href='stronaglowna.php' title='powrut'>wroc do strony</a>";


}
