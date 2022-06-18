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

<body >
    <form method="get" action="stworzCalosc.php" style='text-align:center'>
    <?php
    $trescpytania= trim($_GET['TrescPytania'], "]");
    $trescpytania=str_replace("\n"," ","$trescpytania");
    $_SESSION['trescPytania']= $trescpytania;
    $_SESSION['typPytania']=$_GET['typPyt'];
    $_SESSION['pktZaPyt']=$_GET['pkty'];

    if($_GET['typPyt']=="jednokrotne"){
        ?>

        <fieldset class="field_set">
            <label>Odpowiedź numer 1
                <input type="text"  name="odp1" required><br>
            </label><br>

            <label>Odpowiedź numer 2
                <input type="text"  name="odp2" required><br>
            </label><br>

            <label>Odpowiedź numer 3
                <input type="text"  name="odp3" required><br>
            </label><br>

            <label>Odpowiedź numer 4
                <input type="text"  name="odp4" required><br>
            </label>

        </fieldset><br>

        <label>Wybierz która odpowiedź jest poprawna
            <select name="poprawnaodp" required>
                <option value="1">Pierwsza</option>
                <option value="2">Druga</option>
                <option value="3">Trzecia</option>
                <option value="4">Czwarta</option>
            </select>
        </label>

    <?php
    }

    else if($_GET['typPyt']=="wielokrotne"){
    ?>
        <fieldset class="field_set">
            <label>Odpowiedź numer 1
                <input type="text"  name="odp1" required>Odpowiedź nr 1<br>
            </label><br>

            <label>Odpowiedź numer 2
                <input type="text"  name="odp2" required>Odpowiedź nr 2<br>
            </label><br>

            <label>Odpowiedź numer 3
                <input type="text"  name="odp3"  required>Odpowiedź nr 3<br>
            </label><br>

            <label>Odpowiedź numer 4
                <input type="text"  name="odp4"  required>Odpowiedź nr 4<br>
            </label>

        </fieldset><br>

        <label>Podaj poprawne odpowiedzi:<br>
            <input type="checkbox" name="odp[]" value="1"> Odpowiedź nr 1<br>
            <input type="checkbox" name="odp[]" value="2"> Odpowiedź nr 2<br>
            <input type="checkbox" name="odp[]" value="3"> Odpowiedź nr 3<br>
            <input type="checkbox" name="odp[]" value="4"> Odpowiedź nr 4<br>
        </label>

    <?php
        //sprawdz czy sa minimalnie 2 odp poprawne
    }

    else if($_GET['typPyt']=="wpisz"){
        ?>
            <fieldset>
                <label>Podaj odpoweidź:<br>
                <input type="text" name="odp1" placeholder="Odpowiedź"><br>
                </label>
            </fieldset>
    <?php
    }

    else if($_GET['typPyt']=="lista"){
    ?>

        <fieldset class="field_set">
            <label>Odpowiedź numer 1
                <input type="text"  name="odp1" required><br>
            </label><br>

            <label>Odpowiedź numer 2
                <input type="text"  name="odp2" required><br>
            </label><br>

            <label>Odpowiedź numer 3
                <input type="text"  name="odp3"  required><br>
            </label><br>

            <label>Odpowiedź numer 4
                <input type="text"  name="odp4"  required><br>
            </label>
        </fieldset><br>

        <label>Wybierz która odpowiedź jest poprawna
            <select name="poprawnaodp" required>
                <option value="1">Pierwsza</option>
                <option value="2">Druga</option>
                <option value="3">Trzecia</option>
                <option value="4">Czwarta</option>
            </select>
        </label>

    <?php
    }

    else if($_GET['typPyt']=="dziury") {
    ?>
        <label>Podaj odpowiedz
            <input type="text"  name="odp1"  required>Odpowiedź<br>

            <label>Podaj liczby oddzielone spacjami, które odpowiadają odpowienim literom, np 3 5 6 10 11. Pamietaj,ze pierwsza litera jest pod numerem 0</label>
            <input type="text"  name="cyfry" pattern="[0-9 ]+" required>Odpowiedź<br>
        </label>
    <?php
    }

    else if($_GET['typPyt']=="sortuj") {
        ?>
    <fieldset class="field_set">
        <label>Podaj odpowiedzi w poprawnej kolejnosci (1,2,3,4)</label><br><br>

        <label>Odpowiedź numer 1
            <input type="text"  name="odp1" required><br>
        </label><br>

        <label>Odpowiedź numer 2
            <input type="text"  name="odp2" required><br>
        </label><br>

        <label>Odpowiedź numer 3
            <input type="text"  name="odp3"  required><br>
        </label><br>

        <label>Odpowiedź numer 4
            <input type="text"  name="odp4"  required><br>
        </label>
    </fieldset>
    <?php
    }

    else if($_GET['typPyt']=="polacz") {
    ?>
        <fieldset class="field_set">
            <label>Podaj odpowiedzi ktore sie łączą (1z 1b, 2a 2b...)</label><br><br>
            <label>Odpowiedź numer 1a
                <input type="text"  name="odp1a" required><br>
            </label>

            <label>Odpowiedź numer 1b
                <input type="text"  name="odp1b" required><br>
            </label><br>



            <label>Odpowiedź numer 2a
                <input type="text"  name="odp2a" required><br>
            </label>

            <label>Odpowiedź numer 2b
                <input type="text"  name="odp2b" required><br>
            </label><br>



            <label>Odpowiedź numer 3a
                <input type="text"  name="odp3a"  required><br>
            </label>

            <label>Odpowiedź numer 3b
                <input type="text"  name="odp3b"  required><br>
            </label><br>



            <label>Odpowiedź numer 4a
                <input type="text"  name="odp4a"  required><br>
            </label>

            <label>Odpowiedź numer 4b
                <input type="text"  name="odp4b"  required><br>
            </label>


        </fieldset>
        <?php
    }

    else if($_GET['typPyt']=="prawda") {
        ?>
        <label>Wybierz czy odpowiedz jest prawdziwa lub falszywa
            <select name="poprawnaodp" required>
                <option value="falsz">Fałsz</option>
                <option value="prawda">Prawda</option>
            </select>
        </label>
    <?php
    }

    else  {
        $blad=$_GET['typPyt'];
        Napisz("Podany typ pytania jest niepoprawny: $blad. Skontaktuj sie z adminem pozdrawiam");

    }

    ?>
    <div>
        <button type="submit" class="button-chudy">Dalej</button>
    </div>

    </form><br>

    <div>
        <form style='text-align:center'>
            <input type="button" value="Wróć" class="button-chudy" onclick="history.back()" >
        </form><br>
    </div>

    <?php
    //touch($nazwaQuizutxt); na koncu pliku
    ?>
</body>
</html>
