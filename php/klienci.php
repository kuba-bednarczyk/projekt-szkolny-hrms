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
    <style>
        table, td{
            margin: 10px;
            padding: 5px;
            border: 2px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <h1>Dodawanie</h1>
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

    <h1>Usuwanie</h1>
    <form method="POST">
        <label for="">Wyszukaj klienta do usunięcia (ID): </label>
        <input type="text" name="input_search">
        <input type="submit" value="szukaj" name="szukaj"><br>
        <?php  
            $db = mysqli_connect("localhost", "root", "", "aplikacja_baza");

            if(isset($_POST['input_search'])){
                $input_search = $_POST['input_search'];
                $query_search = mysqli_query(
                $db, "SELECT * FROM klienci WHERE id_klienta = $input_search");


                if(empty($input_search)){
                    echo "Musisz podać nazwę!";
                } else if (mysqli_num_rows($query_search) == 0){
                    echo "Nie ma takiego klienta w bazie!";
                } else {
                    echo "<table>";
                    echo "<tr>";
                        echo 
                        "<td>"."id_klienta"."</td>".
                        "<td>"."nazwa"."</td>".
                        "<td>"."nr_telefonu"."</td>".
                        "<td>"."email"."</td>".
                        "<td>"."miejscowosc"."</td>".
                        "<td>"."ulica"."</td>".
                        "<td>"."numer"."</td>";
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
                    echo "<table><br>";

                    echo "
                    <label>Podaj ID klienta: </label>
                    <input type='number' name='input_del'>
                    <input type='submit' name='del' value='usuń'>                 
                    ";
                }
            };

            if(isset($_POST['del'])){
                $id_input = $_POST['input_del'];

                $query_delete = mysqli_query($db,
                "DELETE FROM klienci WHERE id_klienta = $id_input");
                
                if(mysqli_affected_rows($db) > 0){
                    echo "Pomyślnie usunięto klienta z bazy danych!";
                } else {
                    echo "Błąd w usunięciu klienta z bazy";
                }
            }
            mysqli_close($db);
        ?>
        <br>
    </form><br>
    
    <h1>Modyfikacja</h1>
    <form method="POST">
        <label>Wyszukaj klienta do modyfikacji danych (ID): </label>
        <input type="text" name="search_mod_input" value="<?php
        if(isset($_POST['search_mod_input']))

        echo $_POST['search_mod_input']; 
        ?>">
        <input type="submit" name="search_mod" value="szukaj"><br>
        <?php
            $db = mysqli_connect("localhost", "root", "", "aplikacja_baza");

            if(isset($_POST['search_mod_input'])){
                $search_mod_input = $_POST['search_mod_input'];
                $query_search_mod = mysqli_query($db,
                "SELECT * FROM klienci WHERE id_klienta = $search_mod_input");

                if(empty($search_mod_input)){
                    echo "Musisz wpisać id klienta!";
                } else if(mysqli_num_rows($query_search_mod) == 0){
                    echo "Nie ma takiego klienta w bazie danych";
                } else{
                    echo "<table>";
                    echo "<tr>";
                        echo 
                        "<td>"."id_klienta"."</td>".
                        "<td>"."nazwa"."</td>".
                        "<td>"."nr_telefonu"."</td>".
                        "<td>"."email"."</td>".
                        "<td>"."miejscowosc"."</td>".
                        "<td>"."ulica"."</td>".
                        "<td>"."numer"."</td>";
                    echo "</tr>";
                    $arr = array();
                    while($row = mysqli_fetch_array($query_search_mod)){
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
                    echo "<table><br>";

                    echo "
                    <label>Nazwa: </label><input type='text' name='mod_name' value='".$arr['nazwa']."'><br>
                    <label>Nr. telefonu: </label><input type='text' name='mod_tel' value='".$arr['nr_telefonu']."'><br>
                    <label>E-mail: </label><input type='text' name='mod_email' value='".$arr['email']."'><br>
                    <label>Miejscowość: </label><input type='text' name='mod_miejsc' value='".$arr['miejscowosc']."'><br>
                    <label>Ulica: </label><input type='text' name='mod_ul' value='".$arr['ulica']."'><br>
                    <label>Numer: </label><input type='text' name='mod_nr' value='".$arr['numer']."'><br>
                    <input type='submit' name='mod' value='modyfikuj'><br>
                    ";
                }

                if(isset($_POST['mod'])){
                    $mod_name = $_POST['mod_name'];
                    $mod_tel = $_POST['mod_tel'];
                    $mod_email = $_POST['mod_email'];
                    $mod_miejsc = $_POST['mod_miejsc'];
                    $mod_ul = $_POST['mod_ul'];
                    $mod_nr = $_POST['mod_nr'];
    
                    $id = $_POST['search_mod_input'];
    
                    $query_mod = mysqli_query($db,
                    "UPDATE klienci SET 
                    nazwa = '$mod_name', 
                    nr_telefonu = '$mod_tel',
                    email = '$mod_email',
                    miejscowosc = '$mod_miejsc',
                    ulica = '$mod_ul',
                    numer = '$mod_nr' WHERE id_klienta = $id ");

                    // $query_mod = mysqli_query($db, 
                    // "UPDATE klienci SET nazwa = $mod_name,  WHERE id_klienta = $id");

                    if(mysqli_affected_rows($db) > 0){
                        echo "Pomyślnie zmodyfikowano informacje o kliencie";
                    } else {
                        echo "Błąd przy modyfikacji".mysqli_error($db);
                    }
                }
            }

        ?>
    </form>



<a href="./panel.php">Powrót</a><br>
<a href="./wyloguj.php">Wyloguj się</a>
</body>
</html>