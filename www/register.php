<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
    <link href="../lib/bootstrap-3.3.5-dist/css/bootstrap.css">
</head>
<body>
<h1 class="h1">Register</h1>
<div class="form-group">
    <form method="post">
        <div class="form-group">
        <label>Username: <input type="text" name="username" class="form-control"></label>
        </div>
        <div class="form-group">
        <label>Email: <input type="email" name="email" class="form-control"></label>
        </div>
        <label>Password:<input type="password" name="password" class="form-control"> </label>
        <label>Password:<input type="password" name="password2" class="form-controlS"> </label>
        <button class="btn btn-primary">Register</button>
    </form>
</div>
</body>
</html>