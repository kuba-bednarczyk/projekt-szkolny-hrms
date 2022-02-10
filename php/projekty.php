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
    <link rel="stylesheet" href="../css/projekty.css">
    <title>Panel Administracyjny: Projekty</title>
</head>
<body>
    <div class="container">
        <div class="nav">
            <p>projekty</p>
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
                <li class="menu__item"><a href="./pracownicy.php#add">Dodawanie <i class="fas fa-plus"></i></a></li>
                <li class="menu__item"><a href="./pracownicy.php#delete">Usuwanie <i class="fas fa-minus"></i></a></li>
                <li class="menu__item"><a href="./pracownicy.php#modify">Modyfikacja <i class="fas fa-cog"></i></a></li>

                <li class="menu__item"><a href="./panel.php"><i class="fas fa-arrow-left"></i> Powrót</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="form-box form-box__add" id="add">
                <h1>dodawanie</h1>
                <form method="POST">
                    <label>data rozpoczęcia</label><input type="date" name="data_rozpoczecia" required placeholder="RRRR-MM-DD GG:MM:SS">
                    <label>data zakończenia</label><input type="date" name="data_zakonczenia" required placeholder="RRRR-MM-DD GG:MM:SS">
                    <label>opis </label><input type="text" name="opis" required placeholder="opis projektu">
                    <label>status </label><input type="text" name="status" required placeholder="bieżący/przyszły/archiwalny">
                    <label>id_klienta</label><input type="number" name="id_klienta" min=0 required placeholder="np. 3">
                    <input type="submit" name="submit" value="dodaj">
                </form>
            <?php
                if(isset($_POST['submit'])){
                    $db = mysqli_connect("localhost", "root", "", "aplikacja_baza");

                    $data_rozpoczecia = $_POST['data_rozpoczecia'];
                    $data_zakonczenia = $_POST['data_zakonczenia'];
                    $opis = $_POST['opis'];
                    $status = $_POST['status'];
                    $id_klienta = $_POST['id_klienta'];
                    
                    $sql = "INSERT INTO projekty VALUES (null, '$data_rozpoczecia', '$data_zakonczenia', '$opis', '$status', '$id_klienta')";
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
                        <label>Wyszukaj projekt do usunięcia (ID): </label>
                        <input type="number" name="input_search" min="0">
                        <input type="submit" name="search" value="szukaj">
                    </div>
<?php
            $db = mysqli_connect("localhost", "root", "", "aplikacja_baza");

            if(isset($_POST['input_search'])){
                $input_search = $_POST['input_search'];
                $query_search = mysqli_query(
                $db, "SELECT * FROM projekty WHERE id_projektu = $input_search");
                $query_search_all = mysqli_query($db, "SELECT * FROM projekty");


                if(empty($input_search)){
                    echo "<table>";
                    echo "<tr>";
                    echo 
                        "<th>"."id_projektu"."</th>".
                        "<th>"."data rozpoczęcia"."</th>".
                        "<th>"."data zakończenia"."</th>".
                        "<th>"."opis"."</th>".
                        "<th>"."status"."</th>".
                        "<th>"."id_klienta"."</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($query_search_all)){
                        echo "<tr>";
                        echo
                            "<td>".$row['id_projektu']."</td>".
                            "<td>".$row['data_rozpoczecia']."</td>".
                            "<td>".$row['data_zakonczenia']."</td>". 
                            "<td>".$row['opis']."</td>". 
                            "<td>".$row['status']."</td>". 
                            "<td>".$row['id_klienta']."</td>";
                        echo "</tr>";
                    }   
                    echo "</table>";

                    echo "
                    <div class='action-form'>
                        <label>Podaj ID projektu do usunięcia: </label>
                        <input type='number' name='input_del' min='0'>
                        <input type='submit' name='del' value='usuń'>
                    </div>              
                    ";


                } else if (mysqli_num_rows($query_search) == 0){
                    echo "<p>Nie ma takiego projektu w bazie!</p>";
                } else {
                    echo "<table>";
                    echo "<tr>";
                    echo 
                        "<th>"."id_projektu"."</th>".
                        "<th>"."data rozpoczęcia"."</th>".
                        "<th>"."data zakończenia"."</th>".
                        "<th>"."opis"."</th>".
                        "<th>"."status"."</th>".
                        "<th>"."id_klienta"."</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($query_search)){
                        echo "<tr>";
                        echo
                            "<td>".$row['id_projektu']."</td>".
                            "<td>".$row['data_rozpoczecia']."</td>".
                            "<td>".$row['data_zakonczenia']."</td>". 
                            "<td>".$row['opis']."</td>". 
                            "<td>".$row['status']."</td>". 
                            "<td>".$row['id_klienta']."</td>";
                        echo "</tr>";
                    }   
                    echo "</table>";

                    echo "
                    <div class='action-form'>
                        <label>Podaj ID projektu do usunięcia: </label>
                        <input type='number' name='input_del' min='0'>
                        <input type='submit' name='del' value='usuń'>
                    </div>              
                    ";
                }

                if(empty($input_search)){
                    if(isset($_POST['del'])){
                        $id_input = $_POST['input_del'];
        
                        $query_delete = mysqli_query($db,
                        "UPDATE projekty SET status = 'archiwalny' WHERE id_projektu = $id_input");
                        
                        if(mysqli_affected_rows($db) > 0){
                            echo "<h3 class='ok'>Pomyślnie usunięto projekt z bazy danych!</h3>";
                        } else {
                            echo "<h3>Błąd w usunięciu projektu z bazy</h3>";
                        }
                    }
                }
            };

            mysqli_close($db); 
?>
                </form>
            </div>


            <div class="form-box form-box__mod" id="modify">
                <h1>modyfikacja</h1>
                <form method="POST">
                    <div class="search-form-box">
                        <label>Wyszukaj projekt do modyfikacji (ID): </label>
                        <input type="number" name="input_search_mod" value="<?php 
                        if(isset($_POST['input_search_mod']))
                        echo $_POST['input_search_mod']
                        ?>" min="0">
                        <input type="submit" name="search" value="szukaj">
                    </div>
            <?php
                $db = mysqli_connect("localhost", "root", "", "aplikacja_baza");

                if(isset($_POST['input_search_mod'])){
                    $input_search = $_POST['input_search_mod'];
                    $query_search = mysqli_query($db, 
                    "SELECT * FROM projekty WHERE id_projektu = $input_search");

                    if(empty($input_search)){
                       echo "<p>Musisz podać ID!</p>";
                    } else if (mysqli_num_rows($query_search) == 0){
                        echo "<p>Nie ma takiego pracownika w bazie!</p>";
                    } else {
                    echo "<table class='mod-table'>";
                    echo "<tr>";
                    echo 
                        "<th>"."id_projektu"."</th>".
                        "<th>"."data rozpoczęcia"."</th>".
                        "<th>"."data zakończenia"."</th>".
                        "<th>"."opis"."</th>".
                        "<th>"."status"."</th>".
                        "<th>"."id_klienta"."</th>";
                    echo "</tr>";
                    $arr = array();
                    while($row = mysqli_fetch_array($query_search)){
                        echo "<tr>";
                        echo
                            "<td>".$row['id_projektu']."</td>".
                            "<td>".$row['data_rozpoczecia']."</td>".
                            "<td>".$row['data_zakonczenia']."</td>". 
                            "<td>".$row['opis']."</td>". 
                            "<td>".$row['status']."</td>". 
                            "<td>".$row['id_klienta']."</td>";
                            $arr = $row;
                        echo "</tr>";
                    }   
                    echo "</table>";

                    echo "
                    <div class='modify-box'>
                        <label>data rozpoczęcia: </label>
                        <input type='date' name='data_rozpoczecia' value='".$arr['data_rozpoczecia']."' required>

                        <label>data zakończenia: </label>
                        <input type='date' name='data_zakonczenia' value='".$arr['data_zakonczenia']."' required>

                        <label>opis: </label>
                        <input type='text' name='opis' value='".$arr['opis']."' required>

                        <label>status: </label>
                        <input type='text' name='status' value='".$arr['status']."' required>

                        <label>id_klienta: </label>
                        <input type='number' name='id_klienta' value='".$arr['id_klienta']."' min='0' required>

                        <input type='submit' name='mod' value='modyfikuj'>
                    </div>
                    ";
                    };

                    if(isset($_POST['mod'])){
                        $data_rozpoczecia = $_POST['data_rozpoczecia'];
                        $data_zakonczenia = $_POST['data_zakonczenia'];
                        $opis = $_POST['opis'];
                        $status = $_POST['status'];
                        $id_klienta = $_POST['id_klienta'];
        
                        $id = $_POST['input_search_mod'];
        
                        $query_mod = mysqli_query($db,
                        "UPDATE projekty SET 
                        data_rozpoczecia = '$data_rozpoczecia', 
                        data_zakonczenia = '$data_zakonczenia',
                        opis = '$opis',
                        status = '$status',
                        id_klienta = '$id_klienta' WHERE id_projektu = $id");
    
    
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