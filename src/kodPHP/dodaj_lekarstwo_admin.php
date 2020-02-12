<?php

    session_start();
    include("config.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $_SESSION['nazwa_lekarstwa'] = $_POST['nazwa_lekarstwa'];
        $_SESSION['dawka'] = $_POST['dawka'];
    }

    $nazwa_lekarstwa = $_SESSION['nazwa_lekarstwa'];
    $dawka = $_SESSION['dawka'];

    $zapytanie = "SELECT * from projekt.dodaj_lekarstow('$nazwa_lekarstwa','$dawka')";
    $wynik = pg_query($db, $zapytanie);
    if(!$wynik)
    {
        echo '<script>alert("Nie udało się dodać lekarstwa"); window.location="admin.php";</script>';
    }
    else
    {
        $temp = pg_fetch_all($wynik);
        echo '<script>alert("Dodano lekarstwo"); window.location="admin.php";</script>';
    }
    pg_close($db);
?>