<?php
    require_once('mydbms.php');
    updateTermek($_POST['termek_id'],
                 $_POST['nev'], 
                 $_POST['kategoria_id'],
                 $_POST['marka_id'],
                 $_POST['ar']);
?>