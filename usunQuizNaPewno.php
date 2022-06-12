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
        <form style='text-align:center'>
            <input type="button" value="Anuluj" class="button-chudy" onclick="history.back()" >
        </form>
    </div>
    <div>
        <form method="get" action="usunQuizUsuniety.php" style='text-align:center'>
            <input name="usun" type="submit" class="button-chudy" value="Tak,usuń" >
            <input name="nazwa" type="hidden" value="<?php echo $nazwaQuizu?>" >
        </form><br>
    </div>
    </body>
</html>