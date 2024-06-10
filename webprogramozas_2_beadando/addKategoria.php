<?php
    if(isset($_POST['nev']) && !empty($_POST['nev'])) {
        require_once('mydbms.php');
        addKategoria($_POST['nev']);
    }
    else {
        header("Location: index.php?page=5");
    }
?>