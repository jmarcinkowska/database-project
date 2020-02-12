<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pacjent - logowanie</title>
    <link rel="stylesheet" href="styles/style_pacjent.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
  <a href="index.php" class="head"><h1><i class="fa fa-heartbeat" style="font-size:36px;"></i> Przychodnia lekarska</h1></a>
    <div class="container-fluid" style="margin-top:60px;margin-bottom:60px;color:#34495E;">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="card">
            <img src="images/pills.jpg" class="card-img-top">
            <div class="card-body">
              <center>
              <h5>Panel pacjenta rejestracja</h5><br>
              <form class="form-group" method="post" action="pacjent_rejestracja.php">
                <div class="row">
                  <div class="col-md-4"><label>Imię: </label></div>
                  <div class="col-md-8"><input type="text" name="imie" class="form-control" placeholder="wprowadź imię" required/></div><br/><br/>
                  <div class="col-md-4"><label>Nazwisko: </label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="nazwisko" placeholder="wprowadź nazwisko" required/></div><br><br>
                  <div class="col-md-4"><label>PESEL: </label></div>
                  <div class="col-md-8"><input type="text" name="pesel" class="form-control" placeholder="wprowadź PESEL" required/></div><br/><br/>
                  <div class="col-md-4"><label>Data urodzenia: </label></div>
                  <div class="col-md-8"><input type="date" class="form-control" name="data_urodzenia" required/></div><br><br>
                  <div class="col-md-4"><label>Adres: </label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="adres" placeholder="wprowadź adres np. Ul.Długa 12, Kraków" required/></div><br><br>
                  <div class="col-md-4"><label>Login: </label></div>
                  <div class="col-md-8"><input type="text" name="login" class="form-control" placeholder="wprowadź login" required/></div><br/><br/>
                  <div class="col-md-4"><label>Hasło: </label></div>
                  <div class="col-md-8"><input type="password" class="form-control" name="haslo" placeholder="wprowadź haslo" required/></div><br><br>

                </div>
                <center><input type="submit" id="inputbtn" name="login_submit" value="Zarejestruj się" class="btn btn-primary"></center>
              </form>
            </center>
            </div>
          </div>
        </div>
         <div class="col-md-4"></div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>