<?php
/**
 * Created by PhpStorm.
 * User: marius
 * Date: 14.06.18
 * Time: 15:01
 */
require 'Entity.php';
class User
{
    use Entity;

    public $id;
    public $benutzername;
    public $mail;
    public $pw;
    public $code;

}