<style>
    <?php 
      require_once("styles.css");
    ?>
</style>
<?php
    $fajl = fopen($_FILES['csvInput']['tmp_name'], 'r');
    while($sor = fgets($fajl)) {
        $adatok = explode(';', trim($sor));
        $connection = mysqli_connect('localhost', 'root', '', 'alkatresz_webshop', 3306);
        $query = "INSERT INTO termekek (id, nev, kategoria_id, marka_id, ar) VALUES ($adatok[0], '$adatok[1]', $adatok[2], $adatok[3], $adatok[4])";
        mysqli_query($connection, $query) or die("Hiba a lekérdezésben: $query");
        mysqli_close($connection);
    }
    fclose($fajl);
    echo "Az adatok rögzítése sikeresen megtörtént!";
?>