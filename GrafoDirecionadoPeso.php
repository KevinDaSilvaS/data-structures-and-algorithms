<?php
$max = 0;
$matrix = array();

function criaGrafo(int $maxElems)
{
    $GLOBALS['max'] = $maxElems;

    for ($i=0; $i < $maxElems; $i++) { 
        
        $GLOBALS['matrix'][$i] = array(
            'entradas' => array(),
            'saidas' => array(),
            'pesos' => array()
        );
        
    }
}

function insereGrafo($pos1,$pos2)
{
    if ($pos1 < 0 && $pos1 > $GLOBALS['max']) {
        return;
    }
 
    if ($pos2 < 0 && $pos2 > $GLOBALS['max']) {
        return;
    }

    if(!empty($GLOBALS['matrix'][$pos2]['saidas'][$pos1])){
        echo "Ja Existe";
        return false;
    }

    if(empty($GLOBALS['matrix'][$pos1]['saidas'][$pos2])){
        $GLOBALS['matrix'][$pos1]['saidas'][$pos2] = $pos2;
        $GLOBALS['matrix'][$pos2]['entradas'][$pos1] = $pos1;
        $GLOBALS['matrix'][$pos1]['pesos'][$pos2] = rand(0,10);
    }
}

criaGrafo(5);
for ($i=0; $i < $max ; $i++) { 
    $p1 = rand(0, $max-1);
    $p2 = rand(0, $max-1);
    insereGrafo($p1,$p2);
}
var_dump($matrix);
?>