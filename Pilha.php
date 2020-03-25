<?php
/*Iniciar Estrutura*/
$elems = array();

$max = 10;
$topo = -1;

for ($i=0; $i < $max; $i++) { 
    inserePilha($i*rand(1, 10));
}

var_dump($elems);
/*Fim Inicio Estrutura */

function tamanho()
{
   return $GLOBALS['topo'] + 1;
}

function inserePilha($conteudo)
{
    if (tamanho() == $GLOBALS['max']) {
        return false;
    }

    $GLOBALS['elems'][tamanho()] = $conteudo;
    $GLOBALS['topo'] += 1;
    return true;
}

function showPilha()
{
    echo "PILHA:";
    for ($i=$GLOBALS['topo']; $i > -1; $i--) { 
        echo "<br>" . $i . "::::::>" . $GLOBALS['elems'][$i] . "<br>";
    }

    echo "FIM DA PILHA";
}

function excluirEmPilha(&$reg = null)
{
    if ($GLOBALS['topo'] < 0) {
       return false;
    }

    $key = $GLOBALS['topo'];
    $reg = $GLOBALS['elems'][$key];
    $GLOBALS['topo'] -= 1;
    return true;
}

function reiniciarPilha()
{
    $GLOBALS['topo'] = -1;
}

/*$p = 0;
inserePilha(15555);
var_dump($elems);
excluirEmPilha($p);
inserePilha(250);
echo "<h1>" . $p . "</h1>";
var_dump($elems); */
//reiniciarPilha();
showPilha();
//echo "<h1>" . tamanho() . "</h1>";
?>