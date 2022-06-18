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

<body >

    <div style="text-align: center">
        <?php
        $nazwaQuizu=$_GET['NazwaQuizu'];
        $email=$_SESSION['email'];
        Napisz("Wyniki gracza:");
        echo "<br>";
        $conn=sqlConnect();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql="SELECT nazwa, punkty FROM $nazwaQuizu WHERE email = '$email' ORDER BY punkty DESC;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "nazwa: " . $row["nazwa"]. " - punkty: " . $row["punkty"]. "<br>";
            }
        }

        else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </div>

    <div>
        <form style='text-align:center'>
            <input type="button" value="Wróć" class="button"  onclick="history.back()" >
        </form>
    </div>

</body>
</html>
