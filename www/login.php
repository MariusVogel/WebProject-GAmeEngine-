<?php
require_once(__DIR__ . '/../AutoLoad.php');
$errStr = "";
$errStr .= !empty($_REQUEST['d']) ? Help::DangerAlert($_REQUEST['d']) : "";
$errStr .= !empty($_REQUEST['s']) ? Help::SuccessAlert($_REQUEST['s']) : "";
if (!empty($_POST)) {
    if (empty($_POST['uname']) || empty($_POST['pw'])) {
        header("location: login.php?d=" . urldecode("Alle Felder ausfuellen!"));
        exit;
    }
    $con = Anbindung::Get();
    $user = $con->selectUser(strip_tags($_POST['uname']));
    if (!$user) {
        header("location: login.php?d=" . urldecode("Keinen Benutzer unter diesen Namen gefunden!"));
        exit;
    }
    $einmalPw = $con->selectEinmalPw($user->id);
    var_dump($einmalPw);
    if (!password_verify(strip_tags($_POST['pw']), $user->pw) && !$einmalPw) {
        header("location: login.php?d=" . urldecode("Passwort ist falsch!"));
        exit;
    }
    if(!password_verify(strip_tags($_POST['pw']), $einmalPw->pw)){
        header("location: login.php?d=" . urldecode("Passwort ist falsch!"));
        exit;
    }
    if($einmalPw){
        $con->deleteEinmalPw($einmalPw);
    }
    session_start(['cookie_lifetime' => 86400]);
    $_SESSION['uname'] = $user->benutzername;
    $_SESSION['uid'] = $user->id;
    if($user->code != 1){
        header("location: verify.php?s=" . urldecode("Bitte geben sie den Code an den wir Ihnen per Mail geschickt haben."));
        exit;
    }
    header("location: ../lib/phaser-test/TestIndex.php");
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
    <div class="jumbotron">
        <a href="register.php">
            <button class="btn btn-primary">Hier registrieren</button>
        </a>
        <a href="forgotPw.php">
            <button class="btn btn-primary">Passwort zur&uuml;cksetzen</button>
        </a>
    </div>
</div>
</div>
</body>
</html>