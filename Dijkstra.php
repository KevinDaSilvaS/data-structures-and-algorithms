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
            'dist' => -1,
            'aberto' => true
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
        $GLOBALS['matrix'][$pos1]['pesos'][$pos2] = rand(1,10);
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

function buscaOutroAberto()
{
    $tempDist = -1;
    $p = -1;
    foreach ($GLOBALS['matrix'] as $key => $value) {
        if ($GLOBALS['matrix'][$key]['aberto']) {

            if ($tempDist === -1 || 
            $GLOBALS['matrix'][$key]['dist'] < $tempDist) {
                $tempDist = $GLOBALS['matrix'][$key]['dist'];
                $p = $key;
                /* var_dump("KEY");
                echo $p; */
            }
        }
    }

    if ($p == -1) {
        return;
    }

    if ($GLOBALS['matrix'][$p]['dist'] === -1) {
        $GLOBALS['matrix'][$p]['dist'] = 0;
        $GLOBALS['matrix'][$p]['aberto'] = false;
        $GLOBALS['matrix'][$p]['cont'] = $GLOBALS['count'];
        $GLOBALS['count'] += 1;
        buscaAdj($p);
        var_dump("BUSCAAAAAA");
        echo $p;
    }
}

function buscaAdj($pos)
{
    $dist = $GLOBALS['matrix'][$pos]['dist'];
    $temp = -1;
    $p = 0;
    if (empty($GLOBALS['matrix'][$pos]['saidas'])) {
       buscaOutroAberto();
       return;
    }

    foreach ($GLOBALS['matrix'][$pos]['saidas'] as $key => $value) {

        
        if ($GLOBALS['matrix'][$key]['aberto']) { 

            $t = $dist + $GLOBALS['matrix'][$pos]['pesos'][$key];

            if ($key !== $pos) {
                if ($temp === -1 || $t < $temp) {
                    $temp = $t;
                    $p = $key;
                }
            }

            if ($GLOBALS['matrix'][$key]['dist'] <= 0 || 
            $GLOBALS['matrix'][$key]['dist'] > $t) {

                $GLOBALS['matrix'][$key]['dist'] = $t;
            }
        }
    }

    //var_dump($p);

    if (!$GLOBALS['matrix'][$p]['aberto']) {
        buscaOutroAberto();
    }else {
        $GLOBALS['matrix'][$p]['aberto'] = false;
        buscaAdj($p);
    }
    
    //return true;
}

criaGrafo(5);
for ($i=0; $i < $max*2 ; $i++) { 
    $p1 = rand(0, $max-1);
    $p2 = rand(0, $max-1);
    insereGrafo($p1,$p2);
}

buscaInicial();
var_dump($matrix);
?>