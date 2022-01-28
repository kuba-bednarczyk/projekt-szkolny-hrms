<?php
session_start();
    if ($_SESSION['login'] == null){
        header("Location: logowanie.php");
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raporty - wyswietlanie informacji</title>
    <style>
        table, td{
            border-collapse: collapse;
            border: 2px solid black;
            padding: 10px;
        }

        h1,h2,table{
            text-align: center;
            margin: 0 auto;
        }

        a{
            text-align: center;
            margin: 0 auto;
            float: right;
        }
    </style>
</head>
<body>
    <h1>raporty</h1><br>
    <h2>Klienci:</h2><br>
    <table>
        <tr>
            <td>id_klienta</td>
            <td>nazwa</td>
            <td>nr_telefonu</td>
            <td>email</td>
            <td>miejscowosc</td>
            <td>ulica</td>
            <td>numer</td>
        </tr>
        <?php
            $db = mysqli_connect("localhost", "root", "", "aplikacja_baza");
            $sql1 = "SELECT * FROM klienci";
            $query = mysqli_query($db, $sql1);

            while($row = mysqli_fetch_array($query)){
                echo "<tr>";
                echo 
                "<td>".$row['id_klienta']."</td>".
                "<td>".$row['nazwa']."</td>".
                "<td>".$row['nr_telefonu']."</td>". 
                "<td>".$row['email']."</td>". 
                "<td>".$row['miejscowosc']."</td>". 
                "<td>".$row['ulica']."</td>". 
                "<td>".$row['numer']."</td>";
                echo "</tr>";
            }
            mysqli_close($db);
        ?>
    </table><br>
    
    <a href="./panel.php">Powrót</a><br>
    <a href="./wyloguj.php">Wyloguj się</a>
</body>
</html>