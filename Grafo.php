<?php
$max = 0;
$matrix = array();
function criaGrafo(int $maxElems)
{
    $GLOBALS['max'] = $maxElems;

    for ($i=0; $i < $maxElems; $i++) { 
        
        $GLOBALS['matrix'][$i] = array(
            'conexao' => array(),
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

    if ($pos1 === $pos2) {
        return;
    }

    if(!empty($GLOBALS['matrix'][$pos2]['conexao'][$pos1])){
        echo "Ja Existe";
        if ($GLOBALS['matrix'][$pos2]['conexao'][$pos1] !== null) {
            return false;
        } 
    }

    if(empty($GLOBALS['matrix'][$pos1]['conexao'][$pos2])){
        $GLOBALS['matrix'][$pos1]['conexao'][$pos2] = $pos2;
    }
}

function removeGrafo($pos)
{
    if ($pos < 0 && $pos > $GLOBALS['max']) {
        return;
    }
 
    foreach ($GLOBALS['matrix'] as $key => $value) {
        if(!empty($GLOBALS['matrix'][$key]['conexao'][$pos])){
            $GLOBALS['matrix'][$key]['conexao'][$pos] = null;
        }
    }

    $GLOBALS['matrix'][$pos] = null;
}

criaGrafo(5);
for ($i=0; $i < $max*2 ; $i++) { 
    $p1 = rand(0, $max-1);
    $p2 = rand(0, $max-1);
    insereGrafo($p1,$p2);
}
var_dump($matrix);

/* removeGrafo(2);
var_dump($matrix); */
?>