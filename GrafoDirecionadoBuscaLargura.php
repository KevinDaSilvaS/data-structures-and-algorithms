<?php
$max = 0;
$matrix = array();
$fila = array();
$topo = 0;
$fim = 0;
$count = 0;

function criaGrafo(int $maxElems)
{
    $GLOBALS['max'] = $maxElems;

    for ($i=0; $i < $maxElems; $i++) { 
        
        $GLOBALS['matrix'][$i] = array(
            'entradas' => array(),
            'saidas' => array(),
            'marcado' => 0,
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

function buscaLargura()
{
    $key = 0;
    //foreach ($GLOBALS['matrix'] as $key => $value) {
        if ($GLOBALS['matrix'][$key]['marcado'] === 0) {
            
            $GLOBALS['matrix'][$key]['marcado'] = "marked".$GLOBALS['count'];
            buscaAdj($key);
        }
    //}
}

function buscaAdj($pos)
{
    $GLOBALS['count'] += 1;
    if (empty($GLOBALS['matrix'][$pos]['saidas'])) {
       return;
    }

    foreach ($GLOBALS['matrix'][$pos]['saidas'] as $key => $value) {

        if ($GLOBALS['matrix'][$key]['marcado'] === 0) { 
            $GLOBALS['matrix'][$key]['marcado'] = "marked".$GLOBALS['count'];

            if ($GLOBALS['fim'] !== null && $GLOBALS['fim'] > 0) {

                $GLOBALS['fila'][$GLOBALS['fim']-1] = array(
                    "valor" => $GLOBALS['fila'][$GLOBALS['fim']-1]['valor'],
                    "proximo"  => $GLOBALS['fim'],
                );
            }

            $GLOBALS['fila'][$GLOBALS['fim']] = array(
                "valor" => $key,
                "proximo"  => null,
            );

            $GLOBALS['fim'] += 1;
        }
    }

    
    if (empty($GLOBALS['fila'][$GLOBALS['topo']])) {
        return;
    }else {

       $p = $GLOBALS['fila'][$GLOBALS['topo']]['valor'];
       $GLOBALS['topo'] += 1;;
       //var_dump($p);
       buscaAdj($p);
       
       return;
       
    } 
}

criaGrafo(5);
for ($i=0; $i < $max ; $i++) { 
    $p1 = rand(0, $max-1);
    $p2 = rand(0, $max-1);
    insereGrafo($p1,$p2);
}

buscaLargura();
var_dump($matrix);
var_dump($fila);
var_dump($topo);
?>