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

    public static function getNavbar()
    {
     return   "<nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">
  <a class=\"navbar-brand\" href=\"#\">Crazy Jump</a>
  <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarColor02\" aria-controls=\"navbarColor02\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
    <span class=\"navbar-toggler-icon\"></span>
  </button>

  <div class=\"collapse navbar-collapse\" id=\"navbarColor02\">
    <ul class=\"navbar-nav mr-auto\">
      <li class=\"nav-item active\">
        <a class=\"nav-link\" href=\"#\">Home<span class=\"sr-only\">(current)</span></a>
      </li>
      <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"#\">Passwort ändern</a>
      </li>
      <li class=\"nav-item\">s
        <a class=\"nav-link\" href=\"#\">Highscore</a>
      </li>
      <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"#\">Log Out</a>
      </li>
    </ul>
  </div>
</nav>";
    }
}
