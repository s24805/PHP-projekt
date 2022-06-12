<?php
session_start();
include('funkcje.php');
unset($_SESSION['MamyPrzynajmniej1pytanie']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>quiz</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div>
    <img src="quis.png" alt="quis png">
</div>
<?php
if(!isset($_SESSION['nick'])){
?>
<div>
<form method="get" action="logowanie.html" style='text-align:center'>
        <button type="submit" class="button">Zaloguj sie</button>
    </form><br>
</div><div>
<form method="get" action="rejestracja.html" style='text-align:center'>
        <button type="submit" class="button">Zarejestruj sie</button>
    </form><br>
</div>
<?php
}
?>
<?php
if(isset($_SESSION['nick'])){
?>
<div><form method="get" action=""  style='text-align:center'>
        <?php Napisz("Witaj ".$_SESSION['nick']);
        echo "<br>"?>
    </form>
</div>
<div>
    <form method="get" action="listaquizow.php" style='text-align:center'>
        <button type="submit" class="button">Przejdz do quizów</button>
    </form><br>
</div>
 <div>
    <form method="get" action="zmiananickulubhasla.php" style='text-align:center'>
        <button type="submit" class="button">Zmien haslo lub nick</button>
    </form><br>
</div>
<div>
    <form method="get" action="logowanie.html" style='text-align:center'>
        <button type="submit" class="button">Pokaz swoje wyniki</button>
    </form><br>
</div>
<div>
    <form method="get" action="stworzQwiz.php" style='text-align:center'>
        <button type="submit" class="button">Stworz qwiz</button>
    </form><br>
</div>
<div>
    <form method="get" action=""  style='text-align:center'>
        <button type="submit" class="button" name="wyloguj">wyloguj</button>
        <?php
        if(isset($_GET['wyloguj'])){
            unset($_SESSION['nick']);
            unset($_SESSION['email']);
            unset($_SESSION['admin']);
        ?>
        <meta http-equiv="refresh" content="0.1">
        <?php
        }
        ?>
    </form><br>
</div>
<?php
}
?>
<?php
if(isset($_SESSION['admin']) && $_SESSION['admin']=="1"){
?>
<div>
    <form method="get" action="usunQuiz.php" style='text-align:center'>
        <button type="submit" class="button">usun quiz</button>
    </form><br>
</div>
<?php
}
?>
<div>
    <form method="get" action="listaWynikow.php" style='text-align:center'>
        <button type="submit" class="button">pokaz wyniki</button>
    </form><br>
</div>
</body>
</html>