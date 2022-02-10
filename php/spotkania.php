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
    <link rel="stylesheet" href="../css/spotkania.css">
    <title>Panel Administracyjny: Spotkania</title>
</head>
<body>
    <div class="container">
        <div class="nav">
            <p>spotkania</p>
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
                <li class="menu__item"><a href="./spotkania.php#add">Dodawanie <i class="fas fa-plus"></i></a></li>
                <li class="menu__item"><a href="./spotkania.php#delete">Usuwanie <i class="fas fa-minus"></i></a></li>
                <li class="menu__item"><a href="./spotkania.php#modify">Modyfikacja <i class="fas fa-cog"></i></a></li>

                <li class="menu__item"><a href="./panel.php"><i class="fas fa-arrow-left"></i> Powrót</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="form-box form-box__add" id="add">
                <h1>dodawanie</h1>
                <form method="POST">
                    <label>id_projektu</label><input type="number" name="id_projektu" min="0" required>
                    <label>id_klienta</label><input type="number" name="id_klienta" min='0' required>
                    <label>data</label><input type="date" name="data" required>
                    <label>godzina</label><input type="time" name="godzina" required>
                    <label>status</label><input type="text" name="status" placeholder="bieżący/przyszły/archiwalny" required>
                    <input type="submit" name="submit" value="dodaj">
                </form>
            <?php
                if(isset($_POST['submit'])){
                    $conn = mysqli_connect("localhost", "root", "", "aplikacja_baza");

                    $id_projektu = $_POST['id_projektu'];
                    $id_klienta = $_POST['id_klienta'];
                    $data = $_POST['data'];
                    $godzina = $_POST['godzina'];
                    $status = $_POST['status'];
                    
                    $sql = "INSERT INTO spotkania_z_klientami VALUES (null, '$id_projektu', '$id_klienta', '$data','$godzina','$status')";
                    $query = mysqli_query($conn, $sql);

                    if(mysqli_affected_rows($conn) > 0){
                        echo "<h3 class='ok'>Dane zostały zapisane w bazie danych!</h3>";
                    } else {
                        echo "<h3 class='wrong'>Błąd w zapisie danych do bazy.</h3>";
                        // echo $conn -> error;
                    }
                    
                    mysqli_close($conn);
                }   
            ?>
            </div>


            <div class="form-box form-box__del" id="delete">
                <h1>usuwanie</h1>
                <form method="POST">
                    <div class="search-form-box">
                        <label>Wyszukaj spotkanie do usunięcia (ID): </label>
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
                $db, "SELECT * FROM spotkania_z_klientami WHERE id_spotkania = $input_search");
                $query_search_all = mysqli_query($db, "SELECT * FROM spotkania_z_klientami");


                if(empty($input_search)){
                    echo "<table>";
                    echo "<tr>";
                    echo
                        "<th>"."id_spotkania"."</th>".
                        "<th>"."id_projektu"."</th>".
                        "<th>"."id_klienta"."</th>".
                        "<th>"."data"."</th>".
                        "<th>"."godzina"."</th>".
                        "<th>"."status"."</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($query_search_all)){
                        echo "<tr>";
                        echo
                            "<td>".$row['id_spotkania']."</td>".
                            "<td>".$row['id_projektu']."</td>".
                            "<td>".$row['id_klienta']."</td>".
                            "<td>".$row['data']."</td>".
                            "<td>".$row['godzina']."</td>".
                            "<td>".$row['status']."</td>";
                        echo "</tr>";
                    }   
                    echo "</table>";

                    echo "
                    <div class='action-form'>
                        <label>Podaj ID spotkania do usunięcia: </label>
                        <input type='number' name='input_del' min='0'>
                        <input type='submit' name='del' value='usuń'>
                    </div>              
                    ";
                } else if (mysqli_num_rows($query_search) == 0){
                    echo "<p>Nie ma takiego spotkania w bazie!</p>";
                } else {
                    echo "<table>";
                    echo "<tr>";
                    echo
                        "<th>"."id_spotkania"."</th>".
                        "<th>"."id_projektu"."</th>".
                        "<th>"."id_klienta"."</th>".
                        "<th>"."data"."</th>".
                        "<th>"."godzina"."</th>".
                        "<th>"."status"."</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($query_search)){
                        echo "<tr>";
                        echo
                            "<td>".$row['id_spotkania']."</td>".
                            "<td>".$row['id_projektu']."</td>".
                            "<td>".$row['id_klienta']."</td>".
                            "<td>".$row['data']."</td>".
                            "<td>".$row['godzina']."</td>".
                            "<td>".$row['status']."</td>";
                        echo "</tr>";
                    }   
                    echo "</table>";

                    echo "
                    <div class='action-form'>
                        <label>Podaj ID spotkania do usunięcia: </label>
                        <input type='number' name='input_del' min='0'>
                        <input type='submit' name='del' value='usuń'>
                    </div>              
                    ";
                }
                
                    if(isset($_POST['del'])){
                        $id_input = $_POST['input_del'];
        
                        $query_delete = mysqli_query($db,
                        "UPDATE spotkania_z_klientami SET status = 'archiwalny' WHERE id_spotkania = $id_input");
                        
                        if(mysqli_affected_rows($db) > 0){
                            echo "<h3 class='ok'>Pomyślnie usunięto spotkanie z bazy danych!</h3>";
                        } else {
                            echo "<h3>Błąd w usunięciu spotkania z bazy.</h3>";
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
                        <label>Wyszukaj spotkanie do modyfikacji (ID): </label>
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
                    "SELECT * FROM spotkania_z_klientami WHERE id_spotkania = $input_search");
                    $query_search_all = mysqli_query($db, "SELECT * FROM spotkania_z_klientami");

                    if(empty($input_search)){
                        echo "<h3 class='wrong'>Musisz podać ID!</h3>";
                    } else if (mysqli_num_rows($query_search) == 0){
                        echo "<p>Nie ma takiego spotkania w bazie!</p>";
                    } else {
                    echo "<table class='mod-table'>";
                    echo "<tr>";
                    echo
                        "<th>"."id_spotkania"."</th>".
                        "<th>"."id_projektu"."</th>".
                        "<th>"."id_klienta"."</th>".
                        "<th>"."data"."</th>".
                        "<th>"."godzina"."</th>".
                        "<th>"."status"."</th>";
                    echo "</tr>";
                    $arr = array();
                    while($row = mysqli_fetch_array($query_search)){
                        echo "<tr>";
                        echo 
                            "<td>".$row['id_spotkania']."</td>".
                            "<td>".$row['id_projektu']."</td>".
                            "<td>".$row['id_klienta']."</td>".
                            "<td>".$row['data']."</td>".
                            "<td>".$row['godzina']."</td>".
                            "<td>".$row['status']."</td>";
                            $arr = $row;
                        echo "</tr>";
                    }   
                    echo "</table>";

                    echo "
                    <div class='modify-box'>
                        <label>id_projektu: </label>
                        <input type='number' min='0' name='id_projektu' value='".$arr['id_projektu']."' required>

                        <label>id_klienta: </label>
                        <input type='number' min='0' name='id_klienta' value='".$arr['id_klienta']."' required>

                        <label>data: </label>
                        <input type='date' name='data' value='".$arr['data']."' required>

                        
                        <label>godzina: </label>
                        <input type='time' name='godzina' value='".$arr['godzina']."' required>

                        
                        <label>status: </label>
                        <input type='text' name='status' value='".$arr['status']."' required>

                        <input type='submit' name='mod' value='modyfikuj'>
                    </div>
                    ";
                    };

                    if(isset($_POST['mod'])){
                        $id_projektu = $_POST['id_projektu'];
                        $id_klienta = $_POST['id_klienta'];
                        $data = $_POST['data'];
                        $godzina = $_POST['godzina'];
                        $status = $_POST['status'];
        
                        $id = $_POST['input_search_mod'];
        
                        $query_mod = mysqli_query($db,
                        "UPDATE spotkania_z_klientami SET 
                        id_projektu = '$id_projektu', 
                        id_klienta = '$id_klienta', 
                        data = '$data',
                        godzina = '$godzina',
                        status = '$status'
                        WHERE id_spotkania = $id");
    
    
                        if(mysqli_affected_rows($db) > 0){
                            echo "<h3 class='ok'>Pomyślnie zmodyfikowano informacje o spotkaniu!</h3>";
                        } else {
                            echo "<h3 class='wrong'>Błąd przy modyfikacji</h3>";
                            // echo $db -> error;
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