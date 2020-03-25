<?php
$elems = array();
$max = 0;
$inicio = -1;
$finalFila = -1;

function iniciaFila(array &$fila,int $max)
{
    $GLOBALS['max'] = $max;
    $GLOBALS['nElems'] = 0;
    $GLOBALS['inicio'] = null;
    $GLOBALS['finalFila'] = -1;

    for ($i=0; $i < $max; $i++) { 
        $fila[$i] = array(
            "valor" => null,
            "proximo"  => null,
        );
    }

    return;
}

function insereFila(array &$fila,$content)
{
    if ($GLOBALS['inicio'] === null) {
        $GLOBALS['inicio'] = 0;
    }

    $pos = ($GLOBALS['finalFila'] + 1) % $GLOBALS['max'];

    if ($fila[$pos]['valor'] !== null) {
        return;
    }

    if ($GLOBALS['finalFila'] !== null && $GLOBALS['finalFila'] >= 0) {
        $fila[$GLOBALS['finalFila']] = array(
            "valor" => $fila[$GLOBALS['finalFila']]['valor'],
            "proximo"  => $pos,
        );
    }

    $fila[$pos] = array(
        "valor" => $content,
        "proximo"  => null,
    );
 
    $GLOBALS['finalFila'] = $pos;

    return true;
}

function removeFila(array &$fila)
{
    if ($GLOBALS['inicio'] === null) {
        return false;
    }

    $elementoExclusao = $fila[$GLOBALS['inicio']];

    foreach ($fila as $key => $value) {
       if ($value['proximo'] == $GLOBALS['inicio']) {
            $value['proximo'] = $elementoExclusao['proximo'];
            break;
       }
    }

    $fila[$GLOBALS['inicio']] = array(
        "valor" => null,
        "proximo"  => null,
    );

    $GLOBALS['inicio'] = $elementoExclusao['proximo'];

    return true;
}

function tamanhoFila(array &$fila)
{
    $a = $GLOBALS['inicio'];
    var_dump($fila[$a]);
    $tam = 0;

    while ($fila[$a]['proximo'] !== null){
        $tam++;
        $a = $fila[$a]['proximo'];
    }
    $tam++;
    return $tam; 
}

function exibeFila()
{
    $ini = $GLOBALS['inicio'];

    echo "FILA:<br>";
    for ($i=0; $i < $GLOBALS['max']; $i++) { 
        
        if ($GLOBALS['elems'][$ini]['valor'] !== null) {
            var_dump($GLOBALS['elems'][$ini]);
        }
        
        $ini = ($ini + 1) % $GLOBALS['max']; 
    }
    echo "FIM<br>";

    return;
}

function reiniciarFila(array &$fila,$max)
{
    iniciaFila($fila,$max);
    return;
}

iniciaFila($elems,10);

insereFila($elems,1001);
insereFila($elems,18);
insereFila($elems,210);
echo tamanhoFila($elems);
removeFila($elems);
removeFila($elems);
var_dump($elems);
exibeFila();
?>