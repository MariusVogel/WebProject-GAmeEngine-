<?php
/**
 * Created by PhpStorm.
 * User: janni
 * Date: 05.07.2018
 * Time: 13:33
 */
session_start();
session_destroy();
header("location: login.php");
exit();