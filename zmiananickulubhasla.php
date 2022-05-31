<?php
session_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Zmiana hasla lub nicku</title>
    </head>
    <body style="background-color:rgb(35, 35, 35);">
    <form action="" method="GET" >
        <label>Podaj nowy nick lub nowe haslo (mozna tez zmienic obydwa na raz, nick bez spacji, od 4 do 20 znakow, haslo musi zawierac od 6 do 10 pozycji, coanjmniej 1 znak specjalny, conajmniej 1 wielka litera)<br>
            <input type="text" id="haslo" name="haslo" placeholder="haslo" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*_=+-]).{6,10}$">
            <input type="text" id="nick" name="nick" placeholder="nick"><br>
            <input type="submit" name="zmien" value="ić" /><br>
<?php
if(isset($_GET['zmien'])) {
    $ok = 1;
    if (!empty($_GET['nick'])) {
        $nick = trim($_GET['nick'], " ");
        if (strlen($nick) > 20 || strlen($nick) < 4) {
            echo "nick jest niepoprawny<br>";
            $ok = 0;
        }
    }
    if ($ok == 1) {
        $myfile = fopen("loginy.txt", "r") or die("Unable to open file!");
        $logihasl = file_get_contents("loginy.txt");
        $linie = explode("\n", $logihasl);
        $lines = count(file("loginy.txt"));
        $tresc = "";
        for ($i = 0; $i < $lines; $i++) {
            $linia = explode(" ", $linie[$i]);
            if ($linia[0] == $_SESSION['email']) {
                if (!empty($_GET['nick']))
                    $_SESSION['nick'] = "$nick";
                else
                    $nick = $linia[2];

                if (!empty($_GET['haslo']))
                    $haslo = $_GET['haslo'];
                else
                    $haslo = $linia[1];
                if($i==$lines-1)
                    $tresc .= "$linia[0] $haslo $nick $linia[3]";
                else
                    $tresc .= "$linia[0] $haslo $nick $linia[3]\n";
            } else{
                if($i==$lines-1)
                    $tresc .= "$linie[$i]";
                else
                    $tresc .= "$linie[$i]\n";
            }

        }

        file_put_contents("loginy.txt", $tresc);
        fclose($myfile);
        echo "wartosci zostaly poprawnie zmienione<br>";

    }
    echo "<a href='stronaglowna.php' title='powrut'>wroc do strony</a>";
}
?>
</body>
</html>

