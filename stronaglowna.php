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
</head>
<body style="background-color:rgb(35, 35, 35);">
<div>
    <img src="quis.png" alt="Italian Trulli">
</div>
<?php
if(!isset($_SESSION['nick'])){
?>
<div>
<form method="get" action="logowanie.html" style='text-align:center'>
        <button type="submit">Zaloguj sie</button>
    </form><br>
</div><div>
<form method="get" action="rejestracja.html" style='text-align:center'>
        <button type="submit">Zarejestruj sie</button>
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
        <button type="submit">Przejdz do quizów</button>
    </form><br>
</div>
 <div>
    <form method="get" action="zmiananickulubhasla.php" style='text-align:center'>
        <button type="submit">Zmien haslo lub nick</button>
    </form><br>
</div>
<div>
    <form method="get" action="logowanie.html" style='text-align:center'>
        <button type="submit">Pokaz swoje wyniki</button>
    </form><br>
</div>
<div>
    <form method="get" action="stworzQwiz.php" style='text-align:center'>
        <button type="submit">Stworz qwiz</button>
    </form><br>
</div>
<div>
    <form method="get" action=""  style='text-align:center'>
        <button type="submit" name="wyloguj">wyloguj</button>
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
        <button type="submit">usun quiz</button>
    </form><br>
</div>
<?php
}
?>
<div>
    <form method="get" action="logowanie.html" style='text-align:center'>
        <button type="submit">pokaz wyniki</button>
    </form><br>
</div>
</body>
</html>