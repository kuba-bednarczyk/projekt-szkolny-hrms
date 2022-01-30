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
    <title>Panel Pracownika</title>
</head>
<body>
    <h1>To jest panel pracownika</h1><br>
    <a href="./klienci.php">Klienci</a><br>
    <a href="./raporty.php">Raporty</a><br><br>

    <a href="./wyloguj.php">Wyloguj się</a>
</body>
</html>