<?php
/**
 * Created by PhpStorm.
 * User: leopelan
 * Date: 09/12/15
 * Time: 10:36
 */

function do_tabs($tabs)
{
    $ret = '';
for ($i = 0 ; $i < $tabs ; $i++)
    $ret .= ' ';
}
$className = $argv[1];
//MAGIC BITCH
$fields = array('id', 'login', 'password');
$tabs = 2;
$code = "<?php\n\n";
$code .=  "class $className \n{\n";

$code .= "\n";
foreach ($fields as $field)
{
    $code .= do_tabs($tabs) . 'protected $'.$field.";\n";
}

$code .= "\n";

foreach ($fields as $field)
{
    $code .= do_tabs($tabs) . 'public function get'.ucfirst($field)."()\n";
    $code .= do_tabs($tabs) . "{\n";
    $code .= do_tabs($tabs+2) . 'return $this->'.$field.";\n";
    $code .= do_tabs($tabs) . "}\n\n";
    $code .= do_tabs($tabs) . 'public function set'.ucfirst($field).'($'.$fields.")\n";
    $code .= do_tabs($tabs) . "{\n";
    $code .= do_tabs($tabs+2) . '$this->'.$field.' = $'.$field.";\n";
    $code .= do_tabs($tabs) . "}\n\n";
}
$code .= "}\n";

file_put_contents($className.".php", $code);
