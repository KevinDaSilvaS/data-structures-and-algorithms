<?php
$elems = array();

$max = 10;
$topoPilha1 = -1;
$topoPilha2 = $max;

for ($i=0; $i < $max; $i++) { 
    $elems[] = null;
}

for ($i=0; $i < $max; $i++) {
    $p = rand(1, 2);
    echo $p;
    inserePilha($elems,$p,$i*rand(1, 10));
}

var_dump($elems);

excluirPilha($elems,1);
excluirPilha($elems,1);

var_dump($elems);

inserePilha($elems,2,$i*rand(1, 10));

var_dump($elems);

echo tamanhoPilhas();

exibirPilha($elems,1);

function tamanhoPilhas()
{
    return ($GLOBALS['topoPilha1'] + 1) + ($GLOBALS['max'] - $GLOBALS['topoPilha2']);
}

function exibirPilha(array &$pilhaDupla,int $pilha)
{
    if($pilha < 1 || $pilha > 2){
        return false;
    }  

    echo "PILHA";
    if ($pilha == 1) {
        for ($i=$GLOBALS['topoPilha1']; $i >= 0; $i--) { 
            echo "<br>" . $GLOBALS['elems'][$i] . "<br>";
        }
    }else {
        for ($i=$GLOBALS['topoPilha2']; $i < $GLOBALS['max']; $i++) { 
            echo "<br>" . $GLOBALS['elems'][$i] . "<br>";
        }
    }
    echo "PILHA";

    return true;
}

function inserePilha(array &$pilhaDupla,int $pilha,$conteudo)
{
    if (tamanhoPilhas() == $GLOBALS['max']) {
        return false;
    }

    if($pilha < 1 || $pilha > 2){
        return false;
    } 

    if ($pilha == 1) {
        $GLOBALS['topoPilha1'] = $GLOBALS['topoPilha1']+1;
        $pilhaDupla[$GLOBALS['topoPilha1']] = $conteudo;
    }else {
        $GLOBALS['topoPilha2'] = $GLOBALS['topoPilha2']-1;
        $pilhaDupla[$GLOBALS['topoPilha2']] = $conteudo;
    }

    return true;
}

function excluirPilha(array &$pilhaDupla,int $pilha)
{
    if($pilha < 1 || $pilha > 2){
        return false;
    } 

    if ($GLOBALS['topoPilha1'] == -1) {
       return false;
    }

    if ($pilha == 1) {
        $topo = $GLOBALS['topoPilha1'];
        $GLOBALS['topoPilha1'] -= 1;
    }

    if ($GLOBALS['topoPilha2'] == $GLOBALS['max']) {
        return false;
    }
 
     if ($pilha == 2) {
         $topo = $GLOBALS['topoPilha2'];
         $GLOBALS['topoPilha2'] += 1;
     }

    $pilhaDupla[$topo] = null;
    return true;
}

function reiniciarDuplaPilha(){
    $GLOBALS['topoPilha1'] = -1;
    $GLOBALS['topoPilha2'] = $GLOBALS['max'];
}
?>