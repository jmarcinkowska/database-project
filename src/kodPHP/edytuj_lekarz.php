<?php
    session_start();
    include('config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $imie = test_input($_POST['imie']);
        $nazwisko = test_input($_POST['nazwisko']);
        $miasto = test_input($_POST['miasto']);
        $telefon = $_POST['telefon'];

        $_SESSION['imie'] = $_POST['imie'];
        $_SESSION['nazwisko'] = $_POST['nazwisko'];
        $_SESSION['miasto'] = $_POST['miasto'];
        $_SESSION['telefon'] = $_POST['telefon'];
    }
    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $id_lekarza = $_SESSION['id_lekarza'];
    $zapytanie = "UPDATE projekt.lekarz SET imie='$imie', nazwisko='$nazwisko', miasto='$miasto', telefon='$telefon' WHERE id_lekarza='$id_lekarza'";
    $wynik = pg_query($db, $zapytanie);
    header("Location: login_success_lekarz.php");

?>