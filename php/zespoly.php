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
    <link rel="stylesheet" href="../css/zespoly.css">
    <title>Panel Administracyjny: Zespoły</title>
</head>
<body>
    <div class="container">
        <div class="nav">
            <p>zespoły</p>
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
                <li class="menu__item"><a href="./zespoly.php#add">Dodawanie <i class="fas fa-plus"></i></a></li>
                <li class="menu__item"><a href="./zespoly.php#delete">Usuwanie <i class="fas fa-minus"></i></a></li>
                <li class="menu__item"><a href="./zespoly.php#modify">Modyfikacja <i class="fas fa-cog"></i></a></li>

                <li class="menu__item"><a href="./panel.php"><i class="fas fa-arrow-left"></i> Powrót</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="form-box form-box__add" id="add">
                <h1>dodawanie</h1>
                <form method="POST">
                    <label>id_projektu</label><input type="number" name="id_projektu" min="0" required>
                    <label>nazwa zespołu</label><input type="text" name="nazwa_zespolu" required>
                    <input type="submit" name="submit" value="dodaj" required>
                </form>
            <?php
                if(isset($_POST['submit'])){
                    $conn = mysqli_connect("localhost", "root", "", "aplikacja_baza");

                    $id_projektu = $_POST['id_projektu'];
                    $nazwa_zespolu = $_POST['nazwa_zespolu'];
                    
                    $sql = "INSERT INTO zespoly VALUES (null, '$id_projektu', '$nazwa_zespolu')";
                    $query = mysqli_query($conn, $sql);

                    if(mysqli_affected_rows($conn) > 0){
                        echo "<h3 class='ok'>Dane zostały zapisane w bazie danych!</h3>";
                    } else {
                        echo "<h3 class='wrong'>Błąd w zapisie danych do bazy.</h3>";
                    }
                    
                    mysqli_close($conn);
                }   
            ?>
            </div>


            <div class="form-box form-box__del" id="delete">
                <h1>usuwanie</h1>
                <form method="POST">
                    <div class="search-form-box">
                        <label>Wyszukaj zespołu do usunięcia (ID): </label>
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
                $db, "SELECT * FROM zespoly WHERE id_zespolu = $input_search");
                $query_search_all = mysqli_query($db, "SELECT * FROM zespoly");


                if(empty($input_search)){
                    echo "<table>";
                    echo "<tr>";
                    echo 
                        "<th>"."id_zespolu"."</th>".
                        "<th>"."id_projektu"."</th>".
                        "<th>"."nazwa zespołu"."</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($query_search_all)){
                        echo "<tr>";
                        echo
                            "<td>".$row['id_zespolu']."</td>".
                            "<td>".$row['id_projektu']."</td>".
                            "<td>".$row['nazwa_zespolu']."</td>";
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
                        "<th>"."id_zespolu"."</th>".
                        "<th>"."id_projektu"."</th>".
                        "<th>"."nazwa zespołu"."</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($query_search)){
                        echo "<tr>";
                        echo
                            "<td>".$row['id_zespolu']."</td>".
                            "<td>".$row['id_projektu']."</td>".
                            "<td>".$row['nazwa_zespolu']."</td>";
                        echo "</tr>";
                    }   
                    echo "</table>";

                    echo "
                    <div class='action-form'>
                        <label>Podaj ID zespolu do usunięcia: </label>
                        <input type='number' name='input_del' min='0'>
                        <input type='submit' name='del' value='usuń'>
                    </div>              
                    ";
                }
                
                    if(isset($_POST['del'])){
                        $id_input = $_POST['input_del'];
        
                        $query_delete = mysqli_query($db,
                        "DELETE FROM zespoly WHERE id_zespolu = $id_input");
                        
                        if(mysqli_affected_rows($db) > 0){
                            echo "<h3 class='ok'>Pomyślnie usunięto zespół z bazy danych!</h3>";
                        } else {
                            echo "<h3>Błąd w usunięciu zespołu z bazy.</h3>";
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
                        <label>Wyszukaj zespół do modyfikacji (ID): </label>
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
                    "SELECT * FROM zespoly WHERE id_zespolu = $input_search");
                    $query_search_all = mysqli_query($db, "SELECT * FROM zespoly");

                    if(empty($input_search)){
                        echo "<h3 class='wrong'>Musisz podać ID!</h3>";
                    } else if (mysqli_num_rows($query_search) == 0){
                        echo "<p>Nie ma takiego pracownika w bazie!</p>";
                    } else {
                    echo "<table class='mod-table'>";
                    echo "<tr>";
                    echo 
                        "<th>"."id_zespolu"."</th>".
                        "<th>"."id_projektu"."</th>".
                        "<th>"."nazwa zespołu"."</th>";
                    echo "</tr>";
                    $arr = array();
                    while($row = mysqli_fetch_array($query_search)){
                        echo "<tr>";
                        echo
                            "<td>".$row['id_zespolu']."</td>".
                            "<td>".$row['id_projektu']."</td>".
                            "<td>".$row['nazwa_zespolu']."</td>";
                            $arr = $row;
                        echo "</tr>";
                    }   
                    echo "</table>";

                    echo "
                    <div class='modify-box'>
                        <label>id_projektu: </label>
                        <input type='number' name='id_projektu' value='".$arr['id_projektu']."' min='0' required>

                        <label>nazwa zespołu: </label>
                        <input type='text' name='nazwa_zespolu' value='".$arr['nazwa_zespolu']."' required>

                        <input type='submit' name='mod' value='modyfikuj'>
                    </div>
                    ";
                    };

                    if(isset($_POST['mod'])){
                        $id_projektu = $_POST['id_projektu'];
                        $nazwa_zespolu = $_POST['nazwa_zespolu'];
        
                        $id = $_POST['input_search_mod'];
        
                        $query_mod = mysqli_query($db,
                        "UPDATE zespoly SET 
                        id_projektu = '$id_projektu', 
                        nazwa_zespolu = '$nazwa_zespolu'
                        WHERE id_zespolu = $id");
    
    
                        if(mysqli_affected_rows($db) > 0){
                            echo "<h3 class='ok'>Pomyślnie zmodyfikowano informacje o zespole.</h3>";
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