<style>
    <?php 
      require_once("styles.css");
    ?>
</style>
<?php
    require_once('mydbms.php');
    $felhasznalo = getFelhasznalo($_SESSION['id']);
?>
    <img src="<?php echo $felhasznalo[7]?>" style = "width: 500px">
    <div> <?php echo $felhasznalo[1]; ?> </div>
    
        <form action="deleteFelhasznalo.php" method="POST">
            <input type="hidden" name="felhasznalo_id" value="<?php echo $felhasznalo[0] ?>"/>
            <button type="submit">Törlés</button>
        </form>
        <a href="index.php?page=14&id=<?php echo $felhasznalo[0] ?>"><button>Szerkesztés</button></a>