<style>
    <?php 
      require_once("styles.css");
    ?>
</style>
<?php
    require_once('mydbms.php');
    $rendelesek = getRendelesek($_SESSION['id']);
?>

<?php foreach($rendelesek as $rendeles): ?>
    <div>Rendelés azonosítója: <?php echo $rendeles[0]; ?> </div>
    <div>Termék: <?php echo $rendeles[1]; ?> </div>
    <div>Rendelés ideje: <?php echo $rendeles[3]; ?> </div>

    <form action="deleteRendeles.php" method="POST">
        <input type="hidden" name="rendeles_id" value="<?php echo $rendeles[0] ?>"/>
        <button type="submit">Törlés</button>
    </form>

<?php endforeach; ?>