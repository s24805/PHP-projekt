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
    $StringQuizu=$_GET['StringQuizu'];
    $nazwaQuizu = $_GET['NazwaQuizu'];
    Napisz("Czy ten Quiz: $nazwaQuizu ma zostać usunięty?");
    //echo "<br>";
    $quiz = new Quiz;
    $quiz->Stworz($StringQuizu);
    $quiz->Wypisz();
    //echo "<br>";
    //Napisz("ma zostać usunięty?");
    ?>
    <div>
        <form style='text-align:left'>
            <input type="button" value="Anuluj"  onclick="history.back()" >
        </form>
    </div>
    <div>
        <form method="get" action="usunQuizUsuniety.php" style='text-align:left'>
            <input name="usun" type="submit" value="Tak,usuń" >
            <input name="nazwa" type="hidden" value="<?php echo $nazwaQuizu?>" >
        </form><br>
    </div>
    </body>
</html>