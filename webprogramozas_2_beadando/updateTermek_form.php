<style>
    <?php 
      require_once("styles.css");
    ?>
</style>
<?php
    require_once('mydbms.php');
    $kategoriak = getKategoria();
    $markak = getMarka();

    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $termek = getTermek($_GET['id']);
    }
    else {
        die("Hiba!");
    }
?>

<form action="updateTermek.php" method="POST">
    <input type="hidden" name="termek_id" value="<?php echo $_GET['id'] ?>"/>
    <label for="nev">Név: </label>
    <input type="text" name="nev" id="nev" value="<?php echo $termek[1] ?>"/>

    <label for="kategoria">Kategória: </label>
    <select id="kategoria" name="kategoria_id">
        <?php foreach($kategoriak as $kategoria): ?>
            <option value="<?php echo $kategoria[0] ?>" <?php if($kategoria[0] == $termek[2]) echo "selected" ?>><?php echo $kategoria[1] ?></option>
        <?php endforeach; ?>
    </select>
        
    <label for="marka">Márka: </label>
    <select id="marka" name="marka_id">
        <?php foreach($markak as $marka): ?>
            <option value="<?php echo $marka[0] ?>" <?php if($marka[0] == $termek[3]) echo "selected" ?>><?php echo $marka[1] ?></option>
        <?php endforeach; ?>
    </select>

    <label for="ar">Ár: </label>
    <input type="text" name="ar" id="ar" value="<?php echo $termek[4] ?>"/>

    <button type="submit">Módosít</button>
</form>