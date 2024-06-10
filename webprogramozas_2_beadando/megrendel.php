<?php
    require_once('mydbms.php');
    session_start();
    megrendel($_POST['termek_id'], $_SESSION['id']);
?>