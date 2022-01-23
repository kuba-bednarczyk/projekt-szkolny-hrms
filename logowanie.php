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
    <link rel="stylesheet" href="./css/logowanie.css">
</head>
<body>

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

        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        if(empty($login) || empty($haslo)){
            echo "<span class='error'>Musisz podać login i hasło</span>";
            return;
        } else {
            if ($login == "admin" && $haslo == "admin"){
                echo "Zalogowany";
                $_SESSION['zalogowany'] = 1;
                header("Location:main.php");
            } else {
                echo "<span class='error'>Błędny login lub hasło</span>";
                return;
            }
        }
    }
?>
                </div>
            </form>
        </div>
    </div>

</body>
</html>