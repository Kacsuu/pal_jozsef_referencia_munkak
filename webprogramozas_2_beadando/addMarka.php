<?php
    if(isset($_POST['nev']) && !empty($_POST['nev'])) {
        require_once('mydbms.php');
        addMarka($_POST['nev']);
    }
    else {
        header("Location: index.php?page=6");
    }
?>