<?php
$max = 0;
$matrix = array();
$tempo = 0;
function criaGrafo(int $maxElems)
{
    $GLOBALS['max'] = $maxElems;

    for ($i=0; $i < $maxElems; $i++) { 
        
        $GLOBALS['matrix'][$i] = array(
            'entradas' => array(),
            'saidas' => array(),
            'tempo' => array(),
            'cor' => 'branco',
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
    }
}

function buscaProfundidade()
{
    foreach ($GLOBALS['matrix'] as $key => $value) {
        if ($GLOBALS['matrix'][$key]['cor'] == "branco") {
            
            buscaAdj($key);
        }
    }
}

function buscaAdj($pos)
{
    $GLOBALS['matrix'][$pos]['cor'] = "cinza";
    $GLOBALS['tempo'] += 1;
    $GLOBALS['matrix'][$pos]['tempo'][] = $GLOBALS['tempo'];
    

    if (empty($GLOBALS['matrix'][$pos]['saidas'])) {
        $GLOBALS['matrix'][$pos]['cor'] = "preto";
        $GLOBALS['tempo'] += 1;
        $GLOBALS['matrix'][$pos]['tempo'][] = $GLOBALS['tempo'];
        
        return;
    }

    foreach ($GLOBALS['matrix'][$pos]['saidas'] as $key => $value) {
        if ($GLOBALS['matrix'][$key]['cor'] == 'branco') {
            buscaAdj($key);
        } 
    }

    $GLOBALS['matrix'][$pos]['cor'] = "preto";
    $GLOBALS['tempo'] += 1;
    $GLOBALS['matrix'][$pos]['tempo'][] = $GLOBALS['tempo'];
    

    return;
}

criaGrafo(5);
for ($i=0; $i < $max ; $i++) { 
    $p1 = rand(0, $max-1);
    $p2 = rand(0, $max-1);
    insereGrafo($p1,$p2);
}
var_dump($matrix);

buscaProfundidade();
var_dump($matrix);
?>