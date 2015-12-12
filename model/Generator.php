<?php

$fields = [];
//
foreach($argv as $i=>$field){
    if(!$i){
        continue;
    }
    $fields[] = $field;
}

$options = getopt("c:");
$character_mask = "-c";
$str = reset($options);
$className = ltrim ( $str, $character_mask );
$tabs = 4;
$element = $className;
unset($fields[array_search($element, $fields)]);


function do_tabs($tabs)
{
    $ret = '';

    for ($i = 0; $i < $tabs; $i ++)
        $ret .= ' ';
    return $ret;
}

$code = "<?php\n\n";

$code .= "class $className\n{\n";

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
    $code .= do_tabs($tabs) . 'public function set'.ucfirst($field).'($'.$field.")\n";
    $code .= do_tabs($tabs) . "{\n";
    $code .= do_tabs($tabs+2) . '$this->'.$field.' = $'.$field.";\n";
    $code .= do_tabs($tabs) . "}\n\n";
}

$code .= "}\n";

file_put_contents($className.".php", $code);
