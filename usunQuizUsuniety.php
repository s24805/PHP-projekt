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
    $nazwaQuizu=$_GET['nazwa'];
    chdir("pytania");
    $nazwaQuizutxt = "$nazwaQuizu.txt";
    unlink("$nazwaQuizutxt");
    $plik = "_lista.txt";
    $handle = fopen($plik, "r+");
    $wsrodku = file_get_contents($plik);
    $lines = count(file($plik));
    $current = "";

    for ($i = 0; $i < $lines; $i++) {
        $line = fgets($handle);
        $pieces = explode(" ", $line);
        if ($pieces[0] != $nazwaQuizu)
            $current .= "$line";
    }

    $current = rtrim($current);
    file_put_contents($plik, $current);
    fclose($handle);

    Napisz("Quiz o nazwie: $nazwaQuizu został usunięty");
    echo "<br";
    Napisz("Przekierowanie do strony głównej nastąpi za:");
    ?>

    <div id="countdown"></div>

    <script>
        var timeleft = 3;
        var downloadTimer = setInterval(function(){
            if(timeleft <= 0){
                clearInterval(downloadTimer);
                document.getElementById("countdown").innerHTML = "0 sekund";
            } else {
                document.getElementById("countdown").innerHTML = timeleft + " sekundy";
            }
            timeleft -= 1;
        }, 1000);
    </script>

    <meta http-equiv="refresh" content="4;url=stronaglowna.php" />
        <?php

    $conn=sqlConnect();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    else {
        $sql = "DROP TABLE $nazwaQuizu;";
    }

    $conn->close();
    ?>
</body>
</html>
