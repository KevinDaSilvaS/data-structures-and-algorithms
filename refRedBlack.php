<?php
//$l = [25, 57, 48, 37, 12, 92, 33];
$l = [11, 1, 14, 2, 17, 15]; 
//$l = [30, 25, 15,40];
//$l = [30, 25, 29,40];
//$l = [30, 50, 45];

$root = 0;

$binaryTree[] = array(
    "value"  => $l[0],
    "menor"  => null,
    "maior"  => null,
    "cor"  => "preto",
);

function insertTree($elem)
{
    $arvore = $GLOBALS['binaryTree'];
    $tamanhoTotal = count($GLOBALS['binaryTree']);

    $pai = searchTree($GLOBALS['root'],$elem);

    if ($elem > $arvore[$pai]['value']) {
        $GLOBALS['binaryTree'][$pai]['maior'] = $tamanhoTotal;
    }else{
        $GLOBALS['binaryTree'][$pai]['menor'] = $tamanhoTotal;
    }

    $GLOBALS['binaryTree'][] = array(
        "value"  => $elem,
        "menor"  => null,
        "maior"  => null,
        "cor"  => "red",
    );

    equilibrate($tamanhoTotal);

}

function searchTree($pos,$elem)
{
    $arvore = $GLOBALS['binaryTree'];
    if ($elem > $arvore[$pos]['value']) {

        if ($arvore[$pos]['maior'] === null) {
            return $pos;

        }else{
            return searchTree($arvore[$pos]['maior'],$elem);
        }

    }else{
        if ($arvore[$pos]['menor'] === null) {
            return $pos;

        }else{
            return searchTree($arvore[$pos]['menor'],$elem);
        }
    }
}

for ($i=1; $i < count($l); $i++) { 

    insertTree($l[$i]);
    //var_dump($binaryTree);
}


function getParent($pos)
{
    foreach ($GLOBALS['binaryTree'] as $key => $value) {
        if ($value['maior'] == $pos || $value['menor'] == $pos) {
            return $key;
        }
    }
}

function equilibrate($pos){

    $pai = getParent($pos);
    $avo = getParent($pai);

    $elementoAvo = $GLOBALS['binaryTree'][$avo];
    $elementoPai = $GLOBALS['binaryTree'][$pai];

    $tio = $elementoAvo['menor'];
    if ($elementoAvo['menor'] == $pai) {
        $tio = $elementoAvo['maior'];
    }

    $corTio = "preto";
    if ($tio !== null) {
       $corTio = $GLOBALS['binaryTree'][$tio]['cor'];
    }

    $corPai = $elementoPai['cor'];

    if ($corTio == "red" && $corPai == "red") {
       echo "bired";
       recolouring($pai,$tio,$avo);
       equilibrate($avo);
       
    }/* else */
    if ($corTio == "preto" && $corPai == "red") {

        var_dump($GLOBALS['binaryTree'][$pos]['value']);

        if ($elementoAvo['menor'] == $pai 
        && $elementoPai['menor'] == $pos) {

            echo "ambos esquerda";
            rotacaoSimplesMenores($pai,$avo,$pos);
            

        }
        elseif ($elementoAvo['maior'] == $pai 
        && $elementoPai['maior'] == $pos) {

            echo "ambos direita";
            rotacaoSimplesMaiores($pai,$avo,$pos);

        }
        elseif ($elementoAvo['menor'] == $pai 
        && $elementoPai['maior'] == $pos) {

            echo "ambos pai menor e filho maior";
            rotacaoMenorMaior($pai,$avo,$pos);
        }
        elseif ($elementoAvo['maior'] == $pai 
        && $elementoPai['menor'] == $pos) {

            rotacaoMaiorMenor($pai,$avo,$pos);
            echo "<br>ambos pai maior e filho menor";

        }

        //equilibrate($avo);
    }
}

function recolouring($pai,$tio,$avo)
{
    $GLOBALS['binaryTree'][$tio]['cor'] = "preto";
    $GLOBALS['binaryTree'][$pai]['cor'] = "preto";

    if ($avo !== $GLOBALS['root']) {
        $GLOBALS['binaryTree'][$avo]['cor'] = "red";
    }
}

function rotacaoSimplesMenores($parent,$grandpa,$pos)
{
    $GLOBALS['binaryTree'][$grandpa]['menor'] = 
    $GLOBALS['binaryTree'][$parent]['maior'];

    $GLOBALS['binaryTree'][$parent]['maior'] = $grandpa;

    $GLOBALS['binaryTree'][$pos]['cor'] = "preto";
    $GLOBALS['binaryTree'][$parent]['cor'] = "red";
    $GLOBALS['binaryTree'][$grandpa]['cor'] = "preto";

    if ($grandpa === $GLOBALS['root']) {
        $GLOBALS['root'] = $parent;
    }

    changeRootColor();
}

function rotacaoSimplesMaiores($parent,$grandpa,$pos)
{
    $GLOBALS['binaryTree'][$grandpa]['maior'] = 
    $GLOBALS['binaryTree'][$parent]['menor'];

    $GLOBALS['binaryTree'][$parent]['menor'] = $grandpa;

    $GLOBALS['binaryTree'][$pos]['cor'] = "preto";
    $GLOBALS['binaryTree'][$parent]['cor'] = "red";
    $GLOBALS['binaryTree'][$grandpa]['cor'] = "preto";

    if ($grandpa === $GLOBALS['root']) {
        $GLOBALS['root'] = $parent;
    }

    changeRootColor();
}

function rotacaoMenorMaior($parent,$grandpa,$pos)
{
    $GLOBALS['binaryTree'][$parent]['maior'] = 
    $GLOBALS['binaryTree'][$pos]['menor'];

    $GLOBALS['binaryTree'][$pos]['menor'] = $parent;

    $GLOBALS['binaryTree'][$grandpa]['menor'] = $pos;

    rotacaoSimplesMenores($pos,$grandpa,$parent);

    $parentGrandpa = getParent($grandpa);
    
    if ($GLOBALS['binaryTree'][$parentGrandpa]['menor'] === $grandpa) {
        $GLOBALS['binaryTree'][$parentGrandpa]['menor'] = $pos;
    }

}

function rotacaoMaiorMenor($parent,$grandpa,$pos)
{
    $GLOBALS['binaryTree'][$parent]['menor'] = 
    $GLOBALS['binaryTree'][$pos]['maior'];

    $GLOBALS['binaryTree'][$pos]['maior'] = $parent;

    $GLOBALS['binaryTree'][$grandpa]['maior'] = $pos;

    rotacaoSimplesMaiores($pos,$grandpa,$parent);

    
    $parentGrandpa = getParent($grandpa);

    if ($GLOBALS['binaryTree'][$parentGrandpa]['maior'] === $grandpa) {
        $GLOBALS['binaryTree'][$parentGrandpa]['maior'] = $pos;
    }
}

function changeRootColor()
{
    $GLOBALS['binaryTree'][$GLOBALS['root']]['cor'] = "preto";
}

var_dump($binaryTree);
var_dump($root);
?>