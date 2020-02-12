<?php
    session_start();
    include("config.php");

    $zapytanie = "SELECT * from projekt.lekarz_specjalizacja";
    $wynik = pg_query($db, $zapytanie);
    $temp3 = pg_fetch_all($wynik);

    pg_close($db);
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
    <title>Panel administartora</title>
</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <i class="fa fa-heartbeat" style="font-size:30px;color:white;"></i><a class="navbar-brand" href="index.php">Przychodnia lekarska</a>
  <span class="form-inline  ml-auto mr-1">
  <a href="wylogowanie.php" id="logout">Wyloguj się</a><i class='fas fa-sign-out-alt' style='font-size:25px;color:white'></i>
  </span>
</nav>

<div class="bg-image"></div>
    <div id="admin" class="bg-text">
        <h2>Przychodnia lekarska</h2>
        <i class='fas fa-user-shield' style='font-size:42px'></i><h1 style="font-size:50px">Panel administratora</h1>
    </div>

<div class="container">
    <button onclick="zwolnijLekarza()" type="submit" class="button button--wayra button--border-thick button--text-upper button--size-s">ZWOLNIJ LEKARZA</button>
    <div id="myDIV" style="display:none;">
        <form action="zwolnij_lekarza.php" method="POST">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2"><label>Numer wykonywania zawodu: </label></div>
                <div class="col-md-5"><input type="text" name="id_lekarza" class="form-control" required/>
                </div><br /><br />
                <div class="col-md-3"></div>

                <div class="col-md-4"></div>
                <div class="col-md-5"><button type="submit">Zwolnij</button></div>
                <div class="col-md-3"></div>
            </div>
        </form>
    </div>
</div>
    <div class="container">
    <button onclick="dodajLekarza()" type="submit" class="button button--wayra button--border-thick button--text-upper button--size-s">DODAJ LEKARZA</button>
    <div id="myDIV2" style="display:none;">
        <form action="dodaj_lekarza.php" method="POST">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Numer wykonywania zawodu: </label></div>
                    <div class="col-md-5"><input type="number" name="id_lekarza" class="form-control" required/>
                    </div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Imię: </label></div>
                    <div class="col-md-5"><input type="text" name="imie" class="form-control" required/></div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Nazwisko: </label></div>
                    <div class="col-md-5"><input type="text" name="nazwisko" class="form-control" required/>
                    </div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Specjalizacja: </label></div>
                    <div class="col-md-5"><input type="text" name="specjalizacja" class="form-control" required/></div>
                    <br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Miasto: </label></div>
                    <div class="col-md-5"><input type="text" name="miasto" class="form-control" required/>
                    </div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Telefon: </label></div>
                    <div class="col-md-5"><input type="text" name="telefon" class="form-control" required/></div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Hasło: </label></div>
                    <div class="col-md-5"><input type="password" name="haslo" class="form-control" required/>
                    </div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-4"></div>
                    <div class="col-md-5"><button type="submit">Dodaj lekarza</button></div>
                    <div class="col-md-3"></div>

                </div>
            </div>
        </form>
    </div>
</div>
    <div class="container">
    <button onclick="dodajLekarstwo()" type="submit" class="button button--wayra button--border-thick button--text-upper button--size-s">DODAJ LEKARSTWO</button>
    <div id="myDIV4" style="display:none;">
        <form action="dodaj_lekarstwo_admin.php" method="POST">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-1"><label>Nazwa lekarstwa: </label></div>
                    <div class="col-md-5"><input type="text" name="nazwa_lekarstwa" class="form-control" required/>
                    </div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-1"><label>Dawka: </label></div>
                    <div class="col-md-5"><input type="text" name="dawka" class="form-control" required/></div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-4"></div>
                    <div class="col-md-5"><button type="submit">Dodaj lekarstwo</button></div>
                    <div class="col-md-3"></div>

                </div>
            </div>
        </form>
    </div>
</div>
    <div class="container">
    <button onclick="wyswietlLekarza()" type="submit" class="button button--wayra button--border-thick button--text-upper button--size-s">WYŚWIETL LEKARZY</button>
    <div id="myDIV7" style="display:none;">
        <form action="wyswietl_lekarza.php" method="POST">
            <div class="form-group">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2"><label>Specjalizacja: </label></div>
                <div class="col-md-5">
                    <select name="specjalizacja" class="form-control">
                    <?php
                        foreach($temp3 as $lek)
                        {
                            echo '<option value="'.$lek['specjalizacja'].'">'.$lek['specjalizacja']. '</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="col-md-4" id="myDIV8"></div>
            <div class="col-md-5"><button type="submit" value="Wyświetl" class="button1" onclick="wyswietl()"/>Wyświetl</button></div>
            <div class="col-md-3"></div>
                </div>
        </form>
    </div>
</div>

    <div class="container">
    <button onclick="dodajDyzur()" type="submit" class="button button--wayra button--border-thick button--text-upper button--size-s">DODAJ DYŻUR</button>
    <div id="myDIV5" style="display:none;">
        <form action="dodaj_dyzur.php" method="POST">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Dzień dyżuru: </label></div>
                    <div class="col-md-5"><input type="text" name="dzien" class="form-control" placeholder="np.poniedziałek" required/>
                    </div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Godzina rozpoczęcia: </label></div>
                    <div class="col-md-5"><input type="time" name="godzina_start" class="form-control" required/></div>
                    <br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Godzina zakończenia: </label></div>
                    <div class="col-md-5"><input type="time" name="godzina_koniec" class="form-control" required/>
                    </div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Gabinet: </label></div>
                    <div class="col-md-5"><input type="text" name="numer" class="form-control" required/></div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Piętro: </label></div>
                    <div class="col-md-5"><input type="text" name="pietro" class="form-control" required/>
                    </div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>ID lekarza: </label></div>
                    <div class="col-md-5"><input type="text" name="id_lekarza" class="form-control" required/></div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-4"></div>
                    <div class="col-md-5"><button type="submit">Dodaj dyżur</button></div>
                    <div class="col-md-3"></div>

                </div>
            </div>
        </form>
    </div>
</div>
    <div class="container">
    <button onclick="dodajChorobe()" type="submit" class="button button--wayra button--border-thick button--text-upper button--size-s">DODAJ NOWĄ CHOROBĘ</button>
    <div id="myDIV6" style="display:none;">
        <form action="dodaj_chorobe.php" method="POST">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-1"><label>Nazwa choroby: </label></div>
                    <div class="col-md-5"><input type="text" name="nazwa" class="form-control" required/>
                    </div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-3"></div>
                    <div class="col-md-1"><label>Obajwy: </label></div>
                    <div class="col-md-5"><input type="text" name="objawy" class="form-control" required/></div><br /><br />
                    <div class="col-md-3"></div>

                    <div class="col-md-4"></div>
                    <div class="col-md-5"><button type="submit">Dodaj chorobę</button></div>
                    <div class="col-md-3"></div>

                </div>
            </div>
        </form>
    </div>
</div>
    <script src="admin.js"></script>
</body>

</html>