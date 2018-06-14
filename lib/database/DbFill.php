<?php
/**
 * Created by PhpStorm.
 * User: marius
 * Date: 14.06.18
 * Time: 14:17
 */

$con = new PDO('mysql:host=localhost;dbname=JumpNRun', 'dbuser', 'dbpass');
$pwhash = password_hash('DachsBauer3!', PASSWORD_BCRYPT);
$con->query("INSERT INTO Benutzer (benutzername, mail, pw, code) VALUES ('marius', 'mariusvogel1@gmail.com', '$pwhash' , '1')");
$pwhash = password_hash('Pinkeseinhorn4!', PASSWORD_BCRYPT);
$con->query("INSERT INTO Benutzer (benutzername, mail, pw, code) VALUES ('jannis', 'jannis.luechtefeld@yahoo.de', '$pwhash' , '1')");
$con->query("INSERT INTO Score (userid, score) VALUES ('3', 9001)");
$con->query("INSERT INTO Score (userid, score) VALUES ('6', 1001)");