<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['haslo'] = $_POST['haslo'];
    }
    $login = $_SESSION['login'];
    $haslo = $_SESSION['haslo'];
    $id_pacjenta = $_SESSION['id_pacjenta'];

    include("config.php");

    $zapytanie = "SELECT * from projekt.pacjent where login='$login' and haslo='$haslo'";
    $wynik = pg_query($db, $zapytanie);

    $zapytanie2 = " SELECT * from projekt.pacjent_i('$id_pacjenta')";

    $wynik2 = pg_query($db, $zapytanie2);
    $temp2 = pg_fetch_all($wynik2);


    $temp = pg_fetch_all($wynik);
    $_SESSION['id_pacjenta'] = $temp[0]['id_pacjenta'];
    $_SESSION['imie'] = $temp[0]['imie'];
    $_SESSION['nazwisko'] = $temp[0]['nazwisko'];
    $_SESSION['pesel'] = $temp[0]['pesel'];
    $_SESSION['data_urodzenia'] = $temp[0]['data_urodzenia'];

    $zapytanie3 = "SELECT * from projekt.specjalizacja_lekarz";
    $wynik3 = pg_query($db, $zapytanie3);
    if(!$wynik2)
    {
        exit();
    }
    else
    {
        $lek = pg_fetch_all($wynik3);
    }
    $zapytanie7 = "SELECT * from projekt.pacjent_wizyty where id_pacjenta='$id_pacjenta' and data_wizyty >= NOW()";
    $wynik4 = pg_query($db, $zapytanie7);
    if($wynik4)
    {
        $wiz = pg_fetch_all($wynik4);
    }

    $zapytanie8 = "SELECT count(*) from projekt.wizyta where data_wizyty > NOW() and id_pacjenta = '$id_pacjenta'";
    $wynik5 = pg_query($db, $zapytanie8);
    $data = pg_fetch_object($wynik5, 0);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Panel Pacjenta</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/pacjent.css">
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <i class="fa fa-heartbeat" style="font-size:30px;color:white;"></i><a class="navbar-brand" href="index.php">Przychodnia lekarska</a>

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#edytuj">Edytuj dane</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#umow">Umów wizytę</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#wczesniejsze">Wcześniejsze wizyty</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#nadchodzace">Nadchodzące wizyty</a>
    </li>
  </ul>

  <span class="form-inline  ml-auto mr-1">
  <a href="wylogowanie.php" id="logout">Wyloguj się</a><i class='fas fa-sign-out-alt' style='font-size:25px;color:white'></i>
    </form>
</nav>
    <div class="bg-image"></div>
    <div class="bg-text">
        <h2>Przychodnia lekarska</h2>
        <i class='fas fa-users' style='font-size:36px'></i><h1 style="font-size:50px">Panel pacjenta</h1>
    </div>
    <h2 id="nadchodzace">Nadchodzące wizyty</h2>
        <?php
            echo "<h3>Ilość nadchodzących wizyt: ". $data->count . "</h3>";
        ?>
    <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
    <table class="table table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Data wizyty</th>
                <th scope="col">Godzina</th>
                <th scope="col">Imię lekarza</th>
                <th scope="col">Nazwisko lekarza</th>
                <th scope="col">Specjalizacja</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach($wiz as $wizyta)
            {
                echo "<tr>";
                echo "<td>".$wizyta['data_wizyty']."</td>";
                echo "<td>".$wizyta['godzina']."</td>";
                echo "<td>".$wizyta['imie']."</td>";
                echo "<td>".$wizyta['nazwisko']."</td>";
                echo "<td>".$wizyta['specjalizacja']."</td>";
        
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
    <div class="col-md-1"></div>
    </div>

    <h2 id="wczesniejsze">Wcześniejsze wizyty</h2>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
<table class="table table-hover table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Nazwa choroby</th>
            <th scope="col">Objawy</th>
            <th scope="col">Imię lekarza</th>
            <th scope="col">Nazwisko lekarza</th>
            <th scope="col">Specjalizacja</th>
            <th scope="col">Nazwa lekarstwa</th>
            <th scope="col">Dawka</th>
            <th scope="col">Opis</th>
            <th scope="col">Data wizyty</th>
        </tr>
    </thead>
    <tbody>
        <?php
          foreach($temp2 as $wyniki)
          {
            echo "<tr>";
            echo "<td>".$wyniki['nazwa']."</td>";
            echo "<td>".$wyniki['objawy']."</td>";
            echo "<td>".$wyniki['imie']."</td>";
            echo "<td>".$wyniki['nazwisko']."</td>";
            echo "<td>".$wyniki['specjalizacja']."</td>";
            echo "<td>".$wyniki['nazwa_lekarstwa']."</td>";
            echo "<td>".$wyniki['dawka']."</td>";
            echo "<td>".$wyniki['opis']."</td>";
            echo "<td>".$wyniki['data_wizyty']."</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
    </div>
    <div class="col-md-1"></div>
</div>

    <div class="container-fluid" style="margin-top:60px;margin-bottom:60px;color:#34495E;" id="edytuj">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
            <h2>Edytuj dane</h2>
             <form class="form-group" method="post" action="edytuj_dane.php">
                <div class="row">
                  <div class="col-md-4"><label>Imię: </label></div>
                  <div class="col-md-8"><input type="text" name="imie" class="form-control" value="<?php echo $_SESSION['imie']; ?>" /></div><br/><br/>
                  <div class="col-md-4"><label>Nazwisko: </label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="nazwisko" value="<?php echo $_SESSION['nazwisko']; ?>"/></div><br><br>
                  <div class="col-md-4"><label>PESEL: </label></div>
                  <div class="col-md-8"><input type="text" name="pesel" class="form-control" value="<?php echo $_SESSION['pesel']; ?>" /></div><br/><br/>
                  <div class="col-md-4"><label>Data urodzenia: </label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="data_urodzenia" value="<?php echo $_SESSION['data_urodzenia']; ?>"/></div><br><br>
                  <div class="col-md-4"><label>Adres: </label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="adres" value="<?php echo $_SESSION['adres']; ?>"/></div><br><br>
                  <div class="col-md-4"><label>Login: </label></div>
                  <div class="col-md-8"><input type="text" name="login" class="form-control" value="<?php echo $_SESSION['login']; ?>" /></div><br/><br/>
                  <div class="col-md-4"><label>Hasło: </label></div>
                  <div class="col-md-8"><input type="password" class="form-control" name="haslo" value="<?php echo $_SESSION['haslo']; ?>"/></div><br><br>
                </div>
                <input type="submit" id="inputbtn" name="login_submit" value="Edytuj dane" class="btn btn-primary"/>

              </form>
            </div>
          </div>
        </div>
         <div class="col-md-4"></div>
      </div>
    </div>
    <div class="container-fluid" style="margin-top:60px;margin-bottom:60px;color:#34495E;" id="umow">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h2>Umów wizytę</h2><br>
              <form class="form-group" method="post" action="umow_wizyte.php">
                <div class="row">
                  <div class="col-md-4"><label>Data wizyty: </label></div>
                  <div class="col-md-8"><input type="date" name="data_wizyty" class="form-control" placeholder="wprowadź login" required value="login"/></div><br/><br/>
                  <div class="col-md-4"><label>Godzina wizyty: </label></div>
                  <div class="col-md-8"><input type="time" class="form-control" name="godzina_wizyty" placeholder="wprowadź hasło" required value="haslo"/></div><br><br>
                  <div class="col-md-4"><label>Lekarz: </label></div>
                  <div class="col-md-8">
                    <select name="id_lekarza" class="form-control">
                    <?php
                        foreach($lek as $lekarz)
                        {
                            echo '<option value="'.$lekarz['id_lekarza'].'">'.$lekarz['imie_nazwisko'].' '.$lekarz['specjalizacja'].'</option>';
                        }
                    ?>
                    </select>
</div><br><br>
                </div>
                <input type="submit" id="inputbtn" name="login_submit" value="Umów wizytę" class="btn btn-primary"/>
              </form>
            </div>
          </div>
        </div>
    </div>
    </div>

    <br />
    <br />
    <br />
</body>

</html>