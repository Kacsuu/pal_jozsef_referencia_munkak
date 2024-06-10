<?php
    define('dbHOST', 'localhost');
    define('dbUSERNAME', 'root');
    define('dbPASSWORD', '');
    define('dbDATABASE', 'alkatresz_webshop');
    define('dbPORT', 3306);

    function connect() {
        $connection = mysqli_connect(dbHOST, dbUSERNAME, dbPASSWORD, dbDATABASE, dbPORT);
        if(!$connection) {
            die("Hiba az adatbázis kapcsolat kiépítése során: ".mysqli_connect_error());
        }
        return $connection;
    }

    function add_user($felhasznalonev, $email, $jelszo, $teljes_nev, $lakcim, $jog, $profilkep) {
        $connection = connect();
        $query = "INSERT INTO felhasznalok (felhasznalonev, email, jelszo, teljes_nev, lakcim, jog, profilkep)
                  VALUES ('$felhasznalonev', '$email', '$jelszo', '$teljes_nev', '$lakcim', '$jog', '$profilkep')";
        mysqli_query($connection, $query) or die("Hiba a lekérdezésben: $query");
        mysqli_close($connection);
        header("Location: index.php?page=1&msg=Sikeres+regisztráció!");
    }

    function login($email, $jelszo) {
        $connection = connect();
        $query = "SELECT * FROM felhasznalok WHERE email LIKE '$email' AND jelszo LIKE '$jelszo'";
        $result = mysqli_query($connection, $query) or die("Hiba a lekérdezésben: $query");
        $felhasznalo = mysqli_fetch_row($result);
        if(!$felhasznalo) {
            header("Location: index.php?page=1&msg=Hibás+adatok");
        }
        else {
            session_start();
            $_SESSION['id'] = $felhasznalo[0];
            $_SESSION['nev'] = $felhasznalo[1];
            $_SESSION['jog'] = $felhasznalo[6];
            header("Location: index.php?page=3");
        }
    }

    function getTermekek() {
        $connection = connect();
        $query = "SELECT * FROM 
                    termekek INNER JOIN kategoriak ON termekek.kategoria_id = kategoriak.id
                          INNER JOIN markak ON termekek.marka_id = markak.id";
        $result = mysqli_query($connection, $query);
        $termekek = mysqli_fetch_all($result);
        mysqli_close($connection);
        if(!$termekek) {
            echo "<h2>Nincsen még alkatrész az adatbázisban!</h2>";
        }
        return $termekek;
    }

    function getKategoria() {
        $connection = connect();
        $query = "SELECT * FROM kategoriak";
        $result = mysqli_query($connection, $query);
        $kategoriak = mysqli_fetch_all($result);
        mysqli_close($connection);
        if(!$kategoriak) {
            die("<h2>Nincsen még kategória az adatbázisban!</h2>");
        }
        return $kategoriak;
    }

    function addKategoria($nev) {
        $connection = connect();
        $query = "INSERT INTO kategoriak (nev) VALUES ('$nev')";
        mysqli_query($connection, $query);
        mysqli_close($connection);
        header("Location: index.php?page=5");
    }

    function getMarka() {
        $connection = connect();
        $query = "SELECT * FROM markak";
        $result = mysqli_query($connection, $query);
        $markak = mysqli_fetch_all($result);
        mysqli_close($connection);
        if(!$markak) {
            die("<h2>Nincsen még márka az adatbázisban!</h2>");
        }
        return $markak;
    }

    function addMarka($nev) {
        $connection = connect();
        $query = "INSERT INTO markak (nev) VALUES ('$nev')";
        mysqli_query($connection, $query);
        mysqli_close($connection);
        header("Location: index.php?page=6");
    }

    function addTermek($nev, $kategoria_id, $marka_id, $ar) {
        $connection = connect();
        $query = "INSERT INTO termekek (nev, kategoria_id, marka_id, ar)
                  VALUES ('$nev', $kategoria_id, $marka_id, $ar)";
        mysqli_query($connection, $query);
        header("Location: index.php?page=4");
    }

    function getTermek($id) {
        $connection = connect();
        $query = "SELECT * FROM 
                    termekek INNER JOIN kategoriak ON termekek.kategoria_id = kategoriak.id
                    WHERE termekek.id = $id";
        $result = mysqli_query($connection, $query);
        $termek = mysqli_fetch_row($result);
        if(!$termek) {
            die("Nincsen ilyen azonosítóval termék!");
        }
        return $termek;
    }

    function getKategoria1($id) {
        $connection = connect();
        $query = "SELECT * FROM 
                    kategoriak WHERE kategoriak.id = $id";
        $result = mysqli_query($connection, $query);
        $kategoria = mysqli_fetch_row($result);
        if(!$kategoria) {
            die("Nincsen ilyen azonosítóval kategória!");
        }
        return $kategoria;
    }

    function getMarka1($id) {
        $connection = connect();
        $query = "SELECT * FROM 
                    markak WHERE markak.id = $id";
        $result = mysqli_query($connection, $query);
        $marka = mysqli_fetch_row($result);
        if(!$marka) {
            die("Nincsen ilyen azonosítóval márka!");
        }
        return $marka;
    }

    function deleteTermek($termek_id) {
        $connection = connect();
        $query = "DELETE FROM termekek WHERE id = $termek_id";
        mysqli_query($connection, $query);
        mysqli_close($connection);
        header("Location: index.php?page=3");
    }

    function deleteKategoria($kategoria_id) {
        $connection = connect();
        $query = "DELETE FROM kategoriak WHERE id = $kategoria_id";
        mysqli_query($connection, $query);
        mysqli_close($connection);
        header("Location: index.php?page=9");
    }

    function deleteMarka($marka_id) {
        $connection = connect();
        $query = "DELETE FROM markak WHERE id = $marka_id";
        mysqli_query($connection, $query);
        mysqli_close($connection);
        header("Location: index.php?page=10");
    }

    function megrendel($termek_id, $felhasznalo_id) {
        $connection = connect();
        $query = "INSERT INTO rendelesek (termek_id, felhasznalo_id)
                  VALUES ($termek_id, $felhasznalo_id)";
        mysqli_query($connection, $query);
        mysqli_close($connection);
        header("Location: index.php?page=3");
    }

    function getRendelesek($felhasznalo_id){
        $connection = connect();
        $query = "SELECT * FROM termekek 
                  INNER JOIN rendelesek ON rendelesek.termek_id = termekek.id
                  INNER JOIN markak ON markak.id = termekek.marka_id
                  INNER JOIN kategoriak ON kategoriak.id = termekek.kategoria_id
                  WHERE rendelesek.felhasznalo_id = $felhasznalo_id";
        $result = mysqli_query($connection, $query);
        $rendelesek = mysqli_fetch_all($result);
        mysqli_close($connection);
        if (!$rendelesek) {
            die("<h2>Nincsenek rendelései!");
        }
        return $rendelesek;
    }

    function deleteRendeles($rendeles_id) {
        $connection = connect();
        $query = "DELETE FROM rendelesek WHERE id = $rendeles_id";
        mysqli_query($connection, $query);
        mysqli_close($connection);
        header("Location: index.php?page=15");
    }

    function updateTermek($termek_id, $nev, $kategoria_id, $marka_id, $ar) {
        $connection = connect();
        $query = "UPDATE termekek SET
                    id = $termek_id,
                    nev = '$nev',
                    kategoria_id = $kategoria_id,
                    marka_id = $marka_id,
                    ar = $ar  
                    WHERE id = $termek_id";
        mysqli_query($connection, $query);
        mysqli_close($connection);
        header("Location: index.php?page=3");
    }

    function updateKategoria($kategoria_id, $nev) {
        $connection = connect();
        $query = "UPDATE kategoriak SET
                    id = $kategoria_id,
                    nev = '$nev'
                    WHERE id = $kategoria_id";
        mysqli_query($connection, $query);
        mysqli_close($connection);
        header("Location: index.php?page=9");
    }

    function updateMarka($marka_id, $nev) {
        $connection = connect();
        $query = "UPDATE markak SET
                    id = $marka_id,
                    nev = '$nev'
                    WHERE id = $marka_id";
        mysqli_query($connection, $query);
        mysqli_close($connection);
        header("Location: index.php?page=10");
    }

    function getFelhasznalo($id) {
        $connection = connect();
        $query = "SELECT * FROM felhasznalok WHERE felhasznalok.id = $id";
        $result = mysqli_query($connection, $query);
        $felhasznalo = mysqli_fetch_row($result);
        if(!$felhasznalo) {
            die("Nincsen ilyen azonosítóval felhasználó!");
        }
        return $felhasznalo;
    }

    function updateFelhasznalo($felhasznalo_id, $felhasznalonev, $email, $teljes_nev, $lakcim, $profilkep) {
        $connection = connect();
        $query = "UPDATE felhasznalok SET
                    id = $felhasznalo_id,
                    felhasznalonev = '$felhasznalonev',
                    email = '$email',
                    teljes_nev = '$teljes_nev',
                    lakcim = '$lakcim',
                    profilkep = '$profilkep'
                    WHERE id = $felhasznalo_id";
        mysqli_query($connection, $query);
        mysqli_close($connection);
        header("Location: index.php?page=3");
    }

    function deleteFelhasznalo($felhasznalo_id) {
        $connection = connect();
        $query = "DELETE FROM felhasznalok WHERE id = $felhasznalo_id";
        mysqli_query($connection, $query);
        mysqli_close($connection);
        header("Location: index.php?page=2");
    }

    function getTermekekKeresve($kereses) {
        $connection = connect();
        $query = "SELECT * FROM 
                    termekek INNER JOIN kategoriak ON termekek.kategoria_id = kategoriak.id
                          INNER JOIN markak ON termekek.marka_id = markak.id
                          WHERE termekek.nev LIKE '%$kereses%'";
        $result = mysqli_query($connection, $query);
        $termekek = mysqli_fetch_all($result);
        mysqli_close($connection);
        if(!$termekek) {
            echo "<h2>Nincsen ilyen alkatrész az adatbázisban!</h2>";
        }
        return $termekek;
    }
?>