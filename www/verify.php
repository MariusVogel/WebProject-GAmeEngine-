<?php
session_start();
require_once(__DIR__ . '/../AutoLoad.php');
$sucStr = !empty($_REQUEST['s']) ? Help::SuccessAlert($_REQUEST['s']) : "";
if (!empty($_POST)) {
    if (!empty($_POST['code'])) {
        $con = Anbindung::Get();
        $user = $con->selectUser($_SESSION['uname']);
        if ($user->code != strip_tags($_POST['code'])){
            header("location: verify.php?d=" . urldecode("Code stimmt nicht ueberein!"));
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Verifikation</title>
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
    <h1 class="h1">Verfizieren</h1>
    <?php echo $sucStr; ?>
    <form method="post">
        <fieldset style="max-width: 30em">
            <div class="form-group row">
                <label class="col-form-label" for="code">Code:</label>
                <input class="form-control" type="text" name="code" id="code"
                       placeholder="Verifizierungscode eingeben...">
            </div>
            <button class="btn btn-primary" type="submit">Anmelden</button>
        </fieldset>
    </form>
</div>
</body>
</html>