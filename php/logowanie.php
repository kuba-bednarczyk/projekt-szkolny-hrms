<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/logowanie.css">
</head>
<body>

<a href="../index.html" class="go-back">
    <i class="fas fa-arrow-left"></i><br>
    <span>strona główna</span>
</a>

<div class="container">
    <div class="login">
        <div class="login__logo">
            <i class="fas fa-users"></i>
        </div>
        <div class="login__form">
            <form method="post">
                <div class="login__inputs">
                    <label>Login</label>
                    <input type="text" name="login" placeholder="user123">
                    <label>Hasło</label>
                    <input type="password" name="haslo" placeholder="✱✱✱✱✱✱">
                    <input type="submit" value="Zaloguj" name="submit">
<?php
    if(isset($_POST['submit'])){

        $dbConnect = mysqli_connect("localhost", "root", "", "aplikacja_baza");

        $login = mysqli_real_escape_string($dbConnect, $_POST['login']);
        $passwd = mysqli_real_escape_string($dbConnect, $_POST['haslo']);
        $passwd = sha1($passwd);

        $sql= "SELECT * FROM uzytkownicy WHERE login = '$login' AND haslo = '$passwd'";
        $query = mysqli_query($dbConnect, $sql);

        if(mysqli_num_rows($query)>0){
            $_SESSION['login'] = $login;
            header('Location: panel.php');
        } else {
            echo "<span class='error'>Błąd logowania</span>";
        }

        mysqli_close($dbConnect);
    }
?>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

