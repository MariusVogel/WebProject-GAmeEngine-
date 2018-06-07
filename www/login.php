<?php

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>LogIn</title>
    <link rel="stylesheet" href="../lib/bootstrap/css/cosmo.css">
</head>
<body>
<div class="jumbotron">
    <h1 class="h1">Login</h1>
    <form method="post">
        <div class="form-group row">
            <label class="col-lg-2" for="usern">Benutzername</label>
            <input class="form-control" type="text" name="usern" id="usern" placeholder="Benutzername eingeben..." >
            <label class="col-lg-2" for="pw">Passwort</label>
            <input class="form-control" type="password" name="pw" id="pw" placeholder="Passwort eingeben...">
            <button class="btn btn-primary">Anmelden</button>
        </div>
    </form>
</div>
</body>
</html>