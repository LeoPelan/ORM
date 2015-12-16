<?php
/**
 * Created by PhpStorm.
 * User: leopelan
 * Date: 09/12/15
 * Time: 12:11
 */
require_once ('orm/Orm.php');
Orm::init('localhost','orm','root','root');
var_dump(Orm::getAll('user'));
var_dump(Orm::count('user'));
Orm::deleteById('user','2');
