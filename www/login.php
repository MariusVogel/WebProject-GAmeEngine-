<?php
require_once(__DIR__ . '/../AutoLoad.php');
$errStr = !empty($_REQUEST['d']) ? Help::DangerAlert($_REQUEST['d']) : "";
if (!empty($_POST)) {
    if (!empty($_POST['uname']) || !empty($_POST['pw'])) {
        header("location: login.php?d=" . urldecode("Alle Felder ausfuellen!"));
        exit;
    }
    $anbindung = Anbindung::Get();
    $user = $anbindung->selectUser(strip_tags($_POST['uname']));
    if (!$user) {
        header("location: login.php?d=" . urldecode("Keinen Benutzer unter diesen Namen gefunden!"));
        exit;
    }
    if (!password_verify(strip_tags($_POST['pw']), $user->pw)) {
        header("location: login.php?d=" . urldecode("Passwort ist falsch!"));
        exit;
    }
    session_start(['cookie_lifetime' => 86400]);
    $_SESSION['uname'] = $user->benutzername;
    $_SESSION['uid'] = $user->id;
    echo "alles richtig";
    header("location: ../lib/phaser-test/TestIndex.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>LogIn</title>
    <link rel="stylesheet" href="../lib/bootstrap/css/cosmo.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
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
            </div>
            <button class="btn btn-primary" type="submit">Anmelden</button>
        </fieldset>
    </form>
</div>
</div>
</body>
</html>