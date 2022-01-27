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
    <h1>Witaj!</h1>
    <a href="./wyloguj.php">Wyloguj się</a>
    <?php
        echo $_SESSION['login'];
    ?>
</body>
</html>