<?php
require_once(__DIR__ . '/../AutoLoad.php');
$errStr = !empty($_REQUEST['d']) ? Help::DangerAlert($_REQUEST['d']) : "";
if (!empty($_POST)) {
    $con = Anbindung::Get();
    $user = $con->selectUser(strip_tags($_POST['uname']));
    if (!$user || $user->mail != strip_tags($_POST['mail'])) {
        header("location: forgotPw.php?d=" . urldecode("Fehlerhafte Eingabe"));
        exit;
    }
    $gen = function ($length) {
        $pw = "";
        $salt = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM1234567890';
        for ($i = 0; $i < $length; $i++) {
            $pw .= $salt[rand(0, strlen($salt))];
        }
        return $pw;
    };
    $newpw = $gen(20);
    $pw = new EinmalPw(['userId' => $user->id, 'pw' => password_hash($newpw, PASSWORD_BCRYPT)]);
    if(!$con->selectEinmalPw($user->id)) {
        $con->insertEinmalPw($pw);
    }else{
        $con->updateEinmalPw($pw);
    }
    mail($user->mail, "Passwort zuruecksetzten", "Hier ist ihr gewuenschtes Einmal-Passwort:\n$newpw");
    header("location: login.php?s=" . urldecode("Wir haben ihnen ein neues Passwort per Mail zugeschickt!"));
    exit();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Passwort vergessen</title>
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
    <h1 class="h1">Passwort zur&uuml;cksetzen</h1>
    <?php echo $errStr; ?>
    <form method="post">
        <fieldset style="max-width: 30em">
            <div class="form-group row">
                <label class="col-form-label" for="usern">Benutzername</label>
                <input class="form-control" type="text" name="uname" id="usern" placeholder="Benutzername eingeben...">
            </div>
            <div class="form-group row">
                <label class="col-form-label" for="mail">E-Mail</label>
                <input class="form-control" type="text" name="mail" id="mail" placeholder="Mail eingeben...">
            </div>
            <button class="btn btn-danger" type="submit">Passwort vergessen</button>
        </fieldset>
    </form>
</div>
</div>
</body>
</html>