<?php
    session_start();
    include("config.php");

    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $_SESSION['specjalizacja'] = $_POST['specjalizacja'];
    }

    $specjalizacja = $_SESSION['specjalizacja'];
    $imie = $_SESSION['imie'];

    $zapytanie = "SELECT * from projekt.wyswietl_lekarzy('$specjalizacja')";
    $wynik = pg_query($db, $zapytanie);
    $tab = pg_fetch_all($wynik);

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <script src="main.js"></script> -->
    <title>Panel administartora</title>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <i class="fa fa-heartbeat" style="font-size:30px;color:white;"></i><a class="navbar-brand" href="index.php">Przychodnia lekarska</a>

</nav>

<div class="bg-image"></div>
    <div id="admin" class="bg-text">
        <h2>Przychodnia lekarska</h2>
        <i class='fas fa-user-shield' style='font-size:42px'></i><h1 style="font-size:50px">Panel administratora</h1>
    </div>

    <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <table class="table table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Imię </th>
                <th scope="col">Nazwisko</th>
                <th scope="col">Specjalizacja</th>
                <th scope="col">Miasto</th>
                <th scope="col">Numer wykonywania zawodu</th>
            </tr>
        </thead>
        <tbody>
    <?php
    foreach($tab as $wyniki)
    {
        echo "<tr>";
        echo "<td>".$wyniki['imie']."</td>";
        echo "<td>".$wyniki['nazwisko']."</td>";
        echo "<td>".$wyniki['specjalizacja']."</td>";
        echo "<td>".$wyniki['miasto']."</td>";
        echo "<td>".$wyniki['id_lekarza']."</td>";
        echo "</tr>";
    }
    ?>
        </tbody>
    </table>
    </div>
    <div class="col-md-2"></div>
</div>
</div>

</body>
</html>