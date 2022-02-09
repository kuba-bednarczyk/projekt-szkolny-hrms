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
    <link rel="stylesheet" href="../css/klienci.css">
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
                    <label>Nazwa: </label><input type="text" name="nazwa" required>
                    <label>Nr. telefonu: </label><input type="text" name="nr_telefonu" min="0" minlength="9" maxlength="9" required>
                    <label>E-mail: </label><input type="text" name="email" required>
                    <label>Miejscowość: </label><input type="text" name="miejscowosc" required>
                    <label>Ulica: </label><input type="text" name="ulica" required>
                    <label>Numer domu: </label><input type="text" name="numer" required>
                    <input type="submit" name="submit" value="dodaj" required>
                </form>
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
                <form method="POST">
                    <div class="search-form-box">
                        <label>Wyszukaj klienta do usunięcia (ID): </label>
                        <input type="number" name="input_search" value="<?php 
                        if(isset($_POST['input_search']))
                        echo $_POST['input_search']
                        ?>" min="0">
                        <input type="submit" name="search" value="szukaj">
                    </div>
<!-- -----------------------PHP USUWANIE-------------------------------------- -->
<?php
            $db = mysqli_connect("localhost", "root", "", "aplikacja_baza");

            if(isset($_POST['input_search'])){
                $input_search = $_POST['input_search'];
                $query_search = mysqli_query(
                $db, "SELECT * FROM klienci WHERE id_klienta = $input_search");

                $query_search_all = mysqli_query($db, "SELECT * FROM klienci");

                if(empty($input_search)){
                    echo "<table>";
                    echo "<tr>";
                    echo 
                        "<th>"."id_klienta"."</th>".
                        "<th>"."nazwa"."</th>".
                        "<th>"."nr_telefonu"."</th>".
                        "<th>"."email"."</th>".
                        "<th>"."miejscowość"."</th>".
                        "<th>"."ulica"."</th>".
                        "<th>"."numer"."</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($query_search_all)){
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
                    echo "</table>";

                    echo "
                    <div class='action-form'>
                        <label>Podaj ID klienta do usunięcia: </label>
                        <input type='number' name='input_del'>
                        <input type='submit' name='del' value='usuń'>
                    </div>              
                    ";
                } else if (mysqli_num_rows($query_search) == 0){
                    echo "<p>Nie ma takiego klienta w bazie!</p>";
                } else {
                    echo "<table>";
                    echo "<tr>";
                    echo 
                        "<th>"."id_klienta"."</th>".
                        "<th>"."nazwa"."</th>".
                        "<th>"."nr_telefonu"."</th>".
                        "<th>"."email"."</th>".
                        "<th>"."miejscowość"."</th>".
                        "<th>"."ulica"."</th>".
                        "<th>"."numer"."</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($query_search)){
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
                    echo "</table>";

                    echo "
                    <div class='action-form'>
                        <label>Podaj ID klienta do usunięcia: </label>
                        <input type='number' name='input_del'>
                        <input type='submit' name='del' value='usuń'>
                    </div>              
                    ";
                }

                if(empty($input_search)){
                    if(isset($_POST['del'])){
                        $id_input = $_POST['input_del'];
        
                        $query_delete = mysqli_query($db,
                        "DELETE FROM klienci WHERE id_klienta = $id_input");
                        
                        if(mysqli_affected_rows($db) > 0){
                            echo "<h3 class='ok'>Pomyślnie usunięto klienta z bazy danych!</h3>";
                        } else {
                            echo "<h3>Błąd w usunięciu klienta z bazy</h3>";
                        }
                    }
                }
            };

            mysqli_close($db); 
?>
<!-- ------------------------END PHP------------------------ -->
                </form>
            </div>


            <div class="form-box form-box__mod" id="modify">
                <h1>modyfikacja</h1>
                <form method="POST">
                    <div class="search-form-box">
                        <label>Wyszukaj klienta do modyfikacji (ID): </label>
                        <input type="number" name="input_search_mod" min="0" value="<?php 
                        if(isset($_POST['input_search_mod']))
                        echo $_POST['input_search_mod']
                        ?>">
                        <input type="submit" name="search" value="szukaj">
                    </div>
<!----------------------- PHP MODYFIKACJA -------------------------->
            <?php
                $db = mysqli_connect("localhost", "root", "", "aplikacja_baza");

                if(isset($_POST['input_search_mod'])){
                    $input_search = $_POST['input_search_mod'];
                    $query_search = mysqli_query($db, 
                    "SELECT * FROM klienci WHERE id_klienta = $input_search");

                    if(empty($input_search)){
                       echo "<p>Musisz podać ID!</p>";
                    } else if (mysqli_num_rows($query_search) == 0){
                        echo "<p>Nie ma takiego klienta w bazie!</p>";
                    } else {
                    echo "<table class='mod-table'>";
                    echo "<tr>";
                    echo 
                        "<th>"."id_klienta"."</th>".
                        "<th>"."nazwa"."</th>".
                        "<th>"."nr_telefonu"."</th>".
                        "<th>"."email"."</th>".
                        "<th>"."miejscowość"."</th>".
                        "<th>"."ulica"."</th>".
                        "<th>"."numer"."</th>";
                    echo "</tr>";
                    $arr = array();
                    while($row = mysqli_fetch_array($query_search)){
                        echo "<tr>";
                        echo
                            "<td>".$row['id_klienta']."</td>".
                            "<td>".$row['nazwa']."</td>".
                            "<td>".$row['nr_telefonu']."</td>". 
                            "<td>".$row['email']."</td>". 
                            "<td>".$row['miejscowosc']."</td>". 
                            "<td>".$row['ulica']."</td>". 
                            "<td>".$row['numer']."</td>";
                            $arr = $row;
                        echo "</tr>";
                    }   
                    echo "</table>";

                    echo "
                    <div class='modify-box'>
                        <label>Nazwa: </label>
                        <input type='text' name='mod_name' value='".$arr['nazwa']."' required>

                        <label>Nr. telefonu: </label>
                        <input type='text' name='mod_tel' value='".$arr['nr_telefonu']."' minlength='9' maxlength='9' required>

                        <label>E-mail: </label>
                        <input type='text' name='mod_email' value='".$arr['email']."' required>

                        <label>Miejscowość: </label>
                        <input type='text' name='mod_miejsc' value='".$arr['miejscowosc']."' required>

                        <label>Ulica: </label>
                        <input type='text' name='mod_ul' value='".$arr['ulica']."' required>

                        <label>Numer: </label>
                        <input type='number' name='mod_nr' value='".$arr['numer']."' required>
                        <input type='submit' name='mod' value='modyfikuj'>
                    </div>
                    ";
                    };

                    if(isset($_POST['mod'])){
                        $mod_name = $_POST['mod_name'];
                        $mod_tel = $_POST['mod_tel'];
                        $mod_email = $_POST['mod_email'];
                        $mod_miejsc = $_POST['mod_miejsc'];
                        $mod_ul = $_POST['mod_ul'];
                        $mod_nr = $_POST['mod_nr'];
        
                        $id = $_POST['input_search_mod'];
        
                        $query_mod = mysqli_query($db,
                        "UPDATE klienci SET 
                        nazwa = '$mod_name', 
                        nr_telefonu = '$mod_tel',
                        email = '$mod_email',
                        miejscowosc = '$mod_miejsc',
                        ulica = '$mod_ul',
                        numer = '$mod_nr' WHERE id_klienta = $id ");
    
    
                        if(mysqli_affected_rows($db) > 0){
                            echo "<h3 class='ok'>Pomyślnie zmodyfikowano informacje o kliencie.</h3>";
                        } else {
                            echo "<h3 class='wrong'>Błąd przy modyfikacji</h3>";
                        }
                    }
                };
            ?>
                </form>
            </div>
        </div>
    </div>


    <script src="../js/menuAnimation.js"></script>
    </body>
</html>