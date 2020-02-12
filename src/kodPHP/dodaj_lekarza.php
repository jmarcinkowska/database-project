<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $_SESSION['id_lekarza'] = $_POST['id_lekarza'];
        $_SESSION['imie'] = $_POST['imie'];
        $_SESSION['nazwisko'] = $_POST['nazwisko'];
        $_SESSION['specjalizacja'] = $_POST['specjalizacja'];
        $_SESSION['miasto'] = $_POST['miasto'];
        $_SESSION['telefon'] = $_POST['telefon'];
        $_SESSION['haslo'] = $_POST['haslo'];
    }

    $id_lekarza = $_SESSION['id_lekarza'];
    $imie = $_SESSION['imie'];
    $nazwisko = $_SESSION['nazwisko'];
    $specjalizacja = $_SESSION['specjalizacja'];
    $miasto = $_SESSION['miasto'];
    $telefon = $_SESSION['telefon'];
    $haslo = $_SESSION['haslo'];

    include("config.php");

    $zapytanie = "INSERT into projekt.lekarz(id_lekarza, imie, nazwisko, specjalizacja, miasto, telefon, haslo) values
    ('$id_lekarza', '$imie', '$nazwisko', '$specjalizacja', '$miasto', '$telefon', '$haslo')";

    $wynik = pg_query($db, $zapytanie);
    if($wynik)
    {
        $temp = pg_fetch_all($wynik);
        echo '<script>alert("Pomyślnie dodano lekarza"); window.location="admin.php";</script>';

    }
    else
    {
        echo '<script>alert("Nie udało się dodać lekarza. Sprawdź czy lekarz o podanym ID już nie istnieje"); window.location="admin.php";</script>';
    }

    pg_close($db);
?>
