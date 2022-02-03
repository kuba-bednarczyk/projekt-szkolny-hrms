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
    <link rel="stylesheet" href="../css/klienci_mod.css">
    <title>Panel Administracyjny: Klienci</title>
</head>
<body>
    <div class="container">
        <div class="nav">
            <p>klienci</p>
            <div class="nav__logo">
                <h1>XYZ DATA</h1><i class="fas fa-laptop-code"></i>
            </div>  
        </div>
        <button class="hamburger">
            <span class="hamburger__box"></span>
            <span class="hamburger__inner"></span>
        </button>
        <div class="menu">
            <ul class="menu__list">
                <li class="menu__item"><a href="./klienci.php#add">Dodawanie <i class="fas fa-plus"></i></a></li>
                <li class="menu__item"><a href="./klienci.php#delete">Usuwanie <i class="fas fa-minus"></i></a></li>
                <li class="menu__item"><a href="./klienci.php#modify">Modyfikacja <i class="fas fa-cog"></i></a></li>

                <li class="menu__item"><a href="./panel.php"><i class="fas fa-arrow-left"></i> Powrót</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="form-box form-box__add" id="add">
                <h1>dodawanie</h1>
                <form method="POST">
                    <label>Nazwa: </label><input type="text" name="nazwa">
                    <label>Nr. telefonu: </label><input type="text" name="nr_telefonu">
                    <label>E-mail: </label><input type="text" name="email">
                    <label>Miejscowość: </label><input type="text" name="miejscowosc">
                    <label>Ulica: </label><input type="text" name="ulica">
                    <label>Numer domu: </label><input type="text" name="numer">
                    <input type="submit" name="submit" value="dodaj">
                </form>
                <!-- <h3>dane zostały pomyślnie zapisane do bazy!</h3> -->
            <?php
                if(isset($_POST['submit'])){
                    $db = mysqli_connect("localhost", "root", "", "aplikacja_baza");

                    $klienci_nazwa = $_POST['nazwa'];
                    $klienci_telefon = $_POST['nr_telefonu'];
                    $klienci_email = $_POST['email'];
                    $klienci_miejsc = $_POST['miejscowosc'];
                    $klienci_ulica = $_POST['ulica'];
                    $klienci_numer = $_POST['numer'];

                    $sql = "INSERT INTO klienci VALUES (null, '$klienci_nazwa', '$klienci_telefon', '$klienci_email', '$klienci_miejsc', '$klienci_ulica', '$klienci_numer')";
                    $query = mysqli_query($db, $sql);

                    if(mysqli_affected_rows($db) > 0){
                        echo "<h3 class='ok'>Dane zostały zapisane w bazie danych!</h3>";
                    } else {
                        echo "<h3 class='wrong'>Błąd w zapisie danych do bazy</h3>";
                    }
                    
                    mysqli_close($db);
                }   
            ?>
            </div>
            <div class="form-box form-box__del" id="delete">
                <h1>usuwanie</h1>
                <form method="POST"></form>

            </div>
            <div class="form-box form-box__mod" id="modify">
                <h1>modyfikacja</h1>
            </div>
        </div>
    </div>


    <script src="../js/menuAnimation.js"></script>
</body>
</html>