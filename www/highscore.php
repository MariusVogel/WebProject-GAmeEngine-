<?php
require_once(__DIR__ . '/../AutoLoad.php');
session_start();
if(!$_SESSION['uname']||!$_SESSION['uid']){
    header("location: login.php?d=".urldecode("Bitte zuerst anmelden!"));
}
$con = Anbindung::Get();
$scores = $con->selectAllScore();
$uscore = "";
$uscore .= !empty($_REQUEST['score']) ? Help::SuccessAlert('Ihr erreichter Score betr&auml;gt: '  . $_REQUEST['score']) : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LogIn</title>
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
    <link rel="stylesheet" href="../src/main.css">
</head>
<body>
<?php echo Help::getNavbar("", "active"); ?>
<div class="jumbotron" align="center">
    <?php
    echo  $uscore;
    echo Help::getHighScoreTable($scores);
    ?>
</div>
</body>
</html>