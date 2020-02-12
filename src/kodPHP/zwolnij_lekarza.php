<?php
    session_start();

    $flag = true;

    include("config.php");

    $id_lekarza = $_POST['id_lekarza'];
    $sql = "SELECT * FROM projekt.lekarz WHERE id_lekarza=$id_lekarza";

        $sql2 = "SELECT * from projekt.zwolnij_lekarza('$id_lekarza')";
        $wynik2 = pg_query($db, $sql2);
        $ilosc = pg_affected_rows($wynik2);
        if($wynik2) {
            if(!$ilosc)
                echo "<script>alert('Nie udało się zwolnić lekarza. Sprawdź czy lekarza o podanym ID istnieje')</script>";
            else
                echo '<script>alert("Zwolniono lekarza"); window.location="admin.php";</script>';
        }
        else {
            exit();
        }
        pg_close($db);
?>
