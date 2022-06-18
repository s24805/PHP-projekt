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

    $sql="SELECT nazwa, punkty FROM $nazwaQuizu ORDER BY punkty DESC;";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        ?>
        <table class="tab">
            <thead class="tab">
            <tr class="tablica0">
                <th scope="col">Nazwa</th>
                <th scope="col">Punkty</th>
            </tr>
            </thead>
            <tbody class="tab">
            <?php
            $i=0;
            while($row = $result->fetch_assoc()) {
                if($i%2==0){
                    ?>
                    <tr class="tablica1">
                        <td><?php echo$row["nazwa"];?></td>
                        <td><?php echo$row["punkty"];?></td>
                    </tr>
                    <?php
                }
                else{
                    ?>
                    <tr class="tablica2">
                        <td><?php echo$row["nazwa"];?></td>
                        <td><?php echo$row["punkty"];?></td>
                    </tr>
                    <?php
                }
                ?>
                <?php
                $i++;
            }
            ?>
            </tbody>
        </table>
        <?php
    }

    else {
        echo "0 rekordów";
    }

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