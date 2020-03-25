<?php
$max = 0;
$matrix = array();
$count = 0;

function criaGrafo(int $maxElems)
{
    $GLOBALS['max'] = $maxElems;

    for ($i=0; $i < $maxElems; $i++) { 
        
        $GLOBALS['matrix'][$i] = array(
            'entradas' => array(),
            'saidas' => array(),
            'pesos' => array(),
            'dist' => null,
            'aberto' => true,
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
        $GLOBALS['matrix'][$pos1]['pesos'][$pos2] = rand(-10,10);
    }
}

function buscaInicial()
{
    $key = 0;

        if ($GLOBALS['matrix'][$key]['aberto']) {
            
            $GLOBALS['matrix'][$key]['dist'] = 0;
            $GLOBALS['matrix'][$key]['aberto'] = false;
            buscaAdj($key);
        }
}

function buscaAdj($chave)
{
    $distance = $GLOBALS['matrix'][$chave]['dist'];
    $temp = null;
    $p = 0;

    if (empty($GLOBALS['matrix'][$chave]['saidas'])) {
        buscaOutroAberto();
        return;
    }

    $saidas = $GLOBALS['matrix'][$chave]['saidas'];

    foreach ($saidas as $key => $value) {
        if ($GLOBALS['matrix'][$key]['aberto']) { 

            $t = $distance + $GLOBALS['matrix'][$chave]['pesos'][$key];

            if ($key !== $chave) {
                if ($temp === null || $t < $temp) {
                    $temp = $t;
                    $p = $key;
                }
            }

            if ($GLOBALS['matrix'][$key]['dist'] === null || 
            $GLOBALS['matrix'][$key]['dist'] > $t) {

                $GLOBALS['matrix'][$key]['dist'] = $t;
            }
        }
    }

    if (!$GLOBALS['matrix'][$p]['aberto']) {
        buscaOutroAberto();
    }else {
        $GLOBALS['matrix'][$p]['aberto'] = false;
        buscaAdj($p);
    }


}

function buscaOutroAberto()
{
    $tempDist = null;
    $p = null;
    foreach ($GLOBALS['matrix'] as $key => $value) {
        if ($GLOBALS['matrix'][$key]['aberto']) {

            if ($tempDist === null || 
            $GLOBALS['matrix'][$key]['dist'] < $tempDist) {
                $tempDist = $GLOBALS['matrix'][$key]['dist'];
                $p = $key;
            }
        }
    }

    if ($p === null) {
        return;
    }

    if ($GLOBALS['matrix'][$p]['dist'] === null) {
        $GLOBALS['matrix'][$p]['dist'] = 0;
        $GLOBALS['matrix'][$p]['aberto'] = false;
        $GLOBALS['matrix'][$p]['cont'] = $GLOBALS['count'];
        $GLOBALS['count'] += 1;
        buscaAdj($p);
    }
}

criaGrafo(5);
for ($i=0; $i < $max ; $i++) { 
    $p1 = rand(0, $max-1);
    $p2 = rand(0, $max-1);
    insereGrafo($p1,$p2);
}

buscaInicial();
var_dump($matrix);
?>