<style>
    <?php 
      require_once("styles.css");
    ?>
</style>
<?php
    require_once('mydbms.php');

    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $felhasznalo = getFelhasznalo($_GET['id']);
    }
    else {
        die("Hiba!");
    }
?>

<form action="updateFelhasznalo.php" method="POST" enctype=multipart/form-data>
    <input type="hidden" name="felhasznalo_id" value="<?php echo $_GET['id'] ?>"/>

    <label for="nev">Felhasználónév: </label>
    <input type="text" name="nev" id="nev" value="<?php echo $felhasznalo[1] ?>"/>

    <label for="email">Email: </label>
    <input type="text" name="email" id="email" value="<?php echo $felhasznalo[2] ?>"/>

    <label for="teljes_nev">Teljes név: </label>
    <input type="text" name="teljes_nev" id="teljes_nev" value="<?php echo $felhasznalo[4] ?>"/>

    <label for="lakcim">Lakcím: </label>
    <input type="text" name="lakcim" id="lakcim" value="<?php echo $felhasznalo[5] ?>"/>

    <label for="profilkep">Profilkép: </label>
    <input type="file" name="profilkep" id="profilkep" value="<?php echo $felhasznalo[7] ?>"/>

    <button type="submit">Módosít</button>
</form>