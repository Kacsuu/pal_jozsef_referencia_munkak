<style>
    <?php 
      require_once("styles.css");
    ?>
</style>
<?php
    require_once('mydbms.php');
    $markak = getMarka();
?>

<?php foreach($markak as $marka): ?>
    <div> <?php echo $marka[1]; ?> </div>

    <?php if($_SESSION['jog'] == "admin"): ?>
        <form action="deleteMarka.php" method="POST">
            <input type="hidden" name="marka_id" value="<?php echo $marka[0] ?>"/>
            <button type="submit">Törlés</button>
        </form>
        <a href="index.php?page=12&id=<?php echo $marka[0] ?>"><button>Szerkesztés</button></a>
    <?php endif; ?>
<?php endforeach; ?>