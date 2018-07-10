<?php
    require_once(__DIR__ . '/../AutoLoad.php');
    session_start();
    if(!$_SESSION['uname']||!$_SESSION['uid']){
        header("location: login.php?d=".urldecode("Bitte zuerst anmelden!"));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <script src="../lib/phaser.js"></script>
    <script src="../lib/jquery.js"></script>
    <script src="../src/game.js"></script>
    <link rel="stylesheet" href="../lib/bootstrap/css/cosmo.css">
    <link rel="stylesheet" href="../src/main.css">


</head>
<body>
    <?php echo Help::getNavbar("active", "")?>
    <button id="startbutton" onclick="starteSpiel()" class="btn ">START</button>

</body>
</html>