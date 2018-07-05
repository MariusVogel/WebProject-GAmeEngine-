<?php
    require_once (__DIR__ . "/../../AutoLoad.php");
    session_start();
    if(!$_SESSION['uname']||!$_SESSION['uid']){
        header("location: ../../www/login.php?d=".urldecode("Bitte zuerst anmelden!"));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <script src="../phaser.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/cosmo.css">


</head>
<body>
    <?php echo Help::getNavbar()?>
    <script src="TestGame.js"></script>
</body>
</html>