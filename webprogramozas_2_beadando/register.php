<?php
session_start();
        if (strtolower($_POST["captcha_code"]) != $_SESSION["mycaptcha"]){
        header("Location: index.php?page=2&msg=Hibás+captcha+kód!");
        }
        else{
            require("mydbms.php");
            $filename = trim($_FILES['profilkep']['name']);
            $filename = rand().$filename;
            $beirando="kepek/".$_POST["felhasznalonev"]."/".$filename;
            $dbname="alkatresz_webshop";
            $con=connect("root","", $dbname);
            $query="select * from felhasznalok where felhasznalonev='".$_POST['felhasznalonev']."' or email='".$_POST['email']."'";
	        $result=mysqli_query($con,$query);
            $list=mysqli_fetch_all($result);
            if (count($list) > 0){
                echo "Ezzel az e-mail címmel vagy felhasználónévvel már regisztráltak";
                mysqli_close($con);
                header("Location: index.php?page=2");
	        }
	        else{
                $felhasznalonev = $_POST['felhasznalonev'];
                $email = $_POST['email'];
                $jelszo = md5($_POST['jelszo']);
                $teljes_nev = $_POST['teljes_nev'];
                $lakcim = $_POST['lakcim'];
                $jog = $_POST['jog'];
                $query="insert into felhasznalok(felhasznalonev,email,jelszo,teljes_nev, lakcim, jog, profilkep) values ('$felhasznalonev', '$email', '$jelszo', '$teljes_nev', '$lakcim', '$jog', '$beirando')";
	            $result=mysqli_query($con,$query);
                mkdir("kepek/".$_POST["felhasznalonev"]);
                move_uploaded_file ($_FILES['profilkep']['tmp_name'],"kepek/".$_POST["felhasznalonev"]."/".$filename);
                mysqli_close($con);
                header("Location: index.php?page=1");
	        }  
    }
?>