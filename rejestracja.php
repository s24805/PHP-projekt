<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body style="text-align: center">
<?php
$trescpliku = file_get_contents("loginy.txt");
$fp = fopen('loginy.txt', 'a');
$linia = explode("\n", $trescpliku);
$email = $_GET['email'];
$nick = trim($_GET['nick'] , " ");
$haslo =$_GET['haslo'];
$lines = count($linia);
$ok="jeszcze nie ma podanegho maila zarejestrowanego";
for($i=0;$i<$lines;$i++){
    $arrayLinia = explode(" ", $linia[$i]);
    if($arrayLinia[0]==$email){
        $ok="juz jest";
        break;
    }
}
if($ok=="juz jest"){
    echo "ten email jest juz zarejestrowany, prosze podac inny<br>";
    ?>
    <div>
        <form method="get" action="rejestracja.html">
            <button type="submit" class="button">wroc do strony</button>
        </form><br>
    </div>
    <?php
}
else if(strlen($nick)>20 || strlen($nick)<4){
    echo "nick jest niepoprawny<br>";
    ?>
    <div>
        <form method="get" action="rejestracja.html">
            <button type="submit" class="button">wroc do strony</button>
        </form><br>
    </div>
    <?php
}
else if(strlen($haslo)>15 || strlen($haslo)<6){
    echo "haslo jest niepoprawne<br>";
    ?>
    <div>
        <form method="get" action="rejestracja.html">
            <button type="submit" class="button">wroc do strony</button>
        </form><br>
    </div>
    <?php
}
else {
    $_SESSION['email'] = $_GET['email'];
    $_SESSION['nick'] = trim($_GET['nick'] , " ");
    $_SESSION['haslo'] =$_GET['haslo'];
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
    ?>
    <div>
        <form method="get" action="stronaglowna.php">
            <button type="submit" class="button">wroc do strony glownej</button>
        </form><br>
    </div>
    <?php

}
?>
</body>
</html>
