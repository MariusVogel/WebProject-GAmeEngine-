<?php
/**
 * Created by PhpStorm.
 * User: marius
 * Date: 10.07.18
 * Time: 17:28
 */
require_once (__DIR__ . '/../AutoLoad.php');
session_start();
$con  = Anbindung::Get();
$score = $con->selectScore($_SESSION['uid']);
if($score){
    if($_POST['score']>$score->score){
        $score->score = $_POST['score'];
    }
    $con->updateScore($score);
}else{
    $score = new Score(['userId' => $_SESSION['uid'], 'score' => $_POST['score']]);
    $con->insertScore($score);
}