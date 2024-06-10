<style>
    <?php 
      require_once("styles.css");
    ?>
</style>
<?php
    require_once('mydbms.php');
    $kategoriak = getKategoria();
    $markak = getMarka();
?>

<form action="addTermek.php" method="POST">
    <label for="nev">Név: </label>
    <input type="text" name="nev" id="nev" />

    <label for="kategoria">Kategória:</label>
    <select id="kategoria" name="kategoria_id">
        <?php foreach($kategoriak as $kategoria): ?>
            <option value="<?php echo $kategoria[0] ?>"><?php echo $kategoria[1] ?></option>
        <?php endforeach; ?>
    </select>

    <label for="marka">Márka:</label>
    <select id="marka" name="marka_id">
        <?php foreach($markak as $marka): ?>
            <option value="<?php echo $marka[0] ?>"><?php echo $marka[1] ?></option>
        <?php endforeach; ?>
    </select>

    <label for="ar">Ár: </label>
    <input type="text" name="ar" id="ar"/>

    <button type="submit">Hozzáad</button>
</form>