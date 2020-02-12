<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['id_lekarza'] = $_POST['id_lekarza'];
        $_SESSION['haslo'] = $_POST['haslo'];
    }
    $id_lekarza = $_SESSION['id_lekarza'];
    $haslo = $_SESSION['haslo'];

    if (strlen($id_lekarza) == 0 || strlen($haslo) == 0 || !is_numeric($id_lekarza)) {
        echo '<script language="javascript">';
        echo 'alert("Wprowadź poprawny login")';
        echo '</script>';
        header('Location: lekarz.php');
        exit();
    } 
    else {
        include('config.php');

        $query = "SELECT * FROM projekt.lekarz WHERE id_lekarza='$id_lekarza' and haslo='$haslo'";
        $result = pg_query($db, $query);
        if(!$result) {
            echo '<script language="javascript">';
            echo 'alert("Wprowadź poprawny login")';
            echo '</script>';
            header('Location: lekarz.php');
        }
        else {
            $tab = pg_fetch_all($result);
            if($tab[0]['id_lekarza'] === null) {
                echo '<script language="javascript">';
                echo 'alert("Lekarz o podanym ID nie istnieje")';
                echo '</script>';
                header('Location: lekarz.php');
                exit();
            }
            $_SESSION['id_lekarza'] = $tab[0]['id_lekarza'];
            $_SESSION['imie'] = $tab[0]['imie'];
            $_SESSION['nazwisko'] = $tab[0]['nazwisko'];
            $_SESSION['specjalizacja'] = $tab[0]['specjalizacja'];
            $_SESSION['miasto'] = $tab[0]['miasto'];
            $_SESSION['telefon'] = $tab[0]['telefon'];
            $_SESSION['haslo'] = $tab[0]['haslo'];
        }

    }
    pg_close($db); 
    header("Location: login_success_lekarz.php");
?>

