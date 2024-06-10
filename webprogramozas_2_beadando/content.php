<?php
    if(isset($_GET['page']) && !empty($_GET['page'])) {
        switch($_GET['page']) {
            case 1:
                require_once('login_form.php');
                break;
            case 2:
                require_once('register_form.php');
                break;
            case 3:
                require_once('termekek.php');
                break;
            case 4:
                require_once('addTermek_form.php');
                break;
            case 5:
                require_once('addKategoria_form.php');
                break;
            case 6:
                require_once('addMarka_form.php');
                break;
            case 7:
                require_once('megrendel.php');
                break;
            case 8:
                require_once('updateTermek_form.php');
                break;
            case 9:
                require_once('kategoriak.php');
                break;
            case 10:
                require_once('markak.php');
                break;
            case 11:
                require_once('updateKategoria_form.php');
                break;
            case 12:
                require_once('updateMarka_form.php');
                break;
            case 13:
                require_once('felhasznalok.php');
                break;
            case 14:
                require_once('updateFelhasznalo_form.php');
                break;
            case 15:
                require_once('rendelesek.php');
                break;
            case 99:
                require_once('logout.php');
                break;
        }
    }
    else {
        header("Location: index.php?page=1");
    }
?> 