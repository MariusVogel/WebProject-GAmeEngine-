<?php
/**
 * Created by PhpStorm.
 * User: marius
 * Date: 14.06.18
 * Time: 14:17
 */

$con = new PDO('mysql:host=localhost;dbname=JumpNRun', 'dbuser', 'dbpass');
$con->query(file_get_contents("dump_database.sql"));