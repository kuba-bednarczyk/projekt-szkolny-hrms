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
    <link rel="stylesheet" href="../css/pracownicy.css">
    <title>Panel Administracyjny: Pracownicy</title>
</head>
<body>
    <div class="container">
        <div class="nav">
            <p>pracownicy</p>
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
                    <label>id_zespolu </label><input type="number" name="id_zespolu" min="0" required>
                    <label>imie </label><input type="text" name="imie" required>
                    <label>nazwisko </label><input type="text" name="nazwisko" required>
                    <label>pesel </label><input type="text" name="pesel" minlength='11' maxlength='11' required>
                    <label>nr_telefonu </label><input type="text" name="nr_telefonu" minlength='9' maxlength='9' required>
                    <label>e-mail </label><input type="text" name="email" required>
                    <label>stanowisko </label><input type="text" name="stanowisko" required>
                    <input type="submit" name="submit" value="dodaj">
                </form>
            <?php
                if(isset($_POST['submit'])){
                    $conn = mysqli_connect("localhost", "root", "", "aplikacja_baza");

                    $id_zespolu = $_POST['id_zespolu'];
                    $imie = $_POST['imie'];
                    $nazwisko = $_POST['nazwisko'];
                    $pesel = $_POST['pesel'];
                    $nr_telefonu = $_POST['nr_telefonu'];
                    $email = $_POST['email'];
                    $stanowisko = $_POST['stanowisko'];
                    
                    $sql = "INSERT INTO pracownicy VALUES (null, '$id_zespolu', '$imie', '$nazwisko', '$pesel', '$nr_telefonu', '$email', '$stanowisko')";
                    $query = mysqli_query($conn, $sql);

                    if(mysqli_affected_rows($conn) > 0){
                        echo "<h3 class='ok'>Dane zostały zapisane w bazie danych!</h3>";
                    } else {
                        echo "<h3 class='wrong'>Błąd w zapisie danych do bazy</h3>";
                    }
                    
                    mysqli_close($conn);
                }   
            ?>
            </div>


            <div class="form-box form-box__del" id="delete">
                <h1>usuwanie</h1>
                <form method="POST">
                    <div class="search-form-box">
                        <label>Wyszukaj pracownika do usunięcia (ID): </label>
                        <input type="number" name="input_search" value="<?php 
                        if(isset($_POST['input_search']))
                        echo $_POST['input_search']
                        ?>" min="0">
                        <input type="submit" name="search" value="szukaj">
                    </div>
<?php
            $db = mysqli_connect("localhost", "root", "", "aplikacja_baza");

            if(isset($_POST['input_search'])){
                $input_search = $_POST['input_search'];
                $query_search = mysqli_query(
                $db, "SELECT * FROM pracownicy WHERE id_pracownika = $input_search");
                $query_search_all = mysqli_query($db, "SELECT * FROM pracownicy");


                if(empty($input_search)){
                    echo "<table>";
                    echo "<tr>";
                    echo 
                        "<th>"."id_pracownika"."</th>".
                        "<th>"."id_zespolu"."</th>".
                        "<th>"."imie"."</th>".
                        "<th>"."nazwisko"."</th>".
                        "<th>"."pesel"."</th>".
                        "<th>"."nr_telefonu"."</th>".
                        "<th>"."email"."</th>".
                        "<th>"."stanowisko"."</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($query_search_all)){
                        echo "<tr>";
                        echo
                            "<td>".$row['id_pracownika']."</td>".
                            "<td>".$row['id_zespolu']."</td>".
                            "<td>".$row['imie']."</td>". 
                            "<td>".$row['nazwisko']."</td>". 
                            "<td>".$row['pesel']."</td>". 
                            "<td>".$row['nr_telefonu']."</td>". 
                            "<td>".$row['email']."</td>".
                            "<td>".$row['stanowisko']."</td>";
                        echo "</tr>";
                    }   
                    echo "</table>";

                    echo "
                    <div class='action-form'>
                        <label>Podaj ID pracownika do usunięcia: </label>
                        <input type='number' name='input_del' min='0'>
                        <input type='submit' name='del' value='usuń'>
                    </div>              
                    ";
                } else if (mysqli_num_rows($query_search) == 0){
                    echo "<p>Nie ma takiego klienta w bazie!</p>";
                } else {
                    echo "<table>";
                    echo "<tr>";
                    echo 
                        "<th>"."id_pracownika"."</th>".
                        "<th>"."id_zespolu"."</th>".
                        "<th>"."imie"."</th>".
                        "<th>"."nazwisko"."</th>".
                        "<th>"."pesel"."</th>".
                        "<th>"."nr_telefonu"."</th>".
                        "<th>"."email"."</th>".
                        "<th>"."stanowisko"."</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($query_search)){
                        echo "<tr>";
                        echo
                            "<td>".$row['id_pracownika']."</td>".
                            "<td>".$row['id_zespolu']."</td>".
                            "<td>".$row['imie']."</td>". 
                            "<td>".$row['nazwisko']."</td>". 
                            "<td>".$row['pesel']."</td>". 
                            "<td>".$row['nr_telefonu']."</td>". 
                            "<td>".$row['email']."</td>".
                            "<td>".$row['stanowisko']."</td>";
                        echo "</tr>";
                    }   
                    echo "</table>";

                    echo "
                    <div class='action-form'>
                        <label>Podaj ID pracownika do usunięcia: </label>
                        <input type='number' name='input_del' min='0'>
                        <input type='submit' name='del' value='usuń'>
                    </div>              
                    ";
                }
                
                    if(isset($_POST['del'])){
                        $id_input = $_POST['input_del'];
        
                        $query_delete = mysqli_query($db,
                        "DELETE FROM pracownicy WHERE id_pracownika = $id_input");
                        
                        if(mysqli_affected_rows($db) > 0){
                            echo "<h3 class='ok'>Pomyślnie usunięto pracownika!</h3>";
                        } else {
                            echo "<h3>Błąd w usunięciu pracownika.</h3>";
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
                        <label>Wyszukaj pracownika do modyfikacji (ID): </label>
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
                    "SELECT * FROM pracownicy WHERE id_pracownika = $input_search");
                    $query_search_all = mysqli_query($db, "SELECT * FROM pracownicy");

                    if(empty($input_search)){
                        echo "<h3 class='wrong'>Musisz podać ID!</h3>";
                    } else if (mysqli_num_rows($query_search) == 0){
                        echo "<p>Nie ma takiego pracownika w bazie!</p>";
                    } else {
                    echo "<table class='mod-table'>";
                    echo "<tr>";
                    echo 
                        "<th>"."id_pracownika"."</th>".
                        "<th>"."id_zespolu"."</th>".
                        "<th>"."imie"."</th>".
                        "<th>"."nazwisko"."</th>".
                        "<th>"."pesel"."</th>".
                        "<th>"."nr_telefonu"."</th>".
                        "<th>"."email"."</th>".
                        "<th>"."stanowisko"."</th>";
                    echo "</tr>";
                    $arr = array();
                    while($row = mysqli_fetch_array($query_search)){
                        echo "<tr>";
                        echo
                            "<td>".$row['id_pracownika']."</td>".
                            "<td>".$row['id_zespolu']."</td>".
                            "<td>".$row['imie']."</td>". 
                            "<td>".$row['nazwisko']."</td>". 
                            "<td>".$row['pesel']."</td>". 
                            "<td>".$row['nr_telefonu']."</td>". 
                            "<td>".$row['email']."</td>".
                            "<td>".$row['stanowisko']."</td>";
                            $arr = $row;
                        echo "</tr>";
                    }   
                    echo "</table>";

                    echo "
                    <div class='modify-box'>
                        <label>id_zespołu: </label>
                        <input type='number' name='id_zespolu' value='".$arr['id_zespolu']."' min='0' required>

                        <label>imię: </label>
                        <input type='text' name='imie' value='".$arr['imie']."' required>

                        <label>nazwisko: </label>
                        <input type='text' name='nazwisko' value='".$arr['nazwisko']."' required>

                        <label>pesel: </label>
                        <input type='text' name='' value='".$arr['pesel']."' minlength='11' maxlength='11' required>

                        <label>nr. telefonu: </label>
                        <input type='text' name='nr_telefonu' value='".$arr['nr_telefonu']."' minlength='9' maxlength='9' required>

                        <label>e-mail: </label>
                        <input type='text' name='email'' value='".$arr['email']."' required>

                        <label>stanowisko: </label>
                        <input type='text' name='stanowsiko' value='".$arr['stanowisko']."' required>

                        <input type='submit' name='mod' value='modyfikuj'>
                    </div>
                    ";
                    };

                    if(isset($_POST['mod'])){
                        $id_zespolu = $_POST['id_zespolu'];
                        $imie = $_POST['imie'];
                        $nazwisko = $_POST['nazwisko'];
                        $pesel = $_POST['pesel'];
                        $nr_telefonu = $_POST['nr_telefonu'];
                        $email = $_POST['email'];
                        $stanowisko = $_POST['stanowisko'];
        
                        $id = $_POST['input_search_mod'];
        
                        $query_mod = mysqli_query($db,
                        "UPDATE pracownicy SET 
                        id_zespolu = '$id_zespolu', 
                        imie = '$imie',
                        nazwisko = '$nazwisko',
                        pesel = '$pesel',
                        nr_telefonu = '$nr_telefonu',
                        email = '$email',
                        stanowisko = '$stanowisko',
                        WHERE id_pracownika = $id ");
    
    
                        if(mysqli_affected_rows($db) > 0){
                            echo "<h3 class='ok'>Pomyślnie zmodyfikowano informacje o pracowniku.</h3>";
                        } else {
                            echo "<h3 class='wrong'>Błąd przy modyfikacji</h3>";
                        }
                    }
                };
            ?>
                </form>
            </div>
            <div class="form-box form-box__addToMet" id="addToMet">
                <h1>Dodawanie pracownika do spotkania</h1>
                <form method="POST">
                    <div class="search-form-box">
                        <label>id_spotkania</label>
                        <input type="number" min="0" name="id_spotkania" required>

                        <label>id_pracownika</label>
                        <input type="number" min="0" name="id_pracownika" required>

                        <input type="submit" name="submit_addToMet" value="dodaj">
                    </div>
                </form>
                <?php
                if(isset($_POST['submit_addToMet'])){
                    $conn = mysqli_connect("localhost", "root", "", "aplikacja_baza");

                    $id_spotkania = $_POST['id_spotkania'];
                    $id_pracownika = $_POST['id_pracownika'];
                    
                    $sql = "INSERT INTO uczestnicy_spotkania VALUES ($id_spotkania,$id_pracownika)";
                    $query = mysqli_query($conn, $sql);

                    if(mysqli_affected_rows($conn) > 0){
                        echo "<h3 class='ok'>Dane zostały zapisane w bazie danych!</h3>";
                    } else {
                        echo "<h3 class='wrong'>Błąd w zapisie danych do bazy</h3>";
                    }
                    
                    mysqli_close($conn);
                }   
            ?>
            </div>
        </div>
    </div>


    <script src="../js/menuAnimation.js"></script>
    </body>
</html>