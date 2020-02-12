<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['id_lekarza'] = $_POST['id_lekarza'];;
        $_SESSION['haslo'] = $_POST['haslo'];;
    }
    $id_lekarza = $_SESSION['id_lekarza'];
    $haslo = $_SESSION['haslo'];
    include("config.php");

    $zapytanie = "SELECT * from projekt.lekarz_dyzury where id_lekarza='$id_lekarza'";

    $result1 = pg_query($db, $zapytanie);
    $temp1 = pg_fetch_all($result1);

    $_SESSION['id_lekarza'] = $temp1[0]['id_lekarza'];
    $_SESSION['imie'] = $temp1[0]['imie'];
    $_SESSION['nazwisko'] = $temp1[0]['nazwisko'];
    $_SESSION['specjalizacja'] = $temp1[0]['specjalizacja'];
    $_SESSION['dzien'] = $temp1[0]['dzien'];
    $_SESSION['godzina_start'] = $temp1[0]['godzina_start'];
    $_SESSION['godzina_koniec'] = $temp1[0]['godzina_koniec'];
    $_SESSION['numer'] = $temp1[0]['numer'];
    $_SESSION['pietro'] = $temp1[0]['pietro'];

?>

<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="styles/lekarz_wizyty.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel lekarza</title>

</head>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <i class="fa fa-heartbeat" style="font-size:30px;color:white;"></i><a class="navbar-brand" href="index.php">Przychodnia lekarska</a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="login_success_lekarz.php">Panel logowania</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="lekarz_wizyty.php">Wizyty</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="lekarz_dyzur.php">Dyżury</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="lekarstwa.php">Lekarstwa</a>
    </li>
  </ul>
  <form class="form-inline my-2 my-lg-0" action="lekarz_pacjenci.php" method="POST">
      <input class="form-control mr-sm-2" type="search" placeholder="Znajdź pacjenta" aria-label="Search" name="pesel">
      <button class="btn btn-sm btn-outline-secondary" type="submit">Znajdź</button>
    </form>

  <span class="form-inline  ml-auto mr-1">
  <a href="wylogowanie.php" id="logout">Wyloguj się</a><i class='fas fa-sign-out-alt' style='font-size:25px;color:white'></i>
  </span>
</nav>
    <div class="bg-image"></div>
    <div class="bg-text">
        <h2>Przychodnia lekarska</h2>
        <i class="fa fa-user-md" style="font-size:42px;"></i><h1 style="font-size:50px">Panel lekarza</h1>
    </div>


<h2>Informacje o dyżurach</h2>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <table class="table table-hover table-striped">
        <thead class="thead-dark ">
            <tr>
                <th scope="col">Dzień dyżuru</th>
                <th scope="col">Początek </th>
                <th scope="col">Koniec</th>
                <th scope="col">Numer gabinetu</th>
                <th scope="col">Piętro</th>
            </tr>
        </thead>
        <tbody>
    <?php
    foreach($temp1 as $wyniki)
    {
        echo "<tr>";
        echo "<td>".$wyniki['dzien']."</td>";
        echo "<td>".$wyniki['godzina_start']."</td>";
        echo "<td>".$wyniki['godzina_koniec']."</td>";
        echo "<td>".$wyniki['numer']."</td>";
        echo "<td>".$wyniki['pietro']."</td>";
        echo "</tr>";
    }
    ?>
        </tbody>
    </table>
    </div>
    <div class="col-md-2"></div>
</div>
</body>

</html>