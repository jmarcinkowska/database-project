<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['id_lekarza'] = $_POST['id_lekarza'];
        $_SESSION['haslo'] = $_POST['haslo'];
        $_SESSION['id_wizyty'] = $_POST['id_wizyty'];
    }
    $id_lekarza = $_SESSION['id_lekarza'];
    $haslo = $_SESSION['haslo'];
    $id_wizyty = $_SESSION['id_wizyty'];
    include("config.php");

    $query = "SELECT * from projekt.lekarz where id_lekarza=$id_lekarza and haslo='$haslo';";
    $result = pg_query($db, $query);
    
    $temp = pg_fetch_all($result); 

    $query2 = "DELETE from projekt.wizyta where id_wizyty=$id_wizyty";
    $result2 = pg_query($db, $query2);
    $ilosc = pg_affected_rows($result2);

    if(!$result2)
    {
        echo "Błąd";
        exit();
    }
    else
    {
        if(!$ilosc)
            echo '<script>alert("Brak wizyty o podanym ID."); window.location="lekarz.php";</script>';
        else
            echo '<script>alert("Odwołano wizytę. Zaloguj się ponownie."); window.location="lekarz.php";</script>';
    }
        $temp2 = pg_fetch_all($result2);

    pg_query($db);
?>