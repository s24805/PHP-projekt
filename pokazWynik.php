<?php
session_start();
include('funkcje.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wyniki</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body style="text-align: center ">
<?php
$nazwaQuizu=$_GET['NazwaQuizu'];
$conn=sqlConnect();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql="SELECT nazwa, punkty
FROM $nazwaQuizu
ORDER BY punkty";
$conn->close();
?>
<br>
<div>
    <form style='text-align:left'>
        <input type="button" value="Wróć" class="button"  onclick="history.back()" >
    </form>
</div>
</body>
</html>