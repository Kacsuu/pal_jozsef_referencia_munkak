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
    <title>Bejelentkezés</title>
</head>
<body>
    <dev class="panel">
    <?php
        if(isset($_GET['msg']) && !empty($_GET['msg']))
        {
            $msg = $_GET['msg'];
            echo "<h4>$msg</h4>";
        }
    ?>
    <form method="POST" action="login.php">
        <table>
            <tr>
                <td> <label for="email">Email:</label> </td>
                <td> <input type="email" name="email" id="email"></td>
            </tr>
            <tr>
                <td> <label for="jelszo">Jelszó:</label> </td>
                <td> <input type="password" name="jelszo" id="jelszo"></td>
            </tr>
            <tr>
                <td><button type="submit">Bejelentkezés</button></td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>