<?php
    require_once('mydbms.php');

    $felhasznalo_id = $_POST['felhasznalo_id'];
    $felhasznalonev = $_POST['nev'];
    $email = $_POST['email'];
    $teljes_nev = $_POST['teljes_nev'];
    $lakcim = $_POST['lakcim'];

    $filename = trim($_FILES['profilkep']['name']);
    $filename = rand().$filename;
    $beirando="kepek/".$_POST["nev"]."/".$filename;
    $dbname="alkatresz_webshop";
    $con=connect("root","", $dbname);

    $query="update felhasznalok set felhasznalonev='$felhasznalonev', email='$email', teljes_nev='$teljes_nev', lakcim='$lakcim',  profilkep='$beirando' where id=$felhasznalo_id";
    $result=mysqli_query($con,$query);
    mkdir("kepek/".$_POST["nev"]);
    move_uploaded_file ($_FILES['profilkep']['tmp_name'],"kepek/".$_POST["nev"]."/".$filename);
    mysqli_close($con);
    header("Location: index.php?page=13");
?>