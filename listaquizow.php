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
chdir("pytania");
$listaquizow=WszystkieQuizy();
$ilequizow=count($listaquizow);
$quiz = new Quiz;
for($i=0;$i<$ilequizow;$i++){
    $quiz->Stworz($listaquizow[$i]);
    $opis=$quiz->Wypisz();
    $nazwa=$quiz->getNazwa();
    Napisz($opis);
    ?>
    <div>
        <form method="get" action="przygotowanieQuizu.php" style='text-align:center'>
            <input type="hidden"  name="StringQuizu" value="<?php echo $listaquizow[$i]?>">
            <input type="hidden"  name="NazwaQuizu" value="<?php echo $nazwa?>">
            <button type="submit" class="button-chudy">Rozwiąż Quiz</button>
        </form>
    </div>
    <div>
        <form method="get" action="pokazSwojeWyniki.php" style='text-align:center'>
            <input type="hidden"  name="NazwaQuizu" value="<?php echo $nazwa?>">
            <button type="submit" class="button-chudy">Pokaż swoje wyniki</button>
        </form><br>
    </div>
<?php
}
?>
<div>
    <form method="get" action="stronaglowna.php" style='text-align:center'>
        <button type="submit" class="button-chudy">Powróć do strony głownej</button>
    </form><br>
</div>
</body>
</html>
