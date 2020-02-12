<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $_SESSION['dzien'] = $_POST['dzien'];
        $_SESSION['godzina_start'] = $_POST['godzina_start'];
        $_SESSION['godzina_koniec'] = $_POST['godzina_koniec'];
        $_SESSION['numer'] = $_POST['numer'];
        $_SESSION['pietro'] = $_POST['pietro'];
        $_SESSION['id_lekarza'] = $_POST['id_lekarza'];
    }

    $dzien = $_SESSION['dzien'];
    $godzina_start = $_SESSION['godzina_start'];
    $godzina_koniec = $_SESSION['godzina_koniec'];
    $numer = $_SESSION['numer'];
    $pietro = $_SESSION['pietro'];
    $id_lekarza = $_SESSION['id_lekarza'];

    include("config.php");

    $zapytanie = "INSERT into projekt.dyzur(id_lekarza, dzien, godzina_start, godzina_koniec) values
    ('$id_lekarza', '$dzien', '$godzina_start', '$godzina_koniec')";

    $wynik = pg_query($db, $zapytanie);
    if($wynik)
    {
        $temp = pg_fetch_all($wynik);
    }
    else
    {
        echo '<script>alert("Nie udało się dodać dyżuru"); window.location="admin.php";</script>';
    }

    $zapytanie2 = "SELECT * from projekt.dyzur where id_lekarza='$id_lekarza' and dzien='$dzien' and godzina_start='$godzina_start' and godzina_koniec='$godzina_koniec'";
    $wynik2 = pg_query($db, $zapytanie2);

    $temp2 = pg_fetch_all($wynik2);


    $id_dyzuru = $temp2[0]['id_dyzuru'];

    $zapytanie3 = "INSERT into projekt.gabinet(numer, pietro, id_dyzuru) values($numer, $pietro, $id_dyzuru)";
    $wynik3 = pg_query($db, $zapytanie3);
    if($wynik3)
    {
        $temp3 = pg_fetch_all($wynik3);
        echo '<script>alert("Pomyślnie dodano dyżur"); window.location="admin.php";</script>';

    }
    else
    {
        echo '<script>alert("Nie udało się dodać dyżuru"); window.location="admin.php";</script>';
    }

    pg_close($db);
?>
