<?php
/**
 * Created by PhpStorm.
 * User: leopelan
 * Date: 09/12/15
 * Time: 12:11
 */
require_once('Users.php');

class Orm
{
    private static $connexion = null;

    public static function init($host, $db, $user, $password)
    {
        self::$connexion = new PDO('mysql:host='.$host.';dbname='.$db.';charset=UTF8;', $user, $password);
        self::$connexion->query("SET NAMES utf-8;");
    }

    public static function getConnexion()
    {
        return self::$connexion;
    }

    public function persist($object)
    {
  		$classObject = get_class($object);
  		$tableName = $classObject::getTableName();
  		$query = "INSERT INTO `".$tableName."` ( `id`, `name`, `password`) VALUES (NULL, '".$object->getLogin()."','".$object->getPassword()."')";
  		var_dump(self::$connexion->prepare($query));
  		$req = self::$connexion->prepare($query);
  		$req->execute();
    }

    public function deleteById($table, $id){
      $query = "DELETE FROM ".$table." WHERE id = ".$id ;
      $req = self::$connexion->prepare($query);
      $req->execute();
    }


}
