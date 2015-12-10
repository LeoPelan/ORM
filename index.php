<?php
/**
 * Created by PhpStorm.
 * User: leopelan
 * Date: 09/12/15
 * Time: 12:11
 */
require_once ('orm_connexion.php');
Orm::init('localhost','ORM','root','root');
$foo = Orm::getConnexion();
var_dump($foo);