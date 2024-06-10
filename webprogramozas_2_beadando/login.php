<?php
    $email = $_POST['email'];
    $jelszo = md5($_POST['jelszo']);

    require_once('mydbms.php');
    login($email, $jelszo);
?>