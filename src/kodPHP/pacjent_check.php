<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['login'] = $_POST['login'];;
        $_SESSION['haslo'] = $_POST['haslo'];;
    }
    $login = $_SESSION['login'];
    $haslo = $_SESSION['haslo'];

    if (strlen($login) == 0) {
        echo '<script language="javascript">';
        echo 'alert("Wprowadź poprawny login")';
        echo '</script>';
        header('Location: pacjent.php');
        exit();
    } 
    else {
        include('config.php');

        $sql1 = "SELECT * FROM projekt.pacjent_check('$login', '$haslo')";
        $wynik1 = pg_query($db, $sql1);
        if(!$wynik1) {
            echo '<script language="javascript">';
            echo 'alert("Wprowadź poprawny login")';
            echo '</script>';
            header('Location: pacjent.php');
        }
        else {
            $tab = pg_fetch_all($wynik1);
            if($tab[0]['id_pacjenta'] === null) {
                echo '<script language="javascript">';
                echo 'alert("Nie ma pacjenta o podanym loginie w bazie")';
                echo '</script>';
                header('Location: pacjent.php');
                exit();
            }
            $_SESSION['id_pacjenta'] = $tab[0]['id_pacjenta'];
            $_SESSION['imie'] = $tab[0]['imie'];
            $_SESSION['nazwisko'] = $tab[0]['nazwisko'];
            $_SESSION['pesel'] = $tab[0]['pesel'];
            $_SESSION['data_urodzenia'] = $tab[0]['data_urodzenia'];
            $_SESSION['adres'] = $tab[0]['adres'];
        }
    }
    pg_close($db); 
    header("Location: login_success.php");
?>

