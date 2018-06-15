<?php
require_once(__DIR__ . '/../AutoLoad.php');
$errStr = !empty($_REQUEST['d']) ? Help::DangerAlert($_REQUEST['d']) : "";
if (!empty($_POST)) {
    if (!empty($_POST['uname']) && !empty($_POST['pw'])) {
        $anbindung = Anbindung::Get();
        $user = $anbindung->selectUser(strip_tags($_POST['uname']));
        if (empty($user->benutzername)) {
            header("location: login.php?d=" . urldecode("Keinen Benutzer unter diesen Namen gefunden!"));
            exit;
        } elseif (password_verify(strip_tags($_POST['pw']), $user->pw)) {
            session_start(['cookie_lifetime' => 86400]);
            $_SESSION['uname'] = $user->benutzername;
            $_SESSION['uid'] = $user->id;
            echo "alles richtig";
            header("location: ../lib/phaser-test/TestIndex.html");
            exit;
        } else {
            header("location: login.php?d=" . urldecode("Passwort ist falsch!"));
            exit;
        }
    } else {
        header("location: login.php?d=" . urldecode("Alle Felder ausfuellen!"));
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>LogIn</title>
    <link rel="stylesheet" href="../lib/bootstrap/css/cosmo.css">
</head>
<body>
<div class="jumbotron" align="center">
    <h1 class="h1">Login</h1>
    <?php echo $errStr; ?>
    <form method="post">
        <fieldset style="max-width: 30em">
            <div class="form-group row">
                <label class="col-form-label" for="usern">Benutzername</label>
                <input class="form-control" type="text" name="uname" id="usern" placeholder="Benutzername eingeben...">
            </div>
            <div class="form-group row">
                <label class="col-form-label" for="pw">Passwort</label>
                <input class="form-control" type="password" name="pw" id="pw" placeholder="Passwort eingeben...">
                <button class="btn btn-primary" type="submit">Anmelden</button>
            </div>
        </fieldset>
    </form>
</div>
</div>
</body>
</html>