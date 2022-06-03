<?php
session_start();
include('funkcje.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>stwórz quiz</title>
</head>
<body >
<form method="get" action="stworzPytania.php" style='text-align:left'>
<label>Podaj Tytuł quizu
    <input type="text"  name="nazwa" minlength="2" required><br>
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

    <br><button type="submit" name="dalej">Przejdz do tworzenia pytań</button>
<br>
</form>
    <form method="get" action="stronaglowna.php" style='text-align:left'>
    <div>
    <button type="submit">powrót</button>
    </form><br>
</div>
</body>
</html>