<?php
session_start();
include('funkcje.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>stwórz pytanie</title>
</head>
<body >
    <form method="get" action="stworzOdpowiedzi.php" style='text-align:left'>

        <?php
        if(!isset($_SESSION['1wszePytZrob'])){

            $nazwaQuizu=$_GET['nazwa'];
            $nazwyQuizow=scandir('pytania');
            $nazwaQuizutxt="$nazwaQuizu.txt";
            if (in_array($nazwaQuizutxt, $nazwyQuizow)) {
                Napisz("Podana nazwa quizu już istnieje, proszę podać inna");
                ?>
                <?php
            }
            else {
                Napisz("$nazwaQuizu zostal poprawnie stworzony");
                chdir("pytania");
                $_SESSION['nazwaQuizu']=$nazwaQuizu;
                $e=$_GET['pktyujemne'];
                $a=$_GET['czas'];
                $b=$_GET['lospyt'];
                $c=$_GET['losodp'];
                $d=$_GET['powrut'];
                $_SESSION['stringDanychQuizu'] = "$nazwaQuizu $e $a $b $c $d";//np test1 saujemne 60 losowepyt losoweodp moznacofac
                ?>

        <label>Wybierz typ pytania:
            <select name="typPyt" required>
                <option value="jednokrotne">jednokrotnego wyboru</option>
                <option value="wielokrotne">wielokrotnego wyboru</option>
                <option value="wpisz">krotka odpowiedz</option>
                <option value="lista">wybór odpowiedzi z listy</option>
                <option value="dziury">wypełnienie słów</option>
                <option value="sortuj">sortowanie elementów</option>
                <option value="polacz">dopasowanie elementów </option>
                <option value="prawda">prawda/fałsz </option>
            </select>
        </label><br>
        <label>Podaj treść pytania:<br>
            <input type="text" name="TrescPytania" size="200" required>

        </label><br>
        <label>Ilość punktów za poprawną odpowieź
            <input type="number"  name="pkty" min="1" required><br>
        </label><br>
        <button name="dalej" type="submit">przejdz do tworzenia odpowiedzi</button>
    </form>
    <?php
            }
        }
        else{
            ?>
    <label>Wybierz typ pytania:
        <select name="typPyt" required>
            <option value="jednokrotne">jednokrotnego wyboru</option>
            <option value="wielokrotne">wielokrotnego wyboru</option>
            <option value="wpisz">krotka odpowiedz</option>
            <option value="lista">wybór odpowiedzi z listy</option>
            <option value="dziury">wypełnienie słów</option>
            <option value="sortuj">sortowanie elementów</option>
            <option value="polacz">dopasowanie elementów </option>
            <option value="prawda">prawda/fałsz </option>
        </select>
    </label><br>
    <label>Podaj treść pytania:<br>
        <input type="text" name="TrescPytania" size="200" required>

    </label><br>
    <label>Ilość punktów za poprawną odpowieź
        <input type="number"  name="pkty" min="1" required><br>
    </label><br>
        <button name="dalej" type="submit">przejdz do tworzenia odpowiedzi</button>
    </form>
    <?php
    }
    ?>
    <div>
        <form style='text-align:left'>
            <input type="button" value="Wróć"  onclick="history.back()" >
        </form><br>
    </div>
</body>
</html>