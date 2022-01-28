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
    <title>Klienci</title>
</head>
<body>
    <h1>Dodawanie klientów</h1>
    <form method="POST">
        <label>Nazwa: </label><input type="text" name="nazwa"><br>
        <label>Nr. telefonu: </label><input type="text" name="nr_telefonu"><br>
        <label>E-mail: </label><input type="text" name="email"><br>
        <label>Miejscowość: </label><input type="text" name="miejscowosc"><br>
        <label>Ulica: </label><input type="text" name="ulica"><br>
        <label>Numer: </label><input type="text" name="numer"><br>
        <input type="submit" name="submit" value="dodaj">
    </form><br>
    <?php
        if(isset($_POST['submit'])){
            $db = mysqli_connect("localhost", "root", "", "aplikacja_baza");

            $klienci_nazwa = $_POST['nazwa'];
            $klienci_telefon = $_POST['nr_telefonu'];
            $klienci_email = $_POST['email'];
            $klienci_miejsc = $_POST['miejscowosc'];
            $klienci_ulica = $_POST['ulica'];
            $klienci_numer = $_POST['numer'];

            // ustawienie poprawnego ID w bazie
            function setAutoIncrement(){
                global $db;
                $sql_select_all = "SELECT * FROM klienci";
                $query_select_all = mysqli_query($db, $sql_select_all);

                $rowCount = mysqli_num_rows($query_select_all);
                $sql_autoincrement = "ALTER TABLE klienci AUTO_INCREMENT=$rowCount";
                $query_autoincrement = mysqli_query($db, $sql_autoincrement);
                
                return $query_autoincrement;
            };
            setAutoIncrement();

            $sql = "INSERT INTO klienci VALUES (null, '$klienci_nazwa', '$klienci_telefon', '$klienci_email', '$klienci_miejsc', '$klienci_ulica', '$klienci_numer')";
            $query = mysqli_query($db, $sql);

            if(mysqli_affected_rows($db) > 0){
                echo "Dane zostały zapisane w bazie danych!";
            } else {
                echo "Błąd w zapisie danych do bazy";
            }
            
            mysqli_close($db);
        }   
    ?>

<a href="./panel.php">Powrót</a><br>
<a href="./wyloguj.php">Wyloguj się</a>
</body>
</html>