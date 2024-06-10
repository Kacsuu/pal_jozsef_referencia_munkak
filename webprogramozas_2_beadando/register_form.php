<!DOCTYPE html>
<html lang="en">
<style>
    <?php 
      require_once("login_register.css");
    ?>
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
</head>
<body>
    <div class="panel">
    <form method="POST" action="register.php" enctype=multipart/form-data>
        <table>
            <tr>
                <td> <label for="nev">Felhasználónév:</label> </td>
                <td> <input type="text" name="felhasznalonev" id="felhasznalonev"></td>
            </tr>
            <tr>
                <td> <label for="email">Email:</label> </td>
                <td> <input type="email" name="email" id="email"></td>
            </tr>
            <tr>
                <td> <label for="jelszo">Jelszó:</label> </td>
                <td> <input type="password" name="jelszo" id="jelszo"></td>
            </tr>
            <tr>
                <td> <label for="teljes_nev">Teljes név:</label> </td>
                <td> <input type="text" name="teljes_nev" id="teljes_nev"></td>
            </tr>
            <tr>
                <td> <label for="lakcim">Lakcím:</label> </td>
                <td> <input type="text" name="lakcim" id="lakcim"> </td>
            </tr>
            <tr>
                <td> <label for="jog">Jogosultsági kör</label> </td>
                <td> 
                    <select name="jog" id="jog">
                        <option disabled hidden selected>Válasszon jogot: </option>
                        <option value="admin">Adminisztrátor</option>
                        <option value="user">Felhasználó</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Profilkép: </label></td>
            </tr>
            <tr>
                <td><input type="file" name="profilkep" required></td>
            </tr>
            <tr>
                    <td style="text-align: center"><img src="captcha.php" alt="Biztonsági kód" title="Biztonsági kód"></td>
                    <td><input type="text" name="captcha_code" value="" maxlength="6" style="width: 35%; text-align: center"></td>
            </tr>
            <tr>
                <td><button type="submit">Küldés</button></td>
                <td><button type="reset">Alaphelyzet</button></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>