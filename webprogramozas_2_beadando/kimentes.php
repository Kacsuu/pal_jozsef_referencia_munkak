<style>
    <?php 
      require_once("styles.css");
    ?>
</style>
<?php
    $connection = mysqli_connect('localhost', 'root', '', 'alkatresz_webshop', 3306);
    $query = "SELECT * FROM termekek";
    $eredmeny = mysqli_query($connection, $query) or die("Hiba a lekérdezésben: $query");
    $termekek = mysqli_fetch_all($eredmeny);
    mysqli_close($connection);

    $fajl = fopen("termekek2.csv", "w");
    foreach($termekek as $termek) {
        $id = $termek[0];
        $nev = $termek[1];
        $kategoria_id = $termek[2];
        $marka_id = $termek[3];
        $ar = $termek[4];
        fwrite($fajl, "$id;$nev;$kategoria_id;$marka_id;$ar\n");
    }
    fclose($fajl);
    echo "Az adatok kimentése sikeresen megtörtént!";
?>