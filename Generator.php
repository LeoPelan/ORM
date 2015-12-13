<?php

require_once('model/Orm.php');

$Host = $argv[1];
$User = $argv[2];
$Password = $argv[3];
$dbName = $argv[4];
$tableName = $argv[5];
$className = ucfirst($argv[6]);

Orm::init($Host, $dbName, $User, $Password);
$fields = (Orm::getColSql($tableName));

$tabs = 4;

  function do_tabs($tabs)
{
    $ret = '';
    for ($i = 0; $i < $tabs; $i ++)
        $ret .= ' ';
    return $ret;
}

$code = "<?php\n\n";
$code .= "class $className\n{\n";
$code .= do_tabs($tabs) . 'protected $tableNameBdd'.";\n";

  foreach ($fields as $field)
{
    $code .= do_tabs($tabs) . 'protected $'.$field.";\n";
}

$code .= "\n";

$code .= do_tabs($tabs) . 'public function set_tableNameBdd'.'($tableNameBdd'.")\n";
$code .= do_tabs($tabs) . "{\n";
$code .= do_tabs($tabs+2) . 'return $this->tableNameBdd'.' = $tableNameBdd'.";\n";
$code .= do_tabs($tabs) . "}\n";
$code .= "\n";
$code .= do_tabs($tabs) . 'public function get_tableNameBdd'.'()'."\n";
$code .= do_tabs($tabs) . "{\n";
$code .= do_tabs($tabs+2) . 'return $this->tableNameBdd'.";\n";
$code .= do_tabs($tabs) . "}\n";
$code .= "\n";

  foreach ($fields as $field)
{
  $code .= do_tabs($tabs) . 'public function get'.ucfirst($field)."()\n";
  $code .= do_tabs($tabs) . "{\n";
  $code .= do_tabs($tabs+2) . 'return $this->'.$field.";\n";
  $code .= do_tabs($tabs) . "}\n\n";
  $code .= do_tabs($tabs) . 'public function set'.ucfirst($field).'($'.$field.")\n";
  $code .= do_tabs($tabs) . "{\n";
  $code .= do_tabs($tabs+2) . '$this->'.$field.' = $'.$field.";\n";
  $code .= do_tabs($tabs) . "}\n\n";
}

$code .= "}\n";

file_put_contents(''.$className.".php", $code);
