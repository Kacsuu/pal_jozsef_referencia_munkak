<style>
    <?php 
      require_once("navbar.css");
    ?>
</style>
<nav class="navbar">
    <?php if(!isset($_SESSION['id']) || empty($_SESSION['id'])): ?>
        <a href="index.php?page=1">Bejelentkezés</a>
        <a href="index.php?page=2">Regisztráció</a>
    <?php else: ?>
        <a href="index.php?page=3">Termékek listázása</a>
        <a href="index.php?page=13">Profilom</a>

        <?php if($_SESSION['jog'] == "admin"): ?>
            <a href="index.php?page=4">Termék hozzáadása</a>
            <a href="index.php?page=9">Kategóriák</a>
            <a href="index.php?page=5">Kategória hozzáadása</a>
            <a href="index.php?page=10">Márkák</a>
            <a href="index.php?page=6">Márka hozzáadása</a>
            
        <?php else: ?>
            <a href="index.php?page=15">Vásárlásaim</a>
        <?php endif; ?>
        
        <a href="index.php?page=99">Kijelentkezés</a>
    <?php endif; ?>
</nav>