<?php
session_start();
include('funkcje.php');
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Lista Quizów</title>
    </head>
    <body >
    <?php
    Napisz("Ten Quiz:");
    echo "<br>";
    $StringQuizu=$_GET['StringQuizu'];
    $quiz = new Quiz;
    $quiz->Stworz($StringQuizu);
    $quiz->Wypisz();
    echo "<br>";
    Napisz("Został usunięty");
    $nazwaQuizu = $_GET['NazwaQuizu'];
    chdir("pytania");
    $plik = "_lista.txt";
    $handle = fopen($plik, "r+");
    $wsrodku = file_get_contents($plik);
    $lines = count(file($plik));
    $current = "";
    for ($i = 0; $i < $lines; $i++) {
        $line = fgets($handle);
        $pieces = explode(" ", $line);
        if ($i == $lines - 1) {
            $line = trim(preg_replace('/\s+/', '', $line));
        }
        if ($pieces[0] != $nazwaQuizu)
            $current .= "$line";
    }
    $current = rtrim($current);
    file_put_contents($plik, $current);
    fclose($handle);
    $nazwaQuizutxt = "$nazwaQuizu.txt";
    unlink("$nazwaQuizutxt");
    ?>
    <div>
        <form style='text-align:center'>
            <input type="button" value="Anuluj"  onclick="history.back()" >
        </form><br>
    </div><br>
    <div>
        <form method="get" action="stronaglowna.php" style='text-align:center'>
            <input name="usun" type="submit" value="Tak,usuń"" >

        </form><br>
    </div>
    </body>
</html>