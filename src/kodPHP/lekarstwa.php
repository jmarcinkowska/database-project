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
    <title>Lekarstwa</title>
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
</span>
</nav>
    <div class="bg-image"></div>
    <div class="bg-text">
        <h2>Przychodnia lekarska</h2>
        <i class="fa fa-user-md" style="font-size:42px;"></i><h1 style="font-size:50px">Panel lekarza</h1>
    </div>

    <div class="container-fluid" style="margin-top:60px;margin-bottom:60px;color:#34495E;" id="edytuj">
      <div class="row class">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
            <h2>Dodaj lekarstwo</h2>
             <form class="form-group" method="post" action="dodaj_lekarstwo.php">
                <div class="row">
                  <div class="col-md-4"><label>Nazwa lekarstwa: </label></div>
                  <div class="col-md-8"><input type="text" name="nazwa_lekarstwa" class="form-control" required/></div><br/><br/>
                  <div class="col-md-4"><label>Dawka: </label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="dawka" required/></div><br><br>
                 </div>
                <input type="submit" id="inputbtn" name="login_submit" value="Dodaj" class="btn btn-primary"/>

              </form>
            </div>
          </div>
        </div>
         <div class="col-md-4"></div>
      </div>
    </div>

</body>

</html>