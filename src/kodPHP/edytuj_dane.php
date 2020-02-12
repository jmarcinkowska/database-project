<?php
    session_start();
    include('config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $imie = test_input($_POST['imie']);
        $nazwisko = test_input($_POST['nazwisko']);
        $pesel = test_input($_POST['pesel']);
        $data_urodzenia = $_POST['data_urodzenia'];
        $login = $_POST['login'];
        $haslo = test_input($_POST['haslo']);
        $adres = $_POST['adres'];

        $_SESSION['imie'] = $_POST['imie'];
        $_SESSION['nazwisko'] = $_POST['nazwisko'];
        $_SESSION['pesel'] = $_POST['pesel'];
        $_SESSION['data_urodzenia'] = $_POST['data_urodzenia'];
        $_SESSION['adres'] = $_POST['adres'];
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['haslo'] = $_POST['haslo'];
    }
    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $id_pacjenta = $_SESSION['id_pacjenta'];
    $zapytanie = "UPDATE projekt.pacjent SET imie='$imie', nazwisko='$nazwisko', pesel='$pesel', data_urodzenia='$data_urodzenia', adres='$adres', login='$login', haslo='$haslo' WHERE id_pacjenta=$id_pacjenta";
    $wynik = pg_query($db, $zapytanie);
    if(!$wynik)
    {
      echo '<script>alert("Nie udało się zmienić danych"); window.location="login_succes.php";</script>';
    }
    else
    {
      $temp = pg_fetch_all($wynik);
      echo '<script>alert("Zmieniono dane"); window.location="login_success.php";</script>';

    }

?>
