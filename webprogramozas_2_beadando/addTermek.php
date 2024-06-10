<?php
    require_once('mydbms.php');
    addTermek($_POST['nev'], $_POST['kategoria_id'], $_POST['marka_id'], $_POST['ar']);
?>