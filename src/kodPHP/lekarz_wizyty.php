<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['id_lekarza'] = $_POST['id_lekarza'];;
        $_SESSION['haslo'] = $_POST['haslo'];;
    }
    $id_lekarza = $_SESSION['id_lekarza'];
    $haslo = $_SESSION['haslo'];
    include("config.php");

    $query = "SELECT * from projekt.choroby";
    $result = pg_query($db, $query);
    $temp = pg_fetch_all($result);

    $query2 = "SELECT * from projekt.wizyta_lek('$id_lekarza')";
    $result2 = pg_query($db, $query2);

    $query3 = "SELECT * from projekt.lekarstwa";
    $result3 = pg_query($db, $query3);
    $temp3 = pg_fetch_all($result3);

    $query4 = "SELECT * from projekt.wizyta";
    $result4 = pg_query($db, $query4);
    $temp4 = pg_fetch_all($result4);

    $temp2 = pg_fetch_all($result2);
    if(!$result2)
    {
        echo "Błąd";
        exit;
    }
    $row = pg_fetch_row($result2);
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Panel Lekarza</title>
    <link rel="stylesheet" href="styles/lekarz_wizyty.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
      <input class="form-control mr-sm-2" type="search" placeholder="Znajdź pacjenta" aria-label="Search" name="pesel" value="98745632125">
      <button class="btn btn-sm btn-outline-secondary" type="submit">Znajdź</button>
    </form>

  <span class="form-inline  ml-auto mr-1">
  <a href="wylogowanie.php" id="logout">Wyloguj się</a><i class='fas fa-sign-out-alt' style='font-size:25px;color:white'></i>
    </form>
</nav>
    <div class="bg-image"></div>
    <div class="bg-text">
        <h2>Przychodnia lekarska</h2>
        <i class="fa fa-user-md" style="font-size:42px;"></i><h1 style="font-size:50px">Panel lekarza</h1>
    </div>
    <h2>Nadchodzące wizyty</h2>
    <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <table class="table table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Imię pacjenta</th>
                <th scope="col">Nazwisko pacjenta</th>
                <th scope="col">PESEL</th>
                <th scope="col">Data wizyty</th>
                <th scope="col">Godzina wizyty</th>
                <th scope="col">ID wizyty</th>
            </tr>
        </thead>
        <tbody>
    <?php
    foreach($temp2 as $wyniki)
    {
        echo "<tr>";
        echo "<td>".$wyniki['imie']."</td>";
        echo "<td>".$wyniki['nazwisko']."</td>";
        echo "<td>".$wyniki['pesel']."</td>";
        echo "<td>".$wyniki['data_wizyty']."</td>";
        echo "<td>".$wyniki['godzina']."</td>";
        echo "<td>".$wyniki['id_wizyty']."</td>";
        echo "</tr>";
    }
    ?>
        </tbody>
    </table>
    </div>
    <div class="col-md-2"></div>
</div>
    </div>

<div class="container-fluid" style="margin-top:60px;margin-bottom:60px;color:#34495E;" id="edytuj">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
            <h2>Informacje do wizyty</h2>
             <form class="form-group" method="post" action="lekarz_dodaj_informacje.php">
                <div class="row">
                <div class="col-md-2"><label>Nazwa choroby: </label></div>
                <div class="col-md-10">
                    <select name="id_choroby" class="form-control">
                    <?php
                        foreach($temp as $choroby)
                        {
                            echo '<option value="'.$choroby['id_choroby'].'">'. "Nazwa choroby: ".$choroby['nazwa'].", Objawy: ".$choroby['objawy'].'</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="col-md-2"><label>Nazwa lekarstwa 1: </label></div>
                <div class="col-md-10">
                    <select name="id_lekarstwa" class="form-control">
                    <?php
                        foreach($temp3 as $lek)
                        {
                            echo '<option value="'.$lek['id_lekarstwa'].'">'. "Nazwa lekarstwa: ".$lek['nazwa_lekarstwa'].", Dawka: ".$lek['dawka'].'</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="col-md-2"><label>Nazwa lekarstwa 2: </label></div>
                <div class="col-md-10">
                    <select name="id_lekarstwa" class="form-control">
                    <?php
                        foreach($temp3 as $lek)
                        {
                            echo '<option value="'.$lek['id_lekarstwa'].'">'. "Nazwa lekarstwa: ".$lek['nazwa_lekarstwa'].", Dawka: ".$lek['dawka'].'</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="col-md-2"><label>Opis leczenia: </label></div>
                <div class="col-md-10"><textarea name="opis" rows="2" cols="40" class="form-control" required></textarea> </div>

                <div class="col-md-2"><label>ID wizyty: </label></div>
                <div class="col-md-10"><input type="text" name="id_wizyty" class="form-control" required></div>

                </div>
                <input type="submit" id="inputbtn" name="login_submit" value="Dodaj informacje" class="btn btn-primary"/>

              </form>
            </div>
          </div>
        </div>
         <div class="col-md-2"></div>
      </div>
    </div>


    <div class="container-fluid" style="margin-top:60px;margin-bottom:60px;color:#34495E;" id="edytuj">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
            <h2>Odwołaj wizytę</h2>
             <form class="form-group" method="post" action="lekarz_odwolaj_wizyte.php">
                <div class="row">
                <div class="col-md-2"><label>ID wizyty: </label></div>
                <div class="col-md-10"><input type="number" name="id_wizyty" class="form-control" required>
                </div>
                <input type="submit" id="inputbtn" name="login_submit" value="Odwołaj wizytę" class="btn btn-primary"/>

              </form>
            </div>
          </div>
        </div>
         <div class="col-md-2"></div>
      </div>
    </div>
</body>

</html>