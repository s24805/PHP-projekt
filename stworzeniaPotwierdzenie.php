<?php
session_start();
include('funkcje.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>stwórz pytanie</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>

<body style="text-align: center">
    <?php

    unset($_SESSION['1wszePytZrob']);
    chdir("pytania");
    $nazwaQuizu=$_SESSION['nazwaQuizu'];
    $nazwaQuizutxt="$nazwaQuizu.txt";
    $handleLista = fopen("_lista.txt", "r+");
    $wsrodkuListy = file_get_contents("_lista.txt");
    $handleTenQuiz = fopen("$nazwaQuizutxt", "r+");
    $wsrodkuTenQuiz = file_get_contents($nazwaQuizutxt);
    $liczbaPyt = count(file($nazwaQuizutxt));
    $liczbaPkt = 0;

    for ($i = 0; $i < $liczbaPyt; $i++) {
        $line = fgets($handleTenQuiz);
        $pieces = explode("]", $line);
        $pktZaPyt = intval($pieces[1]);
        $liczbaPkt += $pktZaPyt;
    }

    $liczbaPkt=round($liczbaPkt, 2);
    $nick=$_SESSION['nick'];
    fclose($handleTenQuiz);
    $daneQuizu = $_SESSION['stringDanychQuizu'];
    echo $daneQuizu;
    $daneQuizu .= " $liczbaPyt $liczbaPkt $nick";
    $wsrodkuListy .= "\n$daneQuizu";
    file_put_contents("_lista.txt", $wsrodkuListy);
    fclose($handleLista);

    $quiz = new Quiz;
    $quiz->Stworz($daneQuizu);
    $opis=$quiz->Wypisz();
    Napisz("Tak wygląda stworzony quiz: <br>$opis");
    $nazwa=$quiz->getNazwa();
    unset($_SESSION['1wszePytZrob']);
    ?>

    <div>
        <form method="get" action="stronaglowna.php" style='text-align:center'>
            <button class="button" type="submit">Menu</button>
        </form><br>
    </div>

    <?php
    $conn=sqlConnect();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //(email, nazwa, punkty)
    $sql = "CREATE TABLE $nazwa (email VARCHAR(30), nazwa VARCHAR(20), punkty INT(4) );";

    if ($conn->query($sql) === TRUE) {
        echo "Table created successfully";
    }

    else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();
    ?>

</body>
</html>