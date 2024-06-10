<style>
    <?php 
      require_once("styles.css");
    ?>
</style>
<?php
    require_once('mydbms.php');
    $kategoriak = getKategoria();
?>

<?php foreach($kategoriak as $kategoria): ?>
    <div> <?php echo $kategoria[1]; ?> </div>

    <?php if($_SESSION['jog'] == "admin"): ?>
        <form action="deleteKategoria.php" method="POST">
            <input type="hidden" name="kategoria_id" value="<?php echo $kategoria[0] ?>"/>
            <button type="submit">Törlés</button>
        </form>
        <a href="index.php?page=11&id=<?php echo $kategoria[0] ?>"><button>Szerkesztés</button></a>
    <?php endif; ?>
<?php endforeach; ?>