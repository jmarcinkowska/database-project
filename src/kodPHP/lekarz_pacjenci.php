<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['pesel'] = $_POST['pesel'];
    }

    $pesel = $_SESSION['pesel'];

    if (strlen($pesel) != 11) {
        header('Location: login_success_lekarz.php');
    } 
    else {
        include('config.php');
        $zapytanie = "SELECT * from projekt.lekarz_wizyty where data_wizyty < NOW() and pesel='$pesel' order by data_wizyty";

        $wynik1 = pg_query($db, $zapytanie);
        if(!$wynik1) {
            header('Location: login_success_lekarz.php');
        }
        else {
            $tab = pg_fetch_all($wynik1);
            if($tab[0]['id_pacjenta'] === null) {
                header('Location: login_success_lekarz.php');
                exit;
            }
            $_SESSION['id_pacjenta'] = $tab[0]['id_pacjenta'];
            $_SESSION['adres'] = $tab[0]['adres'];
            $_SESSION['imie'] = $tab[0]['imie'];
            $_SESSION['nazwisko'] = $tab[0]['nazwisko'];
            $_SESSION['pesel'] = $tab[0]['pesel'];
            $_SESSION['data_urodzenia'] = $tab[0]['data_urodzenia'];
            $_SESSION['nazwa'] = $tab[0]['nazwa'];
            $_SESSION['objawy'] = $tab[0]['objawy'];
            $_SESSION['leczenie'] = $tab[0]['leczenie'];
            $_SESSION['dawka'] = $tab[0]['dawka'];
            $_SESSION['nazwa_lekarstwa'] = $tab[0]['nazwa_lekarstwa'];
            $_SESSION['data_wizyty'] = $tab[0]['data_wizyty'];
            $_SESSION['opis'] = $tab[0]['opis'];
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="lekarz_wizyty.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/lekarz_wizyty.css">
    <title>Panel lekarza</title>
</head>

<body>
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

    <h2>Informacje o pacjencie</h2>

    <div class="info">
    <table class="table" cellpadding="0" cellspacing="0">
        <thead class="thead-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>

    <?php
        echo "<tr>";
        echo "<td> Imię: </td>";
        echo "<td>". $_SESSION['imie']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td> Nazwisko: </td>";
        echo "<td>". $_SESSION['nazwisko']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td> PESEL: </td>";
        echo "<td>". $_SESSION['pesel']."</td>";
        echo "</tr>";
    ?>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <table class="table table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nazwa choroby</th>
                <th scope="col">Objawy</th>
                <th scope="col">Leczenie</th>
                <th scope="col">Dawka</th>
                <th scope="col">Nazwa lekarstwa</th>
                <th scope="col">Data wizyty</th>

            </tr>
        </thead>
        <tbody>

    <?php
    foreach($tab as $wyniki)
    {
        echo "<tr>";
        echo "<td>".$wyniki['nazwa']."</td>";
        echo "<td>".$wyniki['objawy']."</td>";
        echo "<td>".$wyniki['opis']."</td>";
        echo "<td>".$wyniki['dawka']."</td>";
        echo "<td>".$wyniki['nazwa_lekarstwa']."</td>";
        echo "<td>".$wyniki['data_wizyty']."</td>";
        echo "</tr>";
    }
    ?>
        </tbody>
    </table>
    </div>
    <div class="col-md-2"></div>
</div>
    </div>
   
    </div>
</body>

</html>