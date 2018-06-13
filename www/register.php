<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">

</head>
<body>
<nav class="navbar navbar-collapse">
    <ol class="nav navbar-nav">
        <li><a href="login.php">Login</a></li>
    </ol>
</nav>

<div class="jumbotron">
    <h1 class="h1">Registrieren</h1>
    <form method="post">
        <label class="col-lg-2" for="name ">Username: </label>
        <input type="text" name="username" class="form-control" id="name " placeholder="Benutzername eingeben...">
        <label class="col-lg-2" for="mail">Email: </label>
        <input type="email" name="email" class="form-control" id="mail" placeholder="Email-adresse eingeben...">
        <label class="col-lg-2" for="pw1">Passwort: </label>
        <input type="password" name="passwort" class="form-control" id="pw1" placeholder="Passwort eingeben...">
        <label class="col-lg-2" for="pw2">Passwort wiederholen: </label>
        <input type="password" name="passwort" class="form-control" id="pw2" placeholder="Passwort wiederholen...">
        <br/>
        <button class="btn btn-primary">Registrieren</button>
    </form>
</div>
</body>
</html>