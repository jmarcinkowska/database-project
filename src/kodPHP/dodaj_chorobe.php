<?php

    session_start();
    include("config.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $_SESSION['nazwa'] = $_POST['nazwa'];
        $_SESSION['objawy'] = $_POST['objawy'];
    }

    $nazwa = $_SESSION['nazwa'];
    $objawy = $_SESSION['objawy'];

    $zapytanie = "INSERT into projekt.choroby(nazwa, objawy) (SELECT '$nazwa', '$objawy' where not exists (SELECT nazwa, objawy from projekt.choroby where nazwa = '$nazwa' and objawy='$objawy'))";
    $wynik = pg_query($db, $zapytanie);
    $ilosc = pg_affected_rows($wynik);
    
    if(!$wynik)
    {
        echo '<script>alert("Dodawanie choroby nie powiodło się"); window.location="admin.php";</script>';
    }
    else
    {
        if(!$ilosc)
        echo '<script>alert("Podana choroba już istnieje"); window.location="admin.php";</script>';
        else
        echo '<script>alert("Pomyślnie dodano chorobę"); window.location="admin.php";</script>';

        $temp = pg_fetch_all($wynik);
    }
    pg_close($db);

?>