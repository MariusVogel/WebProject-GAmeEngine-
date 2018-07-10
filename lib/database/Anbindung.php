<?php
/**
 * Created by PhpStorm.
 * User: marius
 * Date: 14.06.18
 * Time: 14:49
 */

require_once(__DIR__ . '/../../AutoLoad.php');

class Anbindung
{
    private static $con = null;
    private static $pdo = null;

    private function __construct(PDO $pdo)
    {
        self::$pdo = $pdo;
    }

    public static function Get()
    {
        if (!self::$pdo) {
            self::$con = new self(new PDO('mysql:host=localhost;dbname=JumpNRun', 'dbuser', 'dbpass'));
            return self::$con;
        }
        return self::$con;
    }

    public function insertUser(User $user)
    {
        $stm = "INSERT INTO Benutzer (benutzername, mail, pw, code) VALUES (?, ?,  ?, ?)";
        $stm = self::$pdo->prepare($stm);
        if ($stm) {
            $stm->execute(array(
                $user->benutzername,
                $user->mail,
                $user->pw,
                $user->code
            ));
            $insId = self::$pdo->lastInsertId();
            $user->id = $insId;
            return $user;
        } else
            throw new Exception("Statement klappt nicht");
    }

    public function updateUser(User $user)
    {
        $stm = ("UPDATE Benutzer SET mail = ?, pw = ?, code = ? WHERE benutzername = ?");
        $stm = self::$pdo->prepare($stm);
        if ($stm) {
            $stm->execute(array(
                $user->mail,
                $user->pw,
                $user->code,
                $user->benutzername
            ));
        } else
            throw new Exception("Statement klappt nicht");
    }

    public function selectUser($benutzername)
    {
        $stm = "SELECT * FROM Benutzer WHERE benutzername = ?";
        $stm = self::$pdo->prepare($stm);
        if ($stm) {
            $stm->execute(array(
                $benutzername
            ));
            if ($result = $stm->fetch(PDO::FETCH_ASSOC)) {
                return new User($result);
            }
            return false;
        } else
            throw new Exception("Statement klappt nicht");
    }

    public function selectUserId($id)
    {
        $stm = "SELECT * FROM Benutzer WHERE id = ?";
        $stm = self::$pdo->prepare($stm);
        if ($stm) {
            $stm->execute(array(
                $id
            ));
            if ($result = $stm->fetch(PDO::FETCH_ASSOC)) {
                return new User($result);
            }
            return false;
        } else
            throw new Exception("Statement klappt nicht");
    }

    public function selectUserMail($mail)
    {
        $stm = "SELECT * FROM Benutzer WHERE mail = ?";
        $stm = self::$pdo->prepare($stm);
        if ($stm) {
            $stm->execute(array(
                $mail
            ));
            if ($result = $stm->fetch(PDO::FETCH_ASSOC)) {
                return new User($result);
            }
            return false;
        } else
            throw new Exception("Statement klappt nicht");
    }

    public function insertScore(Score $score)
    {
        $stm = "INSERT INTO Score (userid, score) VALUES (?, ?)";
        $stm = self::$pdo->prepare($stm);
        if ($stm) {
            $stm->execute(array(
                $score->userId,
                $score->score
            ));
            $insId = self::$pdo->lastInsertId();
            $score->id = $insId;
            return $score;
        } else
            throw new Exception("Statement klappt nicht");
    }

    public function updateScore(Score $score)
    {
        $stm = ("UPDATE Score SET score = ? WHERE userId = ?");
        $stm = self::$pdo->prepare($stm);
        if ($stm) {
            $stm->execute(array(
                $score->score,
                $score->userId
            ));
        } else
            throw new Exception("Statement klappt nicht");
    }

    public function selectScore($userid)
    {
        $stm = "SELECT * FROM Score WHERE userid = ?";
        $stm = self::$pdo->prepare($stm);
        if ($stm) {
            $stm->execute(array(
                $userid
            ));
            if($result = $stm->fetch(PDO::FETCH_ASSOC)) {
                return new Score($result);
            }else
                return false;

        } else
            throw new Exception("Statement klappt nicht");
    }

    public function selectAllScore()
    {
        $stm = "SELECT * FROM Score";
        $stm = self::$pdo->prepare($stm);
        if ($stm) {
            $stm->execute();
            if($result = $stm->fetchAll(PDO::FETCH_ASSOC)) {
                $retArr = [];
                foreach ($result as $score){
                    $retArr[] = new Score($score);
                }
                return $retArr;
            }else
                return false;

        } else
            throw new Exception("Statement klappt nicht");
    }


    public function deleteUser($userid)
    {
        $stm = "DELETE FROM Benutzer WHERE id = ?";
        $stm2 = "DELETE FROM Score WHERE userId = ?";
        $stm = self::$pdo->prepare($stm);
        $stm2 = self::$pdo->prepare($stm2);
        if ($stm && $stm2) {
            $stm->execute(array($userid));
            $stm2->execute(array($userid));
            return true;
        } else
            throw new Exception("Statement klappt nicht");
    }

    public function insertEinmalPw(EinmalPw $pw)
    {
        $stm = "INSERT INTO EinmalPw (userId, pw) VALUES (?, ?);";
        $stm = self::$pdo->prepare($stm);
        if ($stm) {
            $stm->execute(array(
                $pw->userId,
                $pw->pw
            ));
        } else
            throw new Exception("Statement klappt nicht");
    }

    public function updateEinmalPw(EinmalPw $pw)
    {
        $stm = "Update EinmalPw Set pw = ? WHERE userId = ?;";
        $stm = self::$pdo->prepare($stm);
        if ($stm) {
            $stm->execute(array(
                $pw->pw,
                $pw->userId
            ));
        } else
            throw new Exception("Statement klappt nicht");
    }

    public function deleteEinmalPw(EinmalPw $pw)
    {
        $stm = "DELETE FROM EinmalPw WHERE userId = ?;";
        $stm = self::$pdo->prepare($stm);
        if ($stm) {
            $stm->execute(array($pw->userId));
        } else
            throw new Exception("Statement klappt nicht");

    }

    public function selectEinmalPw($userId)
    {
        $stm = "SELECT * FROM EinmalPw WHERE userId = ?;";
        $stm = self::$pdo->prepare($stm);
        if ($stm) {
            $stm->execute(array($userId));
            if ($result = $stm->fetch(PDO::FETCH_ASSOC)) {
                return new EinmalPw($result);
            }
            return false;
        } else
            throw new Exception("Statemaent klappt nicht");
    }

}