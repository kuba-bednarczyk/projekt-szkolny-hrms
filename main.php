<!-- strona główna - wybór dla pracownika i dla klienta -->

<?php
    session_start();
    if ($_SESSION['zalogowany'] != 1){
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
    <a href="./logowanie.php">Wyloguj się</a>
</body>
</html>