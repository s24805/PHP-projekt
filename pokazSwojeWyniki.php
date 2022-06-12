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
    <body >
<?php
$nazwaQuizu=$_GET['NazwaQuizu'];
$email=$_SESSION['email'];

$conn=sqlConnect();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql="SELECT nazwa, punkty
FROM $nazwaQuizu
WHERE email = $email
ORDER BY punkty";
$conn->close();
?>
<div>
    <form style='text-align:left'>
        <input type="button" value="Wróć" class="button"  onclick="history.back()" >
    </form>
</div>
    </body>
</html>
