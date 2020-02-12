<?php
    session_start();
    include("config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $imie = test_input($_POST["imie"]);
        $nazwisko = test_input($_POST["nazwisko"]);
        $login = test_input($_POST["login"]);
        $haslo = test_input($_POST["haslo"]);
        $pesel = test_input($_POST["pesel"]);
        $data_urodzenia = test_input($_POST["data_urodzenia"]);
        $adres = test_input($_POST["adres"]);
      }
    
      function test_input($data) 
      {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    
      $zapytanie = "SELECT * from projekt.pacjent_rejestracja('$imie', '$nazwisko', '$login', '$haslo', '$pesel', '$data_urodzenia', '$adres')";
      $query = pg_query($db, $zapytanie);

      if(!$query2)
      {
        echo '<script language="javascript">';
        echo 'alert("Niepoprawny login")';
        echo '</script>';
      }
      if($query)
      {
        if(isset($_SESSION['imie'])) 
        unset($_SESSION['imie']);
        if(isset($_SESSION['nazwisko'])) 
        unset($_SESSION['nazwisko']);
        if(isset($_SESSION['login'])) 
        unset($_SESSION['login']);
        if(isset($_SESSION['haslo'])) 
        unset($_SESSION['haslo']);
        if(isset($_SESSION['pesel'])) 
        unset($_SESSION['pesel']);
        if(isset($_SESSION['data_urodzenia'])) 
        unset($_SESSION['data_urodzenia']);
        if(isset($_SESSION['adres'])) 
        unset($_SESSION['adres']);   
      }
      else
      {
        echo '<script language="javascript">';
        echo 'alert("Nie udało się zarejetrować")';
        echo '</script>';
      }
      pg_close($db);
      header("location: pacjent.php");
?>

