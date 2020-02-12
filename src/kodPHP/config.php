<?php
    $dbname = "dbname = u7marcinkowska";
    $credentials = "user = u7marcinkowska password = 7marcinkowska";

    $db = pg_connect("$dbname $credentials");
    if(!$db)
    {
        echo "Error: Nie można połączyć z bazą danych\n";
    }

?>