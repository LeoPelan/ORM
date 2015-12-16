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
      $query = 'DESCRIBE '.$tableName;
      $req = self::getConnexion()->prepare($query);
      $res = $req->execute();
      Orm::writeLog($req, $res, $query);
      return $req->fetchAll(\PDO::FETCH_COLUMN);
    }
    public static function persist($tableName)
    {
      $query = "INSERT INTO `".$tableName."` (Orm::getColSql('user')) VALUES (NULL, '".$object->getLogin()."','".$object->getPassword()."')";
		  $req = self::$connexion->prepare($query);
      // QUERYBUILDER
		  $req->execute();
    }
    public static function getAll($tableName)
	  {
      $query = "SELECT * FROM `".$tableName."`";
      $req = self::$connexion->prepare($query);
      $res = $req->execute();
      Orm::writeLog($req, $res, $query);
      $res = $req->fetchAll();

      return $res;
	  }

    public static function deleteById($tableName, $id)
    {
      $query = "DELETE FROM ".$tableName." WHERE id = ".$id ;
      $req = self::$connexion->prepare($query);
      $res = $req->execute();
      Orm::writeLog($req, $res, $query);
      $res = $req->fetchAll();

      return $res;
    }

    public static function writeLog($req, $res, $query){
      $error_log = __DIR__.'/../log/error.log';
      $access_log = __DIR__.'/../log/access.log';

    if(!$res){
      $errorMsg = $req->errorInfo();
      $data = $errorMsg[2]."\n";
      file_put_contents($error_log, $data, FILE_APPEND);
    } else {
      $validMsg = $query;
      $data =  $validMsg."\n";
      file_put_contents($access_log, $data, FILE_APPEND);
    }
  }

    public static function count($tableName){
		$query = "SELECT COUNT(*) FROM " . $tableName;
		$req = self::$connexion->prepare($query);
		$res = $req->execute();
    Orm::writeLog($req, $res, $query);
		$res = $req->fetch();

		return $res[0];
  }

}
