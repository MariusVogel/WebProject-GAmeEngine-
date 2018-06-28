<?php
require_once(__DIR__ . '/../AutoLoad.php');
$errStr = !empty($_REQUEST['d']) ? Help::DangerAlert($_REQUEST['d']) : "";
if (!empty($_POST)) {
    if (empty($_POST['uname']) || empty($_POST['mail1']) || empty($_POST['mail2']) || empty($_POST['pw1']) || empty($_POST['pw2'])) {
        header("location: register.php?d=" . urldecode("Alle Felder ausfuellen!"));
        exit;
    }
    if (strip_tags($_POST['pw1']) !== strip_tags($_POST['pw2'])) {
        header("location: register.php?d=" . urldecode("Passwoerter unterschiedlich!"));
        exit;
    }
    if (strip_tags($_POST['mail1']) !== strip_tags($_POST['mail2'])) {
        header("location: register.php?d=" . urldecode("Mail unterschiedlich!"));
        exit;
    }
    if (!filter_var(strip_tags($_POST['mail1']), FILTER_VALIDATE_EMAIL)) {
        header("location: register.php?d=" . urldecode("Mail fehlerhaft!"));
        exit;
    }
    if (!Help::prufePw(strip_tags($_POST['pw1']))) {
        header("location: register.php?d=" . urldecode("Passwort zu schwach!"));
        exit;
    }
    $anbindung = Anbindung::Get();
    $user = $anbindung->selectUser(strip_tags($_POST['uname']));
    $userMail = $anbindung->selectUserMail(strip_tags($_POST['mail1']));
    if ($user || $userMail) {
        header("location: register.php?d=" . urldecode("Nutzer oder Mail schon vergeben!"));
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

    $user = new User([
        'benutzername' => strip_tags($_POST['uname']),
        'mail' => strip_tags($_POST['mail1']),
        'pw' => password_hash(strip_tags($_POST['pw1']), PASSWORD_BCRYPT),
        'code' => $code = $gen(6)
    ]);
    $anbindung->insertUser($user);
    mail(strip_tags($_POST['mail1']), 'Verifizierung [Spielname einfuegen]', "Ihre Regestierung ist fast abgeschlossen sie muessen nur auf der Verifikationseite folgenden Code eingeben.\n\n$code");
    session_start(['cookie_lifetime' => 86400]);
    $_SESSION['uname'] = $user->benutzername;
    $_SESSION['uid'] = $user->id;
    header("location: verify.php?s=" . urldecode("Bitte geben sie den Code an den wir Ihnen per Mail geschickt haben."));
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
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
    <h1 class="h1">Registrieren</h1>
    <?php echo $errStr; ?>
    <form method="post">
        <fieldset style="max-width: 30em">
            <div class="form-group row">
                <label class="col-form-label" for="name ">Username</label>
                <input type="text" name="uname" class="form-control" id="name " placeholder="Benutzername eingeben...">
            </div>
            <div class="form-group row">
                <label class="col-form-label" for="mail1">Email</label>
                <input type="email" name="mail1" class="form-control" id="mail1"
                       placeholder="Email-adresse eingeben...">
            </div>
            <div class="form-group row">
                <label class="col-form-label" for="mail2">Email(wiederholen)</label>
                <input type="email" name="mail2" class="form-control" id="mail1"
                       placeholder="Email-adresse wiederholen...">
            </div>
            <div class="form-group row">
                <label class="col-form-label" for="pw1">Passwort</label>
                <input type="password" name="pw1" class="form-control" id="pw1" placeholder="Passwort eingeben...">
                <small id="pwHelp" class="form-text text-muted" align="left">min. 8 Zeichen lang<br>min. ein Großbuchstabe<br>min. ein
                    Kleinbuchstabe<br>min. eine Zahl<br>min. ein Sonderzeichen(!,@,+,$,usw.)
                </small>
            </div>
            <div class="form-group row">
                <label class="col-form-label" for="pw2">Passwort(wiederholen)</label>
                <input type="password" name="pw2" class="form-control" id="pw2"
                       placeholder="Passwort wiederholen...">
            </div>
            <button class="btn btn-primary">Registrieren</button>
        </fieldset>
    </form>
    <div class="jumbotron">
        <a href="login.php">
            <button class="btn btn-primary">Zur&uuml;ck zum LogIn</button>
        </a>
    </div>
</div>
</body>
</html>