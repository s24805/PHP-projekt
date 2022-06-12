<?php
session_start();
include('funkcje.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista Quizów</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body style="text-align: center">
<?php
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
    Napisz("$nick - zalogowano poprawnie");
    echo "<br>";
    ?>
    <form method="get" action="stronaglowna.php" style='text-align:center'>
        <button type="submit" class="button">Powrót</button>
    </form><br>
    <?php
    $_SESSION['email']=$email;
    $_SESSION['nick']=$nick;
}
else{
    Napisz( "login lub haslo niepoprawne<br>");
    ?>
    <form method="get" action="logowanie.html" style='text-align:center'>
        <button type="submit" class="button">Powrót</button>
    </form><br>
    <?php

}
?>
</body>
</html>
