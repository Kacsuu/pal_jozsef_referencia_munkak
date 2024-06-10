<style>
    <?php 
      require_once("termekek.css");
    ?>
</style>
<?php
    require_once('mydbms.php');
    if(isset($_GET['kereses'])&&!empty('kereses')){
        $termekek = getTermekekKeresve($_GET['kereses']);
    }else{
        $termekek = getTermekek();
    }
    
?>
<div class="import_export">
    <form action="termekFromCSV.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="csvInput" accept=".csv"/>
        <button type="submit">Termék feltöltése</button>
    </form>
    <form action="kimentes.php" method="POST" enctype="multipart/form-data">
        <button type="submit">Termékek mentése</button>
    </form>

<form method="POST" action="kereses.php">
  <input type="text" name="kereses" placeholder="Keresés névre">
  <button type="submit">Keresés</button>
</form>

</div>
<?php foreach($termekek as $termek): ?>
<table>
    <tr>
    <td class="bal">
    <div>Kategória: <?php echo $termek[6]; ?> </div>
    <div>Márka: <?php echo $termek[8]; ?> </div>
    <div>Név: <?php echo $termek[1]; ?> </div>
    <div> <?php echo $termek[4]; ?> Ft </div>
    </td>

    <td class = "jobb">
    <?php if($_SESSION['jog'] == "admin"): ?>
        <form action="deleteTermek.php" method="POST">
            <input type="hidden" name="termek_id" value="<?php echo $termek[0] ?>"/>
            <button type="submit">Törlés</button>
        </form>
        <a href="index.php?page=8&id=<?php echo $termek[0] ?>"><button>Szerkesztés</button></a>
    <?php endif; ?>

    <?php if($_SESSION['jog'] == "user"): ?>
        <form action="megrendel.php" method="POST">
            <input type="hidden" name="termek_id" value="<?php echo $termek[0] ?>"/>
            <button type="submit">Megrendel</button>
        </form>
    <?php endif; ?>
    </td>
    </tr>

<?php endforeach; ?>