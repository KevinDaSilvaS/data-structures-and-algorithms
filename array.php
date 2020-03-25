<?php
$elems = array();

$max = 10;
$sentinela = 0;

for ($i=0; $i < $max; $i++) { 
    $elems[] = null;
}

//array_push($elems,4);

/* function addElem($adicione)
{
    for ($i=0; $i < count($GLOBALS['elems']); $i++) { 
        if ($GLOBALS['elems'][$i] == null) {
            $GLOBALS['elems'][$i] = $adicione;
            break;
        }
    }
    return;
} */
///aumenmta capacidade
function addElem($adicione)
{
    $GLOBALS['elems'][] = $adicione;
    return;
}

//aumenta capacidade
function addSentinela($adicione)
{
    $elems = $GLOBALS['elems'];
    
    $GLOBALS['elems'][$GLOBALS['sentinela']] = $adicione;
    $GLOBALS['sentinela']++;
    return true;

}

/* function addSentinela($adicione)
{
    $elems = $GLOBALS['elems'];
    if ($GLOBALS['sentinela'] < count($elems)) {
        $GLOBALS['elems'][$GLOBALS['sentinela']] = $adicione;
        $GLOBALS['sentinela']++;
        return true;
    }
    return false;
} */

function tamanho()
{
    $elems = $GLOBALS['elems'];
    return count($elems);
}

function mostrarLista()
{
    for ($i=0; $i < count($GLOBALS['elems']); $i++) {
        if($GLOBALS['elems'][$i] != null){
            echo "LISTA: " . $GLOBALS['elems'][$i] . "<br>";
        } 
    }
    return;
}

function busca($index)
{
    if ($index < 0) {
        return;
    }

    if ($index <= count($GLOBALS['elems'])-1 
    && $GLOBALS['elems'][$index] != null) {
        return $GLOBALS['elems'][$index];
    }else{
        return;
    }
}

function buscaBool($elemento){
    for ($i=0; $i < count($GLOBALS['elems']); $i++) {
        if($GLOBALS['elems'][$i] == $elemento){
            echo "POSIÇÃO: " . $i . "<br>";
            /* return true; */
            return $i;
        } 
    }
    /* return false; */
    return -1;
}

function contem($elemento)
{
    $pos = buscaBool($elemento);
    if ($pos >= 0) {
        return $pos;
    }

    return $elemento;

    //return buscaBool($elemento) >= 0;
}

///minha implementação
/* function addPos($pos,$elem)
{
    if (count($GLOBALS['elems']) == $GLOBALS['sentinela']) {
        return;
    }

    if ($pos >= 0 && $pos < $GLOBALS['max']) {
        for ($i=$GLOBALS['sentinela']-1; $i >= $pos; $i--) {
            if ($GLOBALS['elems'][$i+1] != null) {
                return;
            }
            $GLOBALS['elems'][$i+1] = $GLOBALS['elems'][$i];
            echo $pos+1;
        }
        if ($pos+1 == count($GLOBALS['elems']) && $GLOBALS['elems'][$pos] != null) {
            return;
        }
        $GLOBALS['elems'][$pos] = $elem;
        $GLOBALS['sentinela']++;
    }
    return;
} */

function addPos($pos,$elem)
{
    if (count($GLOBALS['elems']) == $GLOBALS['sentinela']) {
        return;
    }

    if ($pos >= 0 && $pos < count($GLOBALS['elems'])-1) {
        for ($i=count($GLOBALS['elems'])-1; $i >= $pos; $i--) {
            $GLOBALS['elems'][$i+1] = $GLOBALS['elems'][$i];
            //echo $pos+1;
        }
        $GLOBALS['elems'][$pos] = $elem;
        $GLOBALS['sentinela']++;
    }
    return;
}

//minha implementação
function removePos($pos)
{
    if ($pos < 0 && $pos > count($GLOBALS['elems'])-1) {
        return;
    }
    
    for ($i=$pos; $i <= count($GLOBALS['elems'])-1; $i++) {
        if ($i != count($GLOBALS['elems'])-1) {
            $GLOBALS['elems'][$i] = $GLOBALS['elems'][$i+1];
        }else {
            $GLOBALS['elems'][$i] = null;
        }
            
    }
    $GLOBALS['sentinela']--;
    
    return;
}

addElem(3);
addElem(5);
addElem(85);
for ($i=2; $i < 5; $i++) { 
    addSentinela($i);
}

addPos(7,88);
addPos(2,18);
addPos(9,8);
addPos(10,1);
addPos(9,11);
addPos(8,16);
addPos(2,7);
addPos(3,7);
addPos(7,88);
var_dump($elems);
removePos(4);

var_dump($elems);

echo(tamanho());

mostrarLista();

echo(busca(5));

buscaBool(5);

echo "<h1>".contem(880)."</h1>"
?>
