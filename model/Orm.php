<?php
/**
 * Created by PhpStorm.
 * User: leopelan
 * Date: 09/12/15
 * Time: 12:11
 */
// require_once('Users.php');

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

    public static function getColSql($tableName)
    {
      $result = self::getConnexion()->prepare('DESCRIBE '.$tableName);
      $result->execute();
      return $result->fetchAll(\PDO::FETCH_COLUMN);
    }
    public static function persist($object)
    {
      $tableName = $object::getTableName();
      $query = "INSERT INTO `".$tableName."` (Orm::getColSql('user')) VALUES (NULL, '".$object->getLogin()."','".$object->getPassword()."')";
		  $req = self::$connexion->prepare($query);
      // QUERYBUILDER
		  $req->execute();
    }
    public static function getAll($object)
	  {
      $tableName = $object::getTableName();
      $query = "SELECT * FROM `".$tableName."`";
      $req = self::$connexion->prepare($query);
      $req->execute();
      return $req->fetchAll();
	  }

    public static function deleteById($table, $id)
    {
      $query = "DELETE FROM ".$table." WHERE id = ".$id ;
      $req = self::$connexion->prepare($query);
      $req->execute();
    }

}
