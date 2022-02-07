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
    <link rel="stylesheet" href="../css/raporty.css">
    <title>Raporty</title>
</head>
<body>
    <div class="container">
        <div class="nav">
            <p>raporty</p>
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
                <li class="menu__item"><a href="./raporty.php#klienci">klienci</a></li>
                <li class="menu__item"><a href="./raporty.php#projekty">projekty</a></li>
                <li class="menu__item"><a href="./raporty.php#spotkania">spotkania</a></li>
                <li class="menu__item"><a href="./panel.php"><i class="fas fa-arrow-left"></i> powrót</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="report-box clients" id="klienci">
                <h1 >klienci</h1>
                <div class="search-box">
                    <form method="POST">
                        <label>Wyszukaj konkretnego klienta (ID):</label>
                        <input type="number" name="client_input" minlength="1">
                        <input type="submit" value="szukaj" name="client_search">
                    </form>
                </div>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "aplikacja_baza");
                if(isset($_POST['client_search'])){
                    $client_input = $_POST['client_input'];
                    $query_client_search = mysqli_query($conn, "SELECT * FROM klienci WHERE id_klienta = $client_input");
                    
                    if(empty($client_input)){
                        echo "<h3>Musisz podać ID klienta.</h3>";
                    }else if(mysqli_num_rows($query_client_search) == 0){
                        echo "<h3>Nie ma takiego klienta w bazie.</h3>";
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
                        while($row = mysqli_fetch_array($query_client_search)){
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
                    };
                };

                mysqli_close($conn);
            ?>
                <p>wszyscy klienci</p>
            <?php
                $conn = mysqli_connect("localhost", "root", "", "aplikacja_baza");

                $query_all = mysqli_query($conn, "SELECT * FROM klienci");
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
                    while($row = mysqli_fetch_array($query_all)){
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


                mysqli_close($conn);
            ?>
            </div>


            <div class="report-box projects" id="projekty">
                <h1>projekty</h1>
                <div class="search-box">
                    <form method="POST">
                        <label>Wyszukaj konkrety projekt (ID):</label>
                        <input type="number" name="project_input" minlength="1">
                        <input type="submit" value="szukaj" name="project_search">
                    </form>
                </div>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "aplikacja_baza");
                if(isset($_POST['project_search'])){
                    $project_input = $_POST['project_input'];
                    $query_project_search = mysqli_query($conn, "SELECT * FROM projekty WHERE id_projektu = $project_input");
                    
                    if(empty($project_input)){
                        echo "<h3>Musisz podać ID projektu.</h3>";
                    }else if(mysqli_num_rows($query_project_search) == 0){
                        echo "<h3>Nie ma takiego projektu w bazie.</h3>";
                    } else {
                        echo "<table>";
                        echo "<tr>";
                        echo 
                            "<th>"."id_projektu"."</th>".
                            "<th>"."data_rozpoczęcia"."</th>".
                            "<th>"."data_zakończenia"."</th>".
                            "<th>"."opis"."</th>".
                            "<th>"."status"."</th>".
                            "<th>"."id_klienta"."</th>";
                        echo "</tr>";
                        while($row = mysqli_fetch_array($query_project_search)){
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
                    };
                };

                mysqli_close($conn);
            ?>
            <p>wszystkie projekty</p>
            <?php
                $conn = mysqli_connect("localhost", "root", "", "aplikacja_baza");

                $query_all_projects = mysqli_query($conn, "SELECT * FROM projekty");
                    echo "<table>";
                    echo "<tr>";
                    echo 
                        "<th>"."id_projektu"."</th>".
                        "<th>"."data_rozpoczęcia"."</th>".
                        "<th>"."data_zakończenia"."</th>".
                        "<th>"."opis"."</th>".
                        "<th>"."status"."</th>".
                        "<th>"."id_klienta"."</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($query_all_projects)){
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
                
                mysqli_close($conn);
            ?>
            <p>liczba projektów</p>
                <table>
                    <tr>
                        <td>bieżące</td><td>przyszłe</td><td>archiwalne</td>
                    </tr>
            <?php
                $conn = mysqli_connect("localhost", "root", "", "aplikacja_baza");
                
                $query = mysqli_query($conn, "SELECT * FROM projekty");

                $current = 0;
                $arch = 0;
                $future = 0;

                while($row = mysqli_fetch_array($query)){
                    if($row['status'] == "bieżący"){
                        $current+=1;
                    } else if($row['status'] == "przyszły"){
                        $future+=1;
                    } else if($row['status'] == "archiwalny"){
                        $arch+=1;
                    }
                };

                echo "<tr>";
                echo 
                    "<td>".$current."</td>"."<td>".$future."</td>"."<td>".$arch."</td>";
                echo "</tr>";
                 

                mysqli_close($conn);
            ?> 
                </table>
            </div>
            

            <div class="report-box meetings" id="spotkania">
                <h1 >spotkania z klientami</h1>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "aplikacja_baza");

                $query_all_meetings = mysqli_query($conn, "SELECT * FROM spotkania_z_klientami");
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
                    while($row = mysqli_fetch_array($query_all_meetings)){
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
                mysqli_close($conn);
            ?>
            </div> 

        </div>
    </div>
    <script src="../js/menuAnimation.js"></script>
</body>
</html>