<style>
    <?php 
      require_once("styles.css");
    ?>
</style>
<?php
    require_once('mydbms.php');
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $marka = getMarka1($_GET['id']);
    }
    else {
        die("Hiba!");
    }
?>

<form action="updateMarka.php" method="POST">
    
    <input type="hidden" name="marka_id" value="<?php echo $_GET['id'] ?>"/>
    <label for="nev">Márka: </label>
    <input type="text" name="nev" id="nev" value="<?php echo $marka[1] ?>"/>

    <button type="submit">Módosít</button>
</form>