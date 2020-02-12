<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['id_lekarza'] = $_POST['id_lekarza'];
        $_SESSION['haslo'] = $_POST['haslo'];
    }
    $id_lekarza = $_SESSION['id_lekarza'];
    $haslo = $_SESSION['haslo'];

    if($id_lekarza == '123456' && $haslo == 'andrzej')
        header("Location:admin.php");
    else
        {
            echo '<script language="javascript">';
            echo 'alert("Nie masz uprawnień administatora."); window.location="index.php";';
            echo '</script>';
        }

    pg_close($db); 
?>

