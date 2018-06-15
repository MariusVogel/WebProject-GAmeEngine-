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
}