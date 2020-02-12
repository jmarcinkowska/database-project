<?php
  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    $_SESSION['pesel'] = $_POST['pesel'];
    $_SESSION['nazwa'] = $_POST['nazwa'];
    $_SESSION['nazwa_lekarstwa'] = $_POST['nazwa_lekarstwa'];
    $_SESSION['id_choroby'] = $_POST['id_choroby'];
    $_SESSION['opis'] = $_POST['opis'];
    $_SESSION['id_lekarstwa'] = $_POST['id_lekarstwa'];
    $_SESSION['nazwa_lekarstwa'] = $_POST['nazwa_lekarstwa'];
    $_SESSION['dawka'] = $_POST['dawka'];
    $_SESSION['data_wizyty'] = $_POST['data_wizyty'];
    $_SESSION['godzina_wizyty'] = $_POST['godzina_wizyty'];
    $_SESSION['id_wizyty'] = $_POST['id_wizyty'];
}

$pesel = $_SESSION['pesel'];
$nazwa = $_SESSION['nazwa'];
$nazwa_lekarstwa = $_SESSION['nazwa_lekarstwa'];
$id_choroby = $_SESSION['id_choroby'];
$opis = $_SESSION['opis'];
$id_lekarstwa = $_SESSION['id_lekarstwa'];
$nazwa_lekarstwa = $_SESSION['nazwa_lekarstwa'];
$dawka = $_SESSION['dawka'];
$data_wizyty = $_SESSION['data_wizyty'];
$godzina_wizyty = $_SESSION['godzina_wizyty'];
$id_wizyty = $_SESSION['id_wizyty'];


include("config.php");

    $zapytanie = "INSERT into projekt.wizyta_choroby(id_choroby, id_wizyty) (SELECT $id_choroby, $id_wizyty where not exists (SELECT id_choroby, id_wizyty from projekt.wizyta_choroby where id_choroby = '$id_choroby' and id_wizyty='$id_wizyty'))";
    $wynik = pg_query($db, $zapytanie);
    if(!$wynik)
    {
      echo "Blad";
    }
    else
    {
      $temp = pg_fetch_all($wynik);
    }

    $zapytanie2 = "INSERT into projekt.choroby_lekarstwa(id_choroby, id_lekarstwa) (SELECT $id_choroby, $id_lekarstwa where not exists (SELECT id_choroby, id_lekarstwa from projekt.choroby_lekarstwa where id_choroby = '$id_choroby' and id_lekarstwa='$id_lekarstwa'))";
    $wynik2 = pg_query($db, $zapytanie2);
    if(!$wynik2)
    {
      echo "Blad 2";
    }
    else
    {
      $temp2 = pg_fetch_all($wynik2);
    }

    $zapytanie3 = "INSERT into projekt.leczenie(opis, id_choroby) values('$opis', $id_choroby)";
    $wynik3 = pg_query($db, $zapytanie3);
    if(!$wynik3)
    {
      echo "Blad 3";
    }
    else
    {
      $temp3 = pg_fetch_all($wynik3);
      echo '<script>alert("Dodano informacje"); window.location="lekarz_wizyty.php";</script>';
    }

  pg_close();

?>
