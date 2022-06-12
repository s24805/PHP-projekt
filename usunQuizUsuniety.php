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
$nazwaQuizu=$_GET['nazwa'];
chdir("pytania");
$nazwaQuizutxt = "$nazwaQuizu.txt";
unlink("$nazwaQuizutxt");
$plik = "_lista.txt";
$handle = fopen($plik, "r+");
$wsrodku = file_get_contents($plik);
$lines = count(file($plik));
$current = "";
for ($i = 0; $i < $lines; $i++) {
    $line = fgets($handle);
    $pieces = explode(" ", $line);
    if ($pieces[0] != $nazwaQuizu)
        $current .= "$line";
}
$current = rtrim($current);
file_put_contents($plik, $current);
fclose($handle);
$conn=sqlConnect();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql="DROP TABLE $nazwaQuizu";
$conn->close();

Napisz("Quiz o nazwie: $nazwaQuizu został usunięty");
?>
<meta http-equiv="refresh" content="2;url=stronaglowna.php" />
    </body>
</html>
