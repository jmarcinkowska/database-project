<?php
    session_start();

    $data_wizyty = $_POST['data_wizyty'];
    $godzina_wizyty = $_POST['godzina_wizyty'];
    $id_lekarza = $_POST['id_lekarza'];
    $id_pacjenta = $_SESSION['id_pacjenta'];

    include('config.php');
    $sql = "INSERT into projekt.wizyta (data_wizyty, godzina, id_lekarza, id_pacjenta)(SELECT '$data_wizyty', '$godzina_wizyty', '$id_lekarza', '$id_pacjenta' where not exists(SELECT data_wizyty, godzina, id_lekarza, id_pacjenta from projekt.wizyta where data_wizyty='$data_wizyty' and godzina='$godzina_wizyty' and id_lekarza='$id_lekarza'))";
    $wynik = pg_query($db, $sql);
    $ilosc = pg_affected_rows($wynik);
    if(!$wynik) {
        echo '<script>alert("Nie udało się umówić wizyty."); window.location="login_success.php";</script>';

    }
    else {
        if(!$ilosc)
        {
            echo '<script>alert("Podany termin wizyty jest już zajęty"); window.location="login_success.php";</script>';
        }
        else
        echo '<script>alert("Umówiono wizytę."); window.location="login_success.php";</script>';
    }

?>