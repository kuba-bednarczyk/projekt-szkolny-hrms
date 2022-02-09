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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <title>Panel Pracownika</title>
    <link rel="stylesheet" href="../css/panel.css">
</head>
<body>
    <div class="container">
        <div class="nav">
            <a class="logout" href="./wyloguj.php"><i class="fas fa-sign-out-alt"></i> wyloguj się</a>
            <p>panel pracownika</p>
            <div class="nav__logo">
                <h1>XYZ DATA</h1><i class="fas fa-laptop-code"></i>
            </div>  
        </div>
        <div class="main-content">
            <a href="./zespoly.php">
                <h3>Zespoły</h3>
                <i class="fas fa-user-friends"></i>
            </a> <!-- zespoly -->
            <a href="./pracownicy.php">
                <h3>Pracownicy</h3>
                <i class="fas fa-user-tie"></i>
            </a>  <!-- pracownicy -->
            <a href="./raporty.php"> 
                <h3>Raporty</h3>
                <i class="far fa-list-alt"></i>
            </a> 
            <a href="./spotkania.php">
                <h3>Spotkania</h3>
                <i class="far fa-handshake"></i>
            </a> <!-- spotkania -->
            <a href="./klienci.php">
                <h3>Klienci</h3>
                <i class="fas fa-user"></i>
            </a> 
            <a href="./projekty.php">
                <h3>Projekty</h3>
                <i class="fas fa-project-diagram"></i>
            </a> 
        </div>
    </div>
</body>
</html>