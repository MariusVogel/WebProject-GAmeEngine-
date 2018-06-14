<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
    <link rel="stylesheet" href="../lib/bootstrap/css/cosmo.css">
</head>
<body>
<div class="jumbotron">
    <h1 class="h1">Register</h1>
    <div class="form-group row">
        <form method="post">
            <label for="usern">Username: <input type="text" name="username" class="form-control" id="usern"></label>
            <label for="mail">Email: <input type="email" name="email" class="form-control" id="mail"></label>
            <label for="pw1">Password:<input type="password" name="password" class="form-control" id="pw1"> </label>
            <label for="pw2">Password:<input type="password" name="password2" class="form-control" id="pw2"> </label>
            <button class="btn btn-primary">Register</button>
        </form>
    </div>
</div>
</body>
</html>