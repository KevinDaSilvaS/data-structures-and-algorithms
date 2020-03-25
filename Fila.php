<?php
$elems = array();
$max = 0;
$nElems = 0;
$inicio = -1;

function iniciaFila(array &$fila,int $max)
{
    $GLOBALS['max'] = $max;
    $GLOBALS['nElems'] = 0;
    $GLOBALS['inicio'] = -1;

    for ($i=0; $i < $max; $i++) { 
        $fila[$i] = null;
    }

    return;
}

function insereFila(array &$fila,$content)
{
    if ($GLOBALS['nElems'] >= $GLOBALS['max']) {
        return false;
    }

    if ($GLOBALS['inicio'] < 0) {
        $GLOBALS['inicio'] = 0;
    }

    $pos = ($GLOBALS['inicio'] + $GLOBALS['nElems']) % $GLOBALS['max'];
    $fila[$pos] = $content;
    $GLOBALS['nElems'] += 1;
    return true;
}

function removeFila(array &$fila)
{
    if ($GLOBALS['nElems'] <= 0) {
        return false;
    }

    $fila[$GLOBALS['inicio']] = null;

    $posInicial = ($GLOBALS['inicio'] + 1) % $GLOBALS['max'];
    $GLOBALS['inicio'] = $posInicial;
    $GLOBALS['nElems'] -= 1;

    return true;
}

function tamanhoFila()
{
    return $GLOBALS['nElems'];
}

function exibeFila()
{
    if ($GLOBALS['nElems'] <= 0) {
        return false;
    }

    $ini = $GLOBALS['inicio'];

    echo "FILA:<br>";
    for ($i=0; $i < $GLOBALS['max']; $i++) { 
        
        if ($GLOBALS['elems'][$ini] !== null) {
            echo $GLOBALS['elems'][$ini] . "<br>";
        }
        
        $ini = ($ini + 1) % $GLOBALS['max']; 
    }
    echo "FIM<br>";

    return;
}

function autoInsertFila(array &$fila,int $ini = 0,int $fim = 0)
{
    if ($ini < 0 || $ini > $GLOBALS['max']) {
        return;
    }

    if ($fim < 0 || $fim > $GLOBALS['max']) {
        return;
    }

    if ($GLOBALS['inicio'] < 0) {
        $GLOBALS['inicio'] = $ini;
    }

    for ($i=$ini; $i < $fim; $i++) { 
        if ($GLOBALS['elems'][$i] === null) {
            $fila[$i] = ($i + 1)*rand(1, 10);
            $GLOBALS['nElems'] += 1;
        }
    }
}

function reiniciarFila(array &$fila,$max)
{
    iniciaFila($fila,$max);
    return;
}

iniciaFila($elems,10);
autoInsertFila($elems,4,10);
echo tamanhoFila();
var_dump($elems);
removeFila($elems);
echo tamanhoFila();
var_dump($elems);
insereFila($elems,1001);
exibeFila();
?>