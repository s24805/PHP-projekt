<?php
session_start();
include('funkcje.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>stwórz quiz</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body style="text-align: center">
<form method="get" action="stworzPytania.php" style='text-align:center'>
<label>Podaj Tytuł quizu (moze zawierac tylko litery i cyfry)
    <input type="text"  name="nazwa" minlength="2" maxlength="20" required pattern="^[a-zA-Z0-9_-]*$"><br>
</label>
    <?php
    Napisz("Zajęte nazwy quizów: <br>");
    chdir("pytania");
    $listaquizow=WszystkieQuizy();
    $ilequizow=count($listaquizow);
    $quiz = new Quiz;
    for($i=0;$i<$ilequizow;$i++) {
        $quiz->Stworz($listaquizow[$i]);
        $nazwa = $quiz->getNazwa();
        Napisz($nazwa);
        echo "<br>";
    }
    ?>

<label>Czy mają być punkty ujemne za zła odpowiedź?
<select name="pktyujemne" >
    <option value="saujemne">Tak</option>
    <option value="nieujemne">Nie</option>
</select><br>
</label>
<label>Czy ma być ograniczony czas na odpowiedz (jesli nie- wpisz 0)
    <input type="number"  name="czas" min="0" required><br>
</label>
<label>Czy pytania mają być losowo ułożone?
<select name="lospyt" >
    <option value="losowepyt">Tak</option>
    <option value="nielosowepyt">Nie</option>
</select><br>
</label>
<label>Czy odpowiedzi mają być losowo ułożone?
<select name="losodp" >
    <option value="losoweodp">Tak</option>
    <option value="nielosoweodp">Nie</option>
</select><br>
</label>
<label>Czy można cofnąć się do poprzednich pytań?
<select name="powrut" >
    <option value="moznacofac">Tak</option>
    <option value="niemoznacofac">Nie</option>
</select>
</label>

    <br><button type="submit" name="dalej" class="button-chudy">Przejdz do tworzenia pytań</button>
<br>
</form>
    <form method="get" action="stronaglowna.php"  >
    <div>
    <button type="submit" class="button-chudy">powrót</button>
    </form><br>
</div>
</body>
</html>