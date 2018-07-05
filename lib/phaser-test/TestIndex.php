<?php
    require_once (__DIR__ . "/../../AutoLoad.php");
    session_start();
    var_dump($_SESSION);
    if(!$_SESSION['uname']||!$_SESSION['uid']){
        header("location: ../../www/login.php?d=".urldecode("Bitte zuerst anmelden!"));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <script src="//cdn.jsdelivr.net/npm/phaser@3.1.1/dist/phaser.js"></script>
    <script src="TestGame.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/cosmo.css">
    <link rel="stylesheet" href="test.css">


</head>
<body>
    <?php echo Help::getNavbar()?>
    <button id="startbutton" onclick="starteSpiel()" class="btn ">START</button>

</body>
</html>