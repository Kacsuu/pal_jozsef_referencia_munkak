<style>
    <?php 
      require_once("styles.css");
    ?>
</style>
<?php
    require_once('mydbms.php');
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $kategoria = getKategoria1($_GET['id']);
    }
    else {
        die("Hiba!");
    }
?>

<form action="updateKategoria.php" method="POST">

    <input type="hidden" name="kategoria_id" value="<?php echo $_GET['id'] ?>"/>
    <label for="nev">Kategória: </label>
    <input type="text" name="nev" id="nev" value="<?php echo $kategoria[1] ?>"/>

    <button type="submit">Módosít</button>
</form>