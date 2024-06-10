<?php
    require_once('mydbms.php');
    deleteFelhasznalo($_POST['felhasznalo_id']);
    require_once('logout.php');
?>