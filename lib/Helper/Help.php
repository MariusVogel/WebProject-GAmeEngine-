<?php
/**
 * Created by PhpStorm.
 * User: marius
 * Date: 15.06.18
 * Time: 10:11
 */

class Help
{
    /**
     * erstellt einen Danger-Alert
     *
     * @param $text
     * @return string
     */
    public static function DangerAlert($text)
    {
        return "<div class='alert alert-danger' style='max-width: 30em'>
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                <strong>" . $text . "</strong></div>";
    }

    /**
     * erstellt einenSuccess-Alert
     *
     * @param $text
     * @return string
     */
    public static function SuccessAlert($text)
    {
        return '<div class="alert alert-dismissible alert-success" style="max-width: 30em">
                <button type="button" class="close" data-dismiss="alert">&times;</button><strong>' . $text . '</strong></div>';
    }

    /**
     * prueft ob das Passwort stark genug ist
     *
     * @param $pw
     * @return bool
     */
    public static function prufePw($pw)
    {
        return strlen($pw) > 7
            && preg_match("/[a-z]/", $pw)
            && preg_match("/[A-Z]/", $pw)
            && preg_match("/[0-9]/", $pw)
            && (preg_match("/[!-\/:-@]/", $pw));
    }

    /**
     * gib die NavBar zurueck
     *
     * @return string
     */
    public static function getNavbar($spiel = "", $highscore = "")
    {
        return '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Slimemania</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link ' . $spiel . ' " href="index.php">Spiel</a>
      </li>
      <li class="nav-item">
        <a class="nav-link ' . $highscore . '" href="highscore.php" id="highscore">Highscore</a>
      </li>
    </ul>
    <a href="logout.php"><button class="btn btn-danger">Log Out</button></a>
  </div>
</nav>';
    }

    /**
     * @param Score[] $data
     * @return string
     * @throws Exception
     */
    public static function getHighScoreTable($data)
    {
        $ret = '
        <table class="table table-hover">
  <thead class="table-warning">
    <tr>
      <th scope="col">Platz</th>
      <th scope="col">Benutzername</th>
      <th scope="col">Datum</th>
      <th scope="col">Highscore</th>
    </tr>
  </thead>
  <tbody>';
        $con = Anbindung::Get();
        $key = 1;
        foreach ($data as $score) {
            $user = $con->selectUserId($score->userId);
            $ret .= '
<tr>
<td>' . $key++ . '</td>
<td>' . $user->benutzername . '</td>
<td>' . $score->datum . '</td>
<td>' . $score->score . '</td>
</tr>';
        }
        $ret .= '       
 </tbody>
  </table>
        ';
        return $ret;
    }
}
