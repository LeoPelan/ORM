<?php
/**
 * Created by PhpStorm.
 * User: leopelan
 * Date: 09/12/15
 * Time: 12:11
 */
require_once ('model/Orm.php');
Orm::init('localhost','orm','root','root');
$foo = Orm::getConnexion();
var_dump($foo);
var_dump(Orm::getColSql('user'));
var_dump(Orm::persist('user'));
